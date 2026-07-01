<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DMDiaChiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\TranslatePathController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DMThongTinController;
use App\Http\Controllers\ThongTinController;
use UniSharp\LaravelFilemanager\Lfm;

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::get('admin', function () {
    return redirect(app()->getLocale() . '/admin');
});

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function() {

    // Auth
    Route::get('auth/login',     [AuthController::class, 'getLogin'])->name('auth-login-get');
    Route::post('auth/login',    [AuthController::class, 'authenticate'])->name('auth-login-post');
    Route::get('auth/logout',    [AuthController::class, 'logout'])->name('auth-logout-get');
    Route::get('auth/not-permis',[AuthController::class, 'notPermis'])->name('auth-not-permis');

    // Utilities
    Route::get('slug/{str}', [ObjectController::class, 'getSlug'])->name('slug-string');

    // Image & File uploads
    Route::post('image/uploads',            [ImageController::class, 'uploads'])->name('image-upload-post')->middleware('checkauth');
    Route::get('image/delete/{filename}',   [ImageController::class, 'delete'])->middleware('checkauth');
    Route::post('file/uploads/{fileID}',    [FileController::class, 'fileUploads'])->middleware('checkauth');
    Route::post('file/uploads',             [FileController::class, 'uploads'])->middleware('checkauth');
    Route::post('file/upload-json/{fileID}',[FileController::class, 'upload_json'])->middleware('checkauth');
    Route::get('file/delete/{filename}',    [FileController::class, 'delete'])->middleware('checkauth');
    Route::get('file/download/{filename}',  [FileController::class, 'download'])->middleware('checkauth');

    // Address
    Route::get('address/get/{id}',       [DMDiaChiController::class, 'getOptions'])->middleware('checkauth');
    Route::get('address/get/{id}/{id1}', [DMDiaChiController::class, 'getOptions1'])->middleware('checkauth');

    // Frontend
    Route::get('/',                            [FrontendController::class, 'index'])->name('trang-chu');
    Route::get('gioi-thieu',                   [FrontendController::class, 'gioi_thieu'])->name('gioi-thieu');
    Route::get('gioi-thieu/{slug}',            [FrontendController::class, 'gioi_thieu'])->name('gioi-thieu-slug');
    Route::get('about',                        [FrontendController::class, 'about'])->name('about');
    Route::get('about/{slug}',                 [FrontendController::class, 'about'])->name('about-slug');
    Route::get('tin-tuc-su-kien',              [FrontendController::class, 'thong_tin'])->name('thong-tin');
    Route::get('tin-tuc-su-kien/{slug}',       [FrontendController::class, 'thong_tin'])->name('thong-tin-slug');
    Route::get('news-and-events',              [FrontendController::class, 'thong_tin'])->name('news-and-events');
    Route::get('news-and-events/{slug}',       [FrontendController::class, 'thong_tin'])->name('news-and-events-slug');
    Route::get('chi-tiet-thong-tin/{slug}',    [FrontendController::class, 'thong_tin_chi_tiet'])->name('chi-tiet-thong-tin-slug');
    Route::get('detail-news-and-events/{slug}',[FrontendController::class, 'thong_tin_chi_tiet'])->name('detail-news-and-events-slug');
    Route::get('xem-truc-tuyen/thong-tin/{id}',       [FrontendController::class, 'xem_truc_tuyen'])->name('xem-truc-tuyen-thong-tin-slug');
    Route::get('xem-truc-tuyen/thong-tin/{id}/{key}', [FrontendController::class, 'xem_truc_tuyen'])->name('xem-truc-tuyen-thong-tin-slug-key');
    Route::get('tai-ve/thong-tin/{id}',               [FrontendController::class, 'tai_ve'])->name('tai-ve-thong-tin-slug');
    Route::get('tai-ve/thong-tin/{id}/{key}',          [FrontendController::class, 'tai_ve'])->name('tai-ve-thong-tin-slug-key');
    Route::get('tim-kiem', [FrontendController::class, 'tim_kiem'])->name('tim-kiem');
    Route::get('search',   [FrontendController::class, 'tim_kiem'])->name('search');

    // Admin group
    Route::group(['prefix' => 'admin', 'middleware' => 'checkauth'], function() {
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

        // Translate
        Route::get('translate',              [TranslateController::class, 'index'])->middleware('role:Admin,Manager,Updater')->name('admin-translate');
        Route::get('translate/add',          [TranslateController::class, 'add'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-add');
        Route::post('translate/create',      [TranslateController::class, 'create'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-create');
        Route::get('translate/edit/{key}',   [TranslateController::class, 'edit'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-edit');
        Route::post('translate/update',      [TranslateController::class, 'update'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-update');
        Route::get('translate/delete/{key}', [TranslateController::class, 'delete'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-delete');

        // Translate Path
        Route::get('translate-path',              [TranslatePathController::class, 'index'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-path');
        Route::get('translate-path/add',          [TranslatePathController::class, 'add'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-add');
        Route::post('translate-path/create',      [TranslatePathController::class, 'create'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-create');
        Route::get('translate-path/edit/{key}',   [TranslatePathController::class, 'edit'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-edit');
        Route::post('translate-path/update',      [TranslatePathController::class, 'update'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-update');
        Route::get('translate-path/delete/{key}', [TranslatePathController::class, 'delete'])->middleware('role:Admin,Manager,Updater')->name('admin-translate-path-delete');
    });

});

// File manager — chỉ dùng một prefix, bỏ prefix 'filemanager' trùng
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
