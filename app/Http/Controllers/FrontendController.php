<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\ThongTinController;
use App\Models\ThongTin;
use App\Models\DMThongTin;
use App\Models\Banner;
use App\Models\SubInfo;
use App\Models\NhanSu;
use App\Models\Department;
use App\Models\NganhDaoTao;
use App\Models\Feedback;
use MongoDB\BSON\UTCDateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    private function getExcludedCatIds($locale = 'vi')
    {
        $excludedSlugs = [
            'quy-trinh',
            'bieu-mau',
            'van-ban',
            'van-ban-bo',
            'van-ban-truong',
            'van-ban-khoa'
        ];

        $cats = DMThongTin::where('locale', $locale)
            ->whereIn('slug', $excludedSlugs)
            ->get();

        $excludedIds = [];
        foreach ($cats as $cat) {
            $idStr = (string) $cat['_id'];
            $excludedIds[] = $idStr;
            try {
                $excludedIds[] = ObjectController::ObjectId($idStr);
            } catch (\Exception $e) {
            }
        }

        return array_values(array_unique($excludedIds, SORT_REGULAR));
    }

    function index(Request $request, $locale = 'vi')
    {
        $banners = Banner::where('status', 1)
            ->where('trang_chu', 1)
            ->orderBy('order', 'desc')
            ->get();

        $excludedCatIds = $this->getExcludedCatIds($locale);
        $oldExclude = '65080bb00bc7b8223c27c10a';
        $excludedCatIds[] = $oldExclude;
        try {
            $excludedCatIds[] = ObjectController::ObjectId($oldExclude);
        } catch (\Exception $e) {
        }

        $tin_moi_nhat = ThongTin::raw(function ($collection) use ($locale, $excludedCatIds) {
            return $collection->aggregate([
                [
                    '$match' => [
                        'locale' => $locale,
                        'id_cat' => ['$nin' => $excludedCatIds]
                    ]
                ],
                [
                    '$addFields' => [
                        'sort_priority' => [
                            '$cond' => [
                                'if' => ['$lt' => ['$thu_tu', 0]],
                                'then' => 1,
                                'else' => [
                                    '$cond' => [
                                        'if' => ['$gt' => ['$thu_tu', 0]],
                                        'then' => 2,
                                        'else' => 3
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        'sort_priority' => 1,
                        'thu_tu' => -1,
                        'date_post' => -1
                    ]
                ],
                [
                    '$limit' => 6
                ]
            ]);
        });

        $ch = curl_init('https://tuyensinh.agu.edu.vn/api/partner/v1/news?limit=12');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['X-API-Key: edcrm_f014f7ca_ca0c118571ac7d52e79e0e938acbfd95561b0de790179be5']
        ]);
        $data = json_decode(curl_exec($ch), true);
        $thong_tin_tuyen_sinh = !empty($data['data']) ? $data['data'] : array();
        $sdg_tags = ThongTinController::get_sdg_tags();

        return view('Frontend.index')->with(compact('banners', 'tin_moi_nhat', 'thong_tin_tuyen_sinh', 'sdg_tags'));
    }

    function thong_tin(Request $request, $locale = 'vi', $slug = '')
    {
        $query = ThongTin::where('locale', '=', $locale);
        $cat = null;
        $excludedCatIds = $this->getExcludedCatIds($locale);

        if ($slug == 'tin-moi-nhat' || $slug == '' || $slug == 'lastest-news') {
            $title = ($locale == 'vi') ? 'Tin mới nhất' : 'Lastest News';
        } else {
            $cat = DMThongTin::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
            $title = $cat['ten'] ?? '';
            if ($cat) {
                $query->where('id_cat', $cat['_id']);
            }
        }

        $all_items = $query->raw(function ($collection) use ($locale, $slug, $cat, $excludedCatIds) {
            $matchCondition = ['locale' => $locale];

            if ($slug != 'tin-moi-nhat' && $slug != '' && $slug != 'lastest-news' && $cat) {
                $catIdStr = (string) $cat['_id'];
                $catIds = [$catIdStr];
                try {
                    $catIds[] = ObjectController::ObjectId($catIdStr);
                } catch (\Exception $e) {
                }
                $matchCondition['id_cat'] = ['$in' => $catIds];
            } else {
                $matchCondition['id_cat'] = ['$nin' => $excludedCatIds];
            }

            return $collection->aggregate([
                [
                    '$match' => $matchCondition
                ],
                [
                    '$addFields' => [
                        'sort_priority' => [
                            '$cond' => [
                                'if' => ['$lt' => ['$thu_tu', 0]],
                                'then' => 1,
                                'else' => [
                                    '$cond' => [
                                        'if' => ['$gt' => ['$thu_tu', 0]],
                                        'then' => 2,
                                        'else' => 3
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        'sort_priority' => 1,
                        'thu_tu' => -1,
                        'date_post' => -1
                    ]
                ]
            ]);
        });

        $perPage = 12;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($all_items);

        $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $danhsach = new LengthAwarePaginator(
            $currentPageItems,
            $itemCollection->count(),
            $perPage,
            $currentPage,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $request->query()
            ]
        );

        if ($slug == '') {
            $path = ($locale == 'vi') ? 'tin-tuc-su-kien/tin-moi-nhat' : 'news-and-events/lastest-news';
        } else {
            $path = ($locale == 'vi') ? 'tin-tuc-su-kien/' . $slug : 'news-and-events/' . $slug;
        }

        return view('Frontend.thong-tin')->with(compact('danhsach', 'title', 'slug', 'path'));
    }

    function gioi_thieu(Request $request, $locale = 'vi', $slug = '')
    {
        return view('Frontend.GioiThieu.' . $slug);
    }

    function about(Request $request, $locale = 'vi', $slug = '')
    {
        return view('Frontend.About.' . $slug);
    }

    function tim_kiem(Request $request, $locale = 'vi')
    {
        $q = $request->input('q');
        if ($locale == 'vi') {
            $title = 'Kết quả tìm kiếm';
            $path = 'tim-kiem';
        } else {
            $title = 'Search Results';
            $path = 'search';
        }
        $slug = '';
        $danhsach = ThongTin::where('locale', '=', $locale)->where('ten', 'regexp', '/.*' . $q . '/i')->orderBy('date_post', 'desc')->paginate(12);
        return view('Frontend.thong-tin')->with(compact('danhsach', 'title', 'slug', 'path'));
    }

    function xem_truc_tuyen(Request $request, $locale = 'vi', $id = '', $key = 0)
    {
        $ds = ThongTin::find($id);
        $key = intval($key);
        if (strtolower($ds['attachments'][$key]['type']) == 'doc' || strtolower($ds['attachments'][$key]['type']) == 'docx' || strtolower($ds['attachments'][$key]['type']) == 'xlsx') {
            $path_file = 'https://www.agu.edu.vn/storage/files/' . $ds['attachments'][$key]['aliasname'];
            $frame_path = 'https://view.officeapps.live.com/op/embed.aspx?src=' . $path_file;
            echo '<iframe src="' . $frame_path . '" onload=\'javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));\' style="height:100%;width:100%;border:none;overflow:hidden;"></iframe>';
        } else if (strtolower($ds['attachments'][$key]['type']) == 'pdf') {
            echo '<embed src="' . env('APP_URL') . 'storage/files/' . $ds['attachments'][$key]['aliasname'] . '" style="width:100%;height:100% !important;" />';
        } else {
            echo 'Không thể xem, vui lòng download về xem. Cám ơn!';
        }
    }

    function tai_ve(Request $request, $locale = 'vi', $id = '', $key = 0)
    {
        $ds = ThongTin::find($id);
        $filename = Str::slug($ds['attachments'][$key]['title'], '_') . "." . $ds['attachments'][$key]['type'];
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        return Storage::download($file_path, $filename);
    }

    function thong_tin_chi_tiet(Request $request, $locale = 'vi', $slug = '')
    {
        $ds = ThongTin::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
        $sdg_tags = ThongTinController::get_sdg_tags();
        $id_cat = $ds['id_cat'];
        $id = ObjectController::ObjectId($ds['_id']);
        $tin_lien_quan = ThongTin::where('locale', '=', $locale)->where('_id', '<>', $id)->where('id_cat', $id_cat)->orderBy('date_post', 'desc')->take(9)->get();
        return view('Frontend.thong-tin-chi-tiet')->with(compact('ds', 'tin_lien_quan', 'sdg_tags'));
    }

    public function renderSubInfoVi(Request $request, $locale = 'vi', $type = '', $slug = '')
    {
        $type = $type ?: $request->segment(2);
        $slug = $slug ?: $request->segment(3);

        $page = SubInfo::where('locale', 'vi')
            ->where('type', $type)
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $danhSachNhanSu = collect();
        $dept = null;
        $nganhDaoTao = null;

        if ($type == 'nhan-su') {
            $dept = Department::where('slug', $slug)->first();
            if ($dept) {
                $deptId = (string) $dept->_id;
                $rawNhanSu = NhanSu::where('departments.department_id', $deptId)->get();
                $danhSachNhanSu = $rawNhanSu->sortBy(function ($ns) use ($deptId) {
                    $role = collect($ns->departments)->firstWhere('department_id', $deptId);
                    return intval($role['thu_tu'] ?? 0);
                })->values();
            }
        } elseif ($type == 'dao-tao') {
            $nganhDaoTao = NganhDaoTao::where('slug', $slug)->first();
        }

        return view('Frontend.subinfo-detail', compact('page', 'danhSachNhanSu', 'dept', 'nganhDaoTao'));
    }

    public function renderSubInfoEn(Request $request, $locale = 'en', $type = '', $slug = '')
    {
        $segment = $type ?: $request->segment(2);
        $slug = $slug ?: $request->segment(3);

        $typeMap = [
            'staff'             => 'nhan-su',
            'academics'         => 'dao-tao',
            'about'             => 'gioi-thieu',
            'research'          => 'nckh',
            'students'          => 'sinh-vien',
            'quality-assurance' => 'dbcl',
        ];
        $dbType = $typeMap[$segment] ?? $segment;

        $page = SubInfo::where('locale', 'en')
            ->where('type', $dbType)
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $danhSachNhanSu = collect();
        $dept = null;
        $nganhDaoTao = null;

        if ($dbType == 'nhan-su') {
            $dept = Department::where('slug_en', $slug)->orWhere('slug', $slug)->first();
            if ($dept) {
                $deptId = (string) $dept->_id;
                $rawNhanSu = NhanSu::where('departments.department_id', $deptId)->get();
                $danhSachNhanSu = $rawNhanSu->sortBy(function ($ns) use ($deptId) {
                    $role = collect($ns->departments)->firstWhere('department_id', $deptId);
                    return intval($role['thu_tu'] ?? 0);
                })->values();
            }
        } elseif ($dbType == 'dao-tao') {
            $nganhDaoTao = NganhDaoTao::where('slug_en', $slug)->orWhere('slug', $slug)->first();
        }

        return view('Frontend.subinfo-detail', compact('page', 'danhSachNhanSu', 'dept', 'nganhDaoTao'));
    }

    public function sinhVienQuyTrinh(Request $request, $locale = 'vi')
    {
        $cat = DMThongTin::where('locale', $locale)->where('slug', 'quy-trinh')->first();
        $danhsach = collect();

        if ($cat) {
            $catIdStr = (string) $cat['_id'];
            $catIds = [$catIdStr];
            try {
                $catIds[] = ObjectController::ObjectId($catIdStr);
            } catch (\Exception $e) {
            }

            $danhsach = ThongTin::where('locale', $locale)
                ->whereIn('id_cat', $catIds)
                ->orderBy('date_post', 'desc')
                ->paginate(12);
        }

        return view('Frontend.SinhVien.quy-trinh', compact('danhsach'));
    }

    public function sinhVienBieuMau(Request $request, $locale = 'vi')
    {
        $cat = DMThongTin::where('locale', $locale)->where('slug', 'bieu-mau')->first();
        $danhsach = collect();

        if ($cat) {
            $catIdStr = (string) $cat['_id'];
            $catIds = [$catIdStr];
            try {
                $catIds[] = ObjectController::ObjectId($catIdStr);
            } catch (\Exception $e) {
            }

            $danhsach = ThongTin::where('locale', $locale)
                ->whereIn('id_cat', $catIds)
                ->orderBy('date_post', 'desc')
                ->get();
        }

        return view('Frontend.SinhVien.bieu-mau', compact('danhsach'));
    }

    public function sinhVienVanBan(Request $request, $locale = 'vi')
    {
        $getIdsBySlug = function ($slug) use ($locale) {
            $cat = DMThongTin::where('locale', $locale)->where('slug', $slug)->first();
            if (!$cat) return [];
            $idStr = (string) $cat['_id'];
            $ids = [$idStr];
            try {
                $ids[] = ObjectController::ObjectId($idStr);
            } catch (\Exception $e) {
            }
            return $ids;
        };

        $idsBo = $getIdsBySlug('van-ban-bo');
        $idsTruong = $getIdsBySlug('van-ban-truong');
        $idsKhoa = $getIdsBySlug('van-ban-khoa');

        $van_ban_bo = !empty($idsBo) ? ThongTin::where('locale', $locale)->whereIn('id_cat', $idsBo)->orderBy('date_post', 'desc')->get() : collect();
        $van_ban_truong = !empty($idsTruong) ? ThongTin::where('locale', $locale)->whereIn('id_cat', $idsTruong)->orderBy('date_post', 'desc')->get() : collect();
        $van_ban_khoa = !empty($idsKhoa) ? ThongTin::where('locale', $locale)->whereIn('id_cat', $idsKhoa)->orderBy('date_post', 'desc')->get() : collect();

        return view('Frontend.SinhVien.van-ban', compact('van_ban_bo', 'van_ban_truong', 'van_ban_khoa'));
    }

    public function lien_he(Request $request, $locale = 'vi')
    {
        $publishedFeedbacks = \App\Models\Feedback::where('is_published', true)
            ->where('status', 'responded')
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('Frontend.contact', compact('publishedFeedbacks'));
    }

    public function storeFeedback(Request $request)
    {
        if (!empty($request->input('_hp_security'))) {
            return response()->json(['status' => 'success', 'message' => 'Cảm ơn bạn đã gửi ý kiến đóng góp!']);
        }

        $validator = Validator::make($request->all(), [
            'sender_type' => 'required|in:student,business,alumni,other',
            'topic'       => 'required|in:dao-tao,co-so-vat-chat,viec-lam,khac',
            'fullname'    => 'nullable|string|max:100',
            'contact'     => 'nullable|string|max:100',
            'content'     => 'required|string|min:5|max:2000',
        ], [
            'content.required' => 'Vui lòng nhập nội dung đóng góp.',
            'content.min'      => 'Nội dung đóng góp phải có ít nhất 5 ký tự.',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        try {
            $data = [
                'sender_type'      => htmlspecialchars($request->input('sender_type')),
                'topic'            => htmlspecialchars($request->input('topic')),
                'fullname'         => htmlspecialchars($request->input('fullname') ?: 'Ẩn danh'),
                'contact'          => htmlspecialchars($request->input('contact') ?: ''),
                'content'          => htmlspecialchars($request->input('content')),
                'ip_address'       => $request->ip(),
                'user_agent'       => substr($request->userAgent(), 0, 255),
                'status'           => 'pending',
                'assigned_to'      => null,
                'assigned_at'      => null,
                'response_content' => null,
                'responder_name'   => null,
                'responded_at'     => null,
                'is_published'     => false,
                'published_at'     => null,
                'created_at'       => now(),
                'updated_at'       => now()
            ];

            \App\Models\Feedback::create($data);

            return response()->json(['status' => 'success', 'message' => 'Ý kiến đóng góp của bạn đã được gửi thành công!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Lỗi máy chủ: ' . $e->getMessage()], 500);
        }
    }
}
