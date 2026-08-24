<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\ThongTinController;
use App\Models\ThongTin;
use App\Models\DMThongTin;
use App\Models\Banner;
use App\Models\SubInfo;
use App\Models\NhanSu;
use App\Models\Department;

class FrontendController extends Controller
{
    function index(Request $request, $locale = 'vi')
    {
        $banners = Banner::where('status', 1)
            ->where('trang_chu', 1)
            ->orderBy('order', 'desc')
            ->get();

        $tin_moi_nhat = ThongTin::raw(function ($collection) use ($locale) {
            return $collection->aggregate([
                [
                    '$match' => [
                        'locale' => $locale,
                        'id_cat' => ['$ne' => '65080bb00bc7b8223c27c10a']
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

    function gioi_thieu(Request $request, $locale = 'vi', $slug = '')
    {
        return view('Frontend.GioiThieu.' . $slug);
    }

    function about(Request $request, $locale = 'vi', $slug = '')
    {
        return view('Frontend.About.' . $slug);
    }

    function thong_tin(Request $request, $locale = 'vi', $slug = '')
    {
        $query = ThongTin::where('locale', '=', $locale);
        $cat = null;

        if ($slug == 'tin-moi-nhat' || $slug == '' || $slug == 'lastest-news') {
            $title = ($locale == 'vi') ? 'Tin mới nhất' : 'Lastest News';
        } else {
            $cat = DMThongTin::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
            $title = $cat['ten'];
            $query->where('id_cat', $cat['_id']);
        }

        $all_items = $query->raw(function ($collection) use ($locale, $slug, $cat) {
            $matchCondition = ['locale' => $locale];

            if ($slug != 'tin-moi-nhat' && $slug != '' && $slug != 'lastest-news' && $cat) {
                $matchCondition['id_cat'] = $cat['_id'];
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

    public function renderSubInfoVi(Request $request, $locale = 'vi', $slug = '')
    {
        $type = $request->segment(2);

        $page = SubInfo::where('locale', 'vi')
            ->where('type', $type)
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $danhSachNhanSu = collect();
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
        }

        return view('Frontend.subinfo-detail', compact('page', 'danhSachNhanSu'));
    }

    public function renderSubInfoEn(Request $request, $locale = 'en', $slug = '')
    {
        $segment = $request->segment(2);
        $typeMap = [
            'staff'     => 'nhan-su',
            'academics' => 'dao-tao',
            'about'     => 'gioi-thieu'
        ];
        $type = $typeMap[$segment] ?? 'gioi-thieu';
        $page = SubInfo::where('locale', 'en')
            ->where('type', $type)
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $danhSachNhanSu = collect();

        if ($type == 'nhan-su') {
            $viPage = SubInfo::where('locale', 'vi')
                ->where('type', 'nhan-su')
                ->where(function ($q) use ($page, $slug) {
                    if (!empty($page->id_parent)) {
                        $q->where('_id', $page->id_parent);
                    } else {
                        $q->where('slug', $slug);
                    }
                })
                ->first();

            $dept = null;
            if ($viPage) {
                $dept = Department::where('slug', $viPage->slug)->first();
            }
            if (!$dept) {
                $dept = Department::where('slug', $slug)->first();
            }
            if ($dept) {
                $deptId = (string) $dept->_id;
                $rawNhanSu = NhanSu::where('departments.department_id', $deptId)->get();

                $danhSachNhanSu = $rawNhanSu->sortBy(function ($ns) use ($deptId) {
                    $role = collect($ns->departments)->firstWhere('department_id', $deptId);
                    return intval($role['thu_tu'] ?? 0);
                })->values();
            }
        }

        return view('Frontend.subinfo-detail', compact('page', 'danhSachNhanSu'));
    }
}
