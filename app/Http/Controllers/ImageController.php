<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageController extends Controller
{
    function uploads(Request $request, $locale = '')
    {
        $locale = app()->getLocale();
        $files = $request->file('hinhanh_files');
        $storagePath = storage_path('app/public');
        $publicStoragePath = public_path('storage');
        $manager = new ImageManager(new Driver());
        $htmlOutput = '';

        if (!empty($files)):
            foreach ($files as $file):
                $extension = $file->getClientOriginalExtension();
                if (empty($extension)) continue;
                $realname  = $file->getClientOriginalName();
                $filename  = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;

                Storage::put('private/images/' . $filename, file_get_contents($file), 'private');

                // 1. Tạo thư mục trong storage/app/public và gán quyền 0755
                $dirOrigin = $storagePath . '/images/origin';
                $dirThumb360 = $storagePath . '/images/thumb_360x200';
                $dirThumb50 = $storagePath . '/images/thumb_50';

                @mkdir($dirOrigin,   0755, true);
                @mkdir($dirThumb360, 0755, true);
                @mkdir($dirThumb50,  0755, true);

                $fileOrigin = $dirOrigin . '/' . $filename;
                $fileThumb360 = $dirThumb360 . '/' . $filename;
                $fileThumb50 = $dirThumb50 . '/' . $filename;

                // 2. Lưu ảnh qua Intervention Image
                $manager->decode($file->getRealPath())
                    ->save($fileOrigin);

                $manager->decode($file->getRealPath())
                    ->scaleDown(width: 360)
                    ->save($fileThumb360);

                $manager->decode($file->getRealPath())
                    ->scaleDown(height: 50)
                    ->save($fileThumb50);

                // 3. Ép quyền đọc 0644 cho file vừa tạo (Khắc phục lỗi 403 Forbidden)
                @chmod($fileOrigin, 0644);
                @chmod($fileThumb360, 0644);
                @chmod($fileThumb50, 0644);

                // 4. Đồng bộ sang public/storage nếu host không dùng symlink
                if (!is_link($publicStoragePath)) {
                    @mkdir($publicStoragePath . '/images/origin', 0755, true);
                    @mkdir($publicStoragePath . '/images/thumb_360x200', 0755, true);
                    @mkdir($publicStoragePath . '/images/thumb_50', 0755, true);

                    @copy($fileOrigin, $publicStoragePath . '/images/origin/' . $filename);
                    @copy($fileThumb360, $publicStoragePath . '/images/thumb_360x200/' . $filename);
                    @copy($fileThumb50, $publicStoragePath . '/images/thumb_50/' . $filename);

                    @chmod($publicStoragePath . '/images/origin/' . $filename, 0644);
                    @chmod($publicStoragePath . '/images/thumb_360x200/' . $filename, 0644);
                    @chmod($publicStoragePath . '/images/thumb_50/' . $filename, 0644);
                }

                $imgOriginUrl = asset('storage/images/origin/' . $filename);
                $imgThumbUrl = asset('storage/images/thumb_360x200/' . $filename);

                $htmlOutput .= '<div class="col-sm-6 col-md-4 items draggable-element text-center">
                <input type="hidden" name="hinhanh_aliasname[]" value="' . $filename . '" readonly/>
                <input type="hidden" name="hinhanh_filename[]" class="form-control" value="' . $realname . '" />
                  <a href="' . $imgOriginUrl . '" class="image-popup">
                    <div class="portfolio-masonry-box">
                      <div class="portfolio-masonry-img">
                        <img src="' . $imgThumbUrl . '" class="thumb-img img-fluid" alt="' . $filename . '">
                      </div>
                      <div class="portfolio-masonry-detail">
                        <p>' . $realname . '</p>
                      </div>
                    </div>
                  </a>
                  <a href="' . url($locale . '/image/delete/' . $filename) . '" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                    <i class="fa fa-trash"></i>
                  </a>
                  <input type="text" name="hinhanh_title[]" class="form-control" value="' . $realname . '" />
                </div>';
            endforeach;
        endif;

        return response($htmlOutput, 200)->header('Content-Type', 'text/html');
    }

    function delete(Request $request, $locale = '', $filename = '')
    {
        if ($filename) {
            self::remove($filename);
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    static function remove($filename)
    {
        if (empty($filename)) return;
        \Illuminate\Support\Facades\Storage::delete('private/images/' . $filename);
        \Illuminate\Support\Facades\Storage::delete('public/images/origin/' . $filename);
        \Illuminate\Support\Facades\Storage::delete('public/images/thumb_360x200/' . $filename);
        \Illuminate\Support\Facades\Storage::delete('public/images/thumb_50/' . $filename);

        $paths = [
            storage_path('app/public/images/origin/' . $filename),
            storage_path('app/public/images/thumb_360x200/' . $filename),
            storage_path('app/public/images/thumb_50/' . $filename),
            public_path('storage/images/origin/' . $filename),
            public_path('storage/images/thumb_360x200/' . $filename),
            public_path('storage/images/thumb_50/' . $filename),
        ];

        foreach ($paths as $path) {
            $cleanPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
            if (file_exists($cleanPath)) {
                @unlink($cleanPath);
            }
        }

        clearstatcache();
    }
}
