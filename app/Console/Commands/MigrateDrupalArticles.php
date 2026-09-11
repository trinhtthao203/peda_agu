<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use App\Models\ThongTin;

class MigrateDrupalArticles extends Command
{
    protected $signature = 'migrate:drupal-articles {file=articles.json}';
    protected $description = 'Tự động tải ảnh/file từ Drupal về Laravel và nạp vào MongoDB';

    public function handle()
    {
        $filePath = base_path($this->argument('file'));
        if (!file_exists($filePath)) {
            $this->error("Không tìm thấy file: {$filePath}");
            return;
        }

        $rawJson = file_get_contents($filePath);
        $articles = json_decode($rawJson, true);
        $domainGoc = 'https://peda.agu.edu.vn';

        if (!is_array($articles)) {
            $this->error("Định dạng file articles.json không hợp lệ!");
            return;
        }

        // Tạo sẵn cấu trúc các thư mục theo chuẩn giao diện Laravel của bạn
        Storage::disk('public')->makeDirectory('files');
        Storage::disk('public')->makeDirectory('images/origin');
        Storage::disk('public')->makeDirectory('images/thumb_360x200');

        $this->info("Bắt đầu xử lý " . count($articles) . " bài viết...");

        foreach ($articles as $item) {
            $createdStr = $item['created'][0]['value'] ?? null;
            $year = $createdStr ? (int)date('Y', strtotime($createdStr)) : 0;

            if ($year < 2020) {
                continue;
            }

            $title = $item['title'][0]['value'] ?? '';
            $body = $item['body'][0]['value'] ?? '';
            $slug = Str::slug($title);
            if (empty($slug)) {
                $slug = 'bai-viet-' . time() . '-' . Str::random(4);
            }

            // 1. Quét và tải toàn bộ ảnh trong nội dung bài viết (inline-images)
            $pattern = '/<img[^>]+src=["\']([^"\']+)["\']/i';
            if (preg_match_all($pattern, $body, $matches)) {
                foreach ($matches[1] as $imgSrc) {
                    if (str_contains($imgSrc, 'fbcdn.net')) {
                        continue;
                    }

                    $fullImgUrl = Str::startsWith($imgSrc, 'http') ? $imgSrc : $domainGoc . $imgSrc;
                    $savedPath = $this->downloadFile($fullImgUrl, 'files');
                    if ($savedPath) {
                        $newUrl = '/storage/' . $savedPath;
                        $body = str_replace($imgSrc, $newUrl, $body);
                    }
                }
            }

            // 2. Xử lý ảnh hoạt động (photos) theo đúng cấu trúc View Blade cần
            $photos = [];
            if (!empty($item['field_image'])) {
                foreach ($item['field_image'] as $imgObj) {
                    $url = $imgObj['url'] ?? '';
                    if ($url) {
                        $fullUrl = Str::startsWith($url, 'http') ? $url : $domainGoc . $url;
                        $savedOrigin = $this->downloadFile($fullUrl, 'images/origin');

                        if ($savedOrigin) {
                            $aliasName = basename($savedOrigin);

                            // Copy sang thumb_360x200 để tránh lỗi vỡ ảnh thumb trong Blade
                            Storage::disk('public')->copy($savedOrigin, 'images/thumb_360x200/' . $aliasName);

                            $decodedPath = urldecode(parse_url($fullUrl, PHP_URL_PATH));
                            $originalName = basename($decodedPath);
                            $ext = pathinfo($originalName, PATHINFO_EXTENSION);

                            // Fallback nếu title rỗng thì lấy alt, rồi tới tiêu đề bài
                            $photoTitle = !empty($imgObj['title']) ? $imgObj['title'] : (!empty($imgObj['alt']) ? $imgObj['alt'] : $title);

                            $photos[] = [
                                'aliasname' => $aliasName,
                                'filename'  => $originalName,
                                'title'     => $photoTitle,
                                'size'      => (string)Storage::disk('public')->size($savedOrigin),
                                'type'      => strtolower($ext)
                            ];
                        }
                    }
                }
            }

            // 3. Xử lý file đính kèm (attachments - PDF, DOCX...)
            $attachments = [];
            if (!empty($item['field_upload'])) {
                foreach ($item['field_upload'] as $uploadObj) {
                    $url = $uploadObj['url'] ?? '';
                    if ($url) {
                        $fullUrl = Str::startsWith($url, 'http') ? $url : $domainGoc . $url;
                        $decodedPath = urldecode(parse_url($fullUrl, PHP_URL_PATH));
                        $originalName = basename($decodedPath);
                        $saved = $this->downloadFile($fullUrl, 'files');

                        if ($saved) {
                            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                            $attachments[] = [
                                'aliasname' => basename($saved),
                                'filename'  => $originalName,
                                'title'     => !empty($uploadObj['description']) ? $uploadObj['description'] : $originalName,
                                'size'      => (string)Storage::disk('public')->size($saved),
                                'type'      => strtolower($ext)
                            ];
                        }
                    }
                }
            }

            // 4. Bóc tách tóm tắt ngắn (mo_ta)
            $cleanText = trim(preg_replace('/\s+/', ' ', strip_tags($body)));
            $moTa = Str::limit($cleanText, 250);

            // 5. Tạo Document nạp MongoDB
            $createdTime = strtotime($createdStr);
            $changedTime = strtotime($item['changed'][0]['value'] ?? $createdStr);

            $document = [
                '_id'         => new ObjectId(), // Thêm _id chuẩn ObjectId để Admin edit không bị lỗi
                'ten'         => $title,
                'slug'        => $slug,
                'mo_ta'       => $moTa ?: $title,
                'noi_dung'    => $body,
                'thu_tu'      => -1,
                'photos'      => $photos,
                'attachments' => $attachments,
                'id_cat'      => ['626b4331f5660000d50032f0'],
                'id_sdg_tags' => ['4'],
                'locale'      => $item['langcode'][0]['value'] ?? 'vi',
                'date_post'   => date('Y-m-d H:i:s', $createdTime),
                'id_user'     => new ObjectId('6a44ecced9a0845af70b6e88'),
                'updated_at'  => new UTCDateTime($changedTime * 1000),
                'created_at'  => new UTCDateTime($createdTime * 1000),
            ];

            $record = new ThongTin();
            $record->forceFill($document)->save();

            $this->line("✔ (" . count($photos) . " ảnh) Đã nạp bài: " . Str::limit($title, 40));
        }

        $this->info("Hoàn tất chuyển đổi dữ liệu và tải xong hình ảnh chuẩn theo giao diện!");
    }

    private function downloadFile($url, $folder = 'files')
    {
        try {
            if (empty($url)) {
                return null;
            }

            // Tách và mã hóa đúng từng phần của URL tiếng Việt/khoảng trắng
            $parsed = parse_url($url);
            if (!isset($parsed['host'])) {
                return null;
            }

            $pathSegments = explode('/', $parsed['path'] ?? '');
            $encodedSegments = array_map(function ($seg) {
                return rawurlencode(rawurldecode($seg));
            }, $pathSegments);
            $cleanPath = implode('/', $encodedSegments);

            $fetchUrl = ($parsed['scheme'] ?? 'https') . '://' . $parsed['host'] . $cleanPath;
            if (isset($parsed['query'])) {
                $fetchUrl .= '?' . $parsed['query'];
            }

            $response = Http::withoutVerifying()
                ->withOptions([
                    'verify' => false,
                    'curl'   => [CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false]
                ])
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept'     => '*/*'
                ])
                ->timeout(60)
                ->get($fetchUrl);

            // Fallback: nếu cách trên bị 404, thử tải lại bằng link thô trong JSON
            if (!$response->successful() && $fetchUrl !== $url) {
                $rawFallback = str_replace(' ', '%20', $url);
                $response = Http::withoutVerifying()
                    ->withOptions(['verify' => false])
                    ->timeout(60)
                    ->get($rawFallback);
            }

            if ($response->successful() && strlen($response->body()) > 0) {
                $originalName = basename(urldecode($parsed['path']));
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);

                $cleanBaseName = Str::slug($nameWithoutExt) . ($extension ? '.' . $extension : '');
                $saveFileName = date('YmdHis') . '_' . Str::random(6) . '_' . $cleanBaseName;
                $savePath = $folder . '/' . $saveFileName;

                Storage::disk('public')->put($savePath, $response->body());
                return $savePath;
            } else {
                $this->warn("Tải thất bại [HTTP {$response->status()}]: " . $url);
            }
        } catch (\Exception $e) {
            $this->error("Lỗi ngoại lệ khi tải [{$url}]: " . $e->getMessage());
        }

        return null;
    }
}
