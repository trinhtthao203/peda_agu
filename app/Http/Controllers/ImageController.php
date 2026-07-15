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
        $storagePath = storage_path('app');
        $manager = new ImageManager(new Driver());
        $htmlOutput = '';

        if (!empty($files)):
            foreach ($files as $file):
                $extension = $file->getClientOriginalExtension();
                if (empty($extension)) continue;
                $realname  = $file->getClientOriginalName();
                $filename  = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;

                Storage::put('private/images/' . $filename, file_get_contents($file), 'private');

                @mkdir($storagePath . '/public/images/origin',       0755, true);
                @mkdir($storagePath . '/public/images/thumb_360x200', 0755, true);
                @mkdir($storagePath . '/public/images/thumb_50',      0755, true);

                $manager->decode($file->getRealPath())
                    ->save($storagePath . '/public/images/origin/' . $filename);

                $manager->decode($file->getRealPath())
                    ->scaleDown(width: 360)
                    ->save($storagePath . '/public/images/thumb_360x200/' . $filename);

                $manager->decode($file->getRealPath())
                    ->scaleDown(height: 50)
                    ->save($storagePath . '/public/images/thumb_50/' . $filename);

                $htmlOutput .= '<div class="col-sm-6 col-md-4 items draggable-element text-center">
                <input type="hidden" name="hinhanh_aliasname[]" value="' . $filename . '" readonly/>
                <input type="hidden" name="hinhanh_filename[]" class="form-control" value="' . $realname . '" />
                  <a href="' . env('APP_URL') . 'storage/images/origin/' . $filename . '" class="image-popup">
                    <div class="portfolio-masonry-box">
                      <div class="portfolio-masonry-img">
                        <img src="' . env('APP_URL') . 'storage/images/thumb_360x200/' . $filename . '" class="thumb-img img-fluid" alt="' . $filename . '">
                      </div>
                      <div class="portfolio-masonry-detail">
                        <p>' . $realname . '</p>
                      </div>
                    </div>
                  </a>
                  <a href="' . env('APP_URL') . $locale . '/image/delete/' . $filename . '" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
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
