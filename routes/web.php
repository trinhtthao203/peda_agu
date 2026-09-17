<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DMThongTinController;
use App\Http\Controllers\ThongTinController;
use App\Http\Controllers\SubInfoController;
use App\Http\Controllers\NhanSuController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\NganhDaoTaoController;
use App\Http\Controllers\FeedbackController;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Artisan;

Route::get('/run-storage-link', function () {
    $target = storage_path('app/public');
    $shortcut = public_path('storage');

    // Kiểm tra nếu thư mục đích tồn tại
    if (!file_exists($target)) {
        return "Thư mục đích không tồn tại: {$target}";
    }

    // Nếu shortcut cũ đã có hoặc bị hỏng, thử xóa trước
    if (file_exists($shortcut) || is_link($shortcut)) {
        @unlink($shortcut);
    }

    // Tạo liên kết symbolic link
    if (@symlink($target, $shortcut)) {
        return "Tạo liên kết Storage thành công!";
    }

    return "Không thể tạo Symlink tự động do máy chủ chặn hàm symlink(). Hãy thử giải pháp tạo thủ công.";
});

Route::get('{locale}/xem-pdf-raw/{id}/{key}', [App\Http\Controllers\FrontendController::class, 'xem_pdf_raw'])->name('xem.pdf.raw');
Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::get('admin', function () {
    return redirect(app()->getLocale() . '/admin');
});

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function () {

    // Auth
    Route::get('auth/login',     [AuthController::class, 'getLogin'])->name('auth-login-get');
    Route::post('auth/login',    [AuthController::class, 'authenticate'])->name('auth-login-post');
    Route::get('auth/logout',    [AuthController::class, 'logout'])->name('auth-logout-get');
    Route::get('auth/not-permis', [AuthController::class, 'notPermis'])->name('auth-not-permis');

    // Utilities
    Route::get('slug/{str}', [ObjectController::class, 'getSlug'])->name('slug-string');

    // Image & File uploads
    Route::post('image/uploads',            [ImageController::class, 'uploads'])->name('image-upload-post')->middleware('checkauth');
    Route::get('image/delete/{filename}',   [ImageController::class, 'delete'])->middleware('checkauth');
    Route::post('file/uploads/{fileID}',    [FileController::class, 'fileUploads'])->middleware('checkauth');
    Route::post('file/uploads',             [FileController::class, 'uploads'])->middleware('checkauth');
    Route::post('file/upload-json/{fileID}', [FileController::class, 'upload_json'])->middleware('checkauth');
    Route::get('file/delete/{filename}',    [FileController::class, 'delete'])->middleware('checkauth');
    Route::get('file/download/{filename}',  [FileController::class, 'download'])->middleware('checkauth');

    // Frontend
    Route::get('/',                            [FrontendController::class, 'index'])->name('trang-chu');
    Route::get('tin-tuc-su-kien',              [FrontendController::class, 'thong_tin'])->name('thong-tin');
    Route::get('tin-tuc-su-kien/{slug}',       [FrontendController::class, 'thong_tin'])->name('thong-tin-slug');
    Route::get('news-and-events',              [FrontendController::class, 'thong_tin'])->name('news-and-events');
    Route::get('news-and-events/{slug}',       [FrontendController::class, 'thong_tin'])->name('news-and-events-slug');
    Route::get('chi-tiet-thong-tin/{slug}',    [FrontendController::class, 'thong_tin_chi_tiet'])->name('chi-tiet-thong-tin-slug');
    Route::get('detail-news-and-events/{slug}', [FrontendController::class, 'thong_tin_chi_tiet'])->name('detail-news-and-events-slug');
    Route::get('xem-truc-tuyen/thong-tin/{id}',       [FrontendController::class, 'xem_truc_tuyen'])->name('xem-truc-tuyen-thong-tin-slug');
    Route::get('xem-truc-tuyen/thong-tin/{id}/{key}', [FrontendController::class, 'xem_truc_tuyen'])->name('xem-truc-tuyen-thong-tin-slug-key');
    Route::get('tai-ve/thong-tin/{id}',               [FrontendController::class, 'tai_ve'])->name('tai-ve-thong-tin-slug');
    Route::get('tai-ve/thong-tin/{id}/{key}',          [FrontendController::class, 'tai_ve'])->name('tai-ve-thong-tin-slug-key');
    Route::get('tim-kiem', [FrontendController::class, 'tim_kiem'])->name('tim-kiem');
    Route::get('search',   [FrontendController::class, 'tim_kiem'])->name('search');

    // Tiếng Việt
    Route::get('sinh-vien/quy-trinh', [FrontendController::class, 'sinhVienQuyTrinh']);
    Route::get('sinh-vien/bieu-mau', [FrontendController::class, 'sinhVienBieuMau']);
    Route::get('sinh-vien/van-ban', [FrontendController::class, 'sinhVienVanBan']);

    // Tiếng Anh (Khớp với link trong menu_en.blade.php)
    Route::get('students/procedures', [FrontendController::class, 'sinhVienQuyTrinh']);
    Route::get('students/forms', [FrontendController::class, 'sinhVienBieuMau']);
    Route::get('students/documents', [FrontendController::class, 'sinhVienVanBan']);

    // Liên hệ & Ý kiến phản hồi
    Route::get('lien-he', [FrontendController::class, 'lien_he'])->name('contact.index');
    Route::get('contact', [FrontendController::class, 'lien_he']);

    // SubInfo (Dynamic)
    Route::get('{type}/{slug}', function ($locale, $type, $slug, \Illuminate\Http\Request $request) {
        $viTypes = ['nhan-su', 'dao-tao', 'gioi-thieu', 'nckh', 'sinh-vien', 'dbcl'];
        $enTypes = ['staff', 'academics', 'about', 'research', 'students', 'quality-assurance'];

        if (in_array($type, $viTypes)) {
            return app(FrontendController::class)->renderSubInfoVi($request, $locale, $type, $slug);
        }

        if (in_array($type, $enTypes)) {
            return app(FrontendController::class)->renderSubInfoEn($request, $locale, $type, $slug);
        }

        abort(404);
    })->where('type', 'nhan-su|dao-tao|gioi-thieu|nckh|sinh-vien|dbcl|staff|academics|about|research|students|quality-assurance');

    Route::get('tai-ve-subinfo/{id}/{key}', [FrontendController::class, 'tai_ve_subinfo'])->name('subinfo-download');
    Route::get('xem-truc-tuyen-subinfo/{id}/{key}', [FrontendController::class, 'xem_truc_tuyen_subinfo'])->name('subinfo-view-online');
    Route::get('xem-pdf-raw-subinfo/{id}/{key}', [FrontendController::class, 'xem_pdf_raw_subinfo'])->name('subinfo-pdf-raw');

    // Admin group
    Route::group(['prefix' => 'admin', 'middleware' => 'checkauth'], function () {
        Route::get('/',  [AuthController::class, 'admin'])->name('admin');

        // Banner
        Route::get('banner',              [BannerController::class, 'list'])->middleware('role:Admin,Manager,Updater')->name('admin-banner');
        Route::get('banner/add',          [BannerController::class, 'add'])->middleware('role:Admin,Manager,Updater')->name('admin-banner-add');
        Route::post('banner/create',      [BannerController::class, 'create'])->middleware('role:Admin,Manager,Updater')->name('admin-banner-create');
        Route::get('banner/edit/{id}',    [BannerController::class, 'edit'])->middleware('role:Admin,Manager,Updater')->name('admin-banner-edit');
        Route::post('banner/update',      [BannerController::class, 'update'])->middleware('role:Admin,Manager,Updater')->name('admin-banner-update');
        Route::get('banner/delete/{id}',  [BannerController::class, 'delete'])->middleware('role:Admin,Manager,Updater')->name('admin-banner-delete');

        // Danh mục thông tin
        Route::get('danh-muc-thong-tin',              [DMThongTinController::class, 'list'])->middleware('role:Admin,Manager,Updater')->name('admin-danh-muc-thong-tin');
        Route::get('danh-muc-thong-tin/add',          [DMThongTinController::class, 'add'])->middleware('role:Admin,Manager,Updater')->name('admin-danh-muc-thong-tin-add');
        Route::post('danh-muc-thong-tin/create',      [DMThongTinController::class, 'create'])->middleware('role:Admin,Manager,Updater')->name('admin-danh-muc-thong-tin-create');
        Route::get('danh-muc-thong-tin/edit/{id}',    [DMThongTinController::class, 'edit'])->middleware('role:Admin,Manager,Updater')->name('admin-danh-muc-thong-tin-edit');
        Route::post('danh-muc-thong-tin/update',      [DMThongTinController::class, 'update'])->middleware('role:Admin,Manager,Updater')->name('admin-danh-muc-thong-tin-update');
        Route::get('danh-muc-thong-tin/delete/{id}',  [DMThongTinController::class, 'delete'])->middleware('role:Admin,Manager,Updater')->name('admin-danh-muc-thong-tin-delete');

        // Thông tin
        Route::get('thong-tin',              [ThongTinController::class, 'list'])->middleware('role:Admin,Manager,Updater')->name('admin-thong-tin');
        Route::get('thong-tin/add',          [ThongTinController::class, 'add'])->middleware('role:Admin,Manager,Updater')->name('admin-thong-tin-add');
        Route::post('thong-tin/create',      [ThongTinController::class, 'create'])->middleware('role:Admin,Manager,Updater')->name('admin-thong-tin-create');
        Route::get('thong-tin/edit/{id}',    [ThongTinController::class, 'edit'])->middleware('role:Admin,Manager,Updater')->name('admin-thong-tin-edit');
        Route::post('thong-tin/update',      [ThongTinController::class, 'update'])->middleware('role:Admin,Manager,Updater')->name('admin-thong-tin-update');
        Route::get('thong-tin/delete/{id}',  [ThongTinController::class, 'delete'])->middleware('role:Admin,Manager,Updater')->name('admin-thong-tin-delete');

        // User
        Route::get('user',                       [UserController::class, 'list'])->middleware('role:Admin')->name('admin-user');
        Route::get('user/change-password',       [UserController::class, 'change_password'])->middleware('role:Admin')->name('admin-change-password');
        Route::post('user/update-password',      [UserController::class, 'update_password'])->middleware('role:Admin')->name('admin-update-password');
        Route::get('user/add',                   [UserController::class, 'add'])->middleware('role:Admin')->name('admin-user-add');
        Route::post('user/create',               [UserController::class, 'create'])->middleware('role:Admin')->name('admin-user-create');
        Route::get('user/edit/{id}',             [UserController::class, 'edit'])->middleware('role:Admin')->name('admin-user-edit');
        Route::post('user/update',               [UserController::class, 'update'])->middleware('role:Admin')->name('admin-user-update');
        Route::get('user/delete/{id}',           [UserController::class, 'delete'])->middleware('role:Admin')->name('admin-delete');

        // Quản lý Trang thông tin tĩnh (SubInfo)
        Route::get('sub-info',              [SubInfoController::class, 'list'])->name('admin-sub-info');
        Route::get('sub-info/add',          [SubInfoController::class, 'add'])->name('admin-sub-info-add');
        Route::post('sub-info/create',      [SubInfoController::class, 'create'])->name('admin-sub-info-create');
        Route::get('sub-info/edit/{id}',    [SubInfoController::class, 'edit'])->name('admin-sub-info-edit');
        Route::post('sub-info/update',      [SubInfoController::class, 'update'])->name('admin-sub-info-update');
        Route::get('sub-info/delete/{id}',  [SubInfoController::class, 'delete'])->name('admin-sub-info-delete');

        // Quản lý Nhân sự bộ môn (NhanSu)
        Route::get('nhan-su',               [NhanSuController::class, 'list'])->name('admin-nhan-su');
        Route::get('nhan-su/add',           [NhanSuController::class, 'add'])->name('admin-nhan-su-add');
        Route::post('nhan-su/create',       [NhanSuController::class, 'create'])->name('admin-nhan-su-create');
        Route::get('nhan-su/edit/{id}',     [NhanSuController::class, 'edit'])->name('admin-nhan-su-edit');
        Route::post('nhan-su/update',       [NhanSuController::class, 'update'])->name('admin-nhan-su-update');
        Route::get('nhan-su/delete/{id}',   [NhanSuController::class, 'delete'])->name('admin-nhan-su-delete');

        // Quản lý Đơn vị (Department)
        Route::get('department',              [DepartmentController::class, 'list'])->middleware('role:Admin,Manager,Updater')->name('admin-department');
        Route::get('department/add',          [DepartmentController::class, 'add'])->middleware('role:Admin,Manager,Updater')->name('admin-department-add');
        Route::post('department/create',      [DepartmentController::class, 'create'])->middleware('role:Admin,Manager,Updater')->name('admin-department-create');
        Route::get('department/edit/{id}',    [DepartmentController::class, 'edit'])->middleware('role:Admin,Manager,Updater')->name('admin-department-edit');
        Route::post('department/update',      [DepartmentController::class, 'update'])->middleware('role:Admin,Manager,Updater')->name('admin-department-update');
        Route::get('department/delete/{id}',  [DepartmentController::class, 'delete'])->middleware('role:Admin,Manager,Updater')->name('admin-department-delete');

        // Quản lý Ngành đào tạo
        Route::get('nganh-dao-tao',              [NganhDaoTaoController::class, 'list'])->middleware('role:Admin,Manager,Updater')->name('admin-nganh-dao-tao');
        Route::get('nganh-dao-tao/add',          [NganhDaoTaoController::class, 'add'])->middleware('role:Admin,Manager,Updater')->name('admin-nganh-dao-tao-add');
        Route::post('nganh-dao-tao/create',      [NganhDaoTaoController::class, 'create'])->middleware('role:Admin,Manager,Updater')->name('admin-nganh-dao-tao-create');
        Route::get('nganh-dao-tao/edit/{id}',    [NganhDaoTaoController::class, 'edit'])->middleware('role:Admin,Manager,Updater')->name('admin-nganh-dao-tao-edit');
        Route::post('nganh-dao-tao/update',      [NganhDaoTaoController::class, 'update'])->middleware('role:Admin,Manager,Updater')->name('admin-nganh-dao-tao-update');
        Route::get('nganh-dao-tao/delete/{id}',  [NganhDaoTaoController::class, 'delete'])->middleware('role:Admin,Manager,Updater')->name('admin-nganh-dao-tao-delete');

        Route::get('feedback',              [FeedbackController::class, 'list'])->middleware('role:Admin,Manager,Updater')->name('admin-feedback');
        Route::get('feedback/detail/{id}',  [FeedbackController::class, 'detail'])->middleware('role:Admin,Manager,Updater')->name('admin-feedback-detail');
        Route::post('feedback/update/{id}', [FeedbackController::class, 'update'])->middleware('role:Admin,Manager,Updater')->name('admin-feedback-update');
        Route::get('feedback/delete/{id}',  [FeedbackController::class, 'delete'])->middleware('role:Admin')->name('admin-feedback-delete');
    });
});

Route::post('gui-y-kien-dong-gop', [App\Http\Controllers\FrontendController::class, 'storeFeedback'])->name('feedback.submit');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
