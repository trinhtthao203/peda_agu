<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Config;

class FileController extends Controller
{
    function uploads(Request $request, $locale = '')
    {
        if ($request->hasFile('dinhkem_files')) {
            $files = $request->file('dinhkem_files');

            foreach ($files as $file):
                $extension = $file->getClientOriginalExtension();
                if (empty($extension)) continue;

                $realname = $file->getClientOriginalName();
                $filename = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;
                $storagePath = 'files/' . $filename;
                Storage::disk('public')->put($storagePath, file_get_contents($file));

                Storage::put($storagePath, file_get_contents($file), 'public');
                $size = Storage::disk('public')->exists($storagePath) ? Storage::disk('public')->size($storagePath) : $file->getSize();
                echo '<div class="form-group row items draggable-element">
                    <input type="hidden" name="file_aliasname[]" value="' . $filename . '" readonly />
                    <input type="hidden" name="file_filename[]" value="' . $realname . '" class="form-control" />
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="hidden" name="file_size[]" value="' . $size . '" class="form-control">
                            <input type="hidden" name="file_type[]" value="' . strtolower($extension) . '" class="form-control">
                            <input type="text" name="file_title[]" placeholder="Chú thích tập tinh đính kèm - Bấm chuột phải để lấy mã nhúng" value="' . $realname . '" class="form-control">
                            <div class="input-group-append">
                                <a href="' . env('APP_URL') . $locale . '/file/delete/' . $filename . '" class="btn btn-info btn-circle delete_file" onclick="return false;" style="margin-left:2px;"><i class="mdi mdi-delete"></i></a>
                            </div>
                        </div>
                    </div>
                </div>';
            endforeach;
        }
    }

    function fileUploads(Request $request, $fileID = '')
    {
        if ($request->hasFile($fileID)) {
            $files = $request->file($fileID);
            $arr_extension = Config::get('app.arr_extension', ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar']);

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                if (in_array(strtolower($extension), $arr_extension)) {
                    $realname = $file->getClientOriginalName();
                    $filename = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;
                    Storage::disk('public')->put('files/' . $filename, file_get_contents($file));
                    $size = Storage::disk('public')->size('files/' . $filename);
                    echo '<div class="row form-group items draggable-element">
                        <input type="hidden" name="' . $fileID . '-aliasname[]" value="' . $filename . '" readonly/>
                        <input type="hidden" name="' . $fileID . '-filename[]" value="' . $realname . '" class="form-control"/>
                        <div class="col-2"></div>
                        <div class="col-10">
                            <div class="input-group">
                              <div class="input-group-prepend" style="margin-right:5px;padding-top:3px;font-size:20px;cursor:pointer;"><i class="fas fa-file-alt text-success"></i></div>
                              <input type="hidden" name="' . $fileID . '-size[]" value="' . $size . '" class="form-control input-sm">
                              <input type="hidden" name="' . $fileID . '-type[]" value="' . strtolower($extension) . '" class="form-control form-control-sm">
                              <input type="text" name="' . $fileID . '-title[]" placeholder="Chú thích tập tinh đính kèm" value="' . $realname . '" class="form-control form-control-sm">
                              <div class="input-group-append">
                                <a href="' . env('APP_URL') . 'file/delete/' . $filename . '" class="delete_file" onclick="return false;" style="margin-left:2px;font-size:20px;"><i class="mdi mdi-delete text-danger"></i></a>
                              </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
    }

    function upload_json(Request $request, $fileID = '')
    {
        if ($request->hasFile($fileID)) {
            $file = $request->file($fileID);
            $arr_extension = Config::get('app.arr_extension', ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar']);
            $extension = $file->getClientOriginalExtension();

            if (in_array(strtolower($extension), $arr_extension)) {
                $realname = $file->getClientOriginalName();
                $filename = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;
                Storage::disk('public')->put('files/' . $filename, file_get_contents($file));
                $size = Storage::disk('public')->size('files/' . $filename);

                $arr_file = array(
                    'filename' => $realname,
                    'aliasname' => $filename,
                    'filetype' => $extension,
                    'filesize' => $size,
                    'delete_path' => env('APP_URL') . 'file/delete/' . $filename
                );
                echo json_encode($arr_file);
                return;
            }
        }
        echo 'Failed';
    }

    function uploadMinhChung(Request $request, $fileID = '')
    {
        if ($request->hasFile($fileID)) {
            $files = $request->file($fileID);
            $arr_extension = Config::get('app.arr_extension', ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar']);

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                if (in_array(strtolower($extension), $arr_extension)) {
                    $realname = $file->getClientOriginalName();
                    $filename = date("YmdHis") . '_' . strtolower(uniqid()) . '.' . $extension;
                    Storage::disk('public')->put('files/' . $filename, file_get_contents($file));
                    $size = Storage::disk('public')->size('files/' . $filename);

                    echo '<div class="row form-group items draggable-element">
                        <input type="hidden" name="' . $fileID . '-aliasname[]" value="' . $filename . '" readonly/>
                        <input type="hidden" name="' . $fileID . '-filename[]" value="' . $realname . '" class="form-control"/>
                        <div class="col-2"></div>
                        <div class="col-10">
                            <div class="input-group">
                              <div class="input-group-prepend" style="margin-right:5px;padding-top:3px;font-size:20px;cursor:pointer;"><i class="fas fa-file-alt text-success"></i></div>
                              <input type="hidden" name="' . $fileID . '-size[]" value="' . $size . '" class="form-control input-sm">
                              <input type="hidden" name="' . $fileID . '-type[]" value="' . strtolower($extension) . '" class="form-control form-control-sm">
                              <input type="text" name="' . $fileID . '-title[]" placeholder="Chú thích tập tinh đính kèm" value="' . $realname . '" class="form-control form-control-sm">
                              <div class="input-group-append">
                                <a href="' . env('APP_URL') . 'file/delete/' . $filename . '" class="delete_file" onclick="return false;" style="margin-left:2px;font-size:20px;"><i class="mdi mdi-delete text-danger"></i></a>
                              </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
    }

    function download(Request $request, $filename)
    {
        return Storage::download('files/' . $filename);
    }

    function delete(Request $request, $locale = '', $filename = '')
    {
        Storage::delete('files/' . $filename);
    }

    static function remove($filename)
    {
        Storage::delete('files/' . $filename);
    }

    static function removeReport($filename)
    {
        Storage::delete('files/report/' . $filename);
    }
}
