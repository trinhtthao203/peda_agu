<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ObjectController;
use App\Models\Views;
use App\Models\ViewsLog;
use Location;use Session;

class ViewsController extends Controller
{
    //

    static function visit($request) {
        $path = $request->path();
        $ip = $request->ip();
        $id_user = $request->session()->get('user._id');
        $db = new Views();
        $db->path = $path;
        $db->browswer = $request->userAgent();
        $db->ip = $ip;
        $db->location = Location::get($ip);
        $db->id_user = $id_user ? ObjectController::ObjectId($id_user) : '';
        $db->save();
    }

    static function add_views(Request $request) {
        $fullUrl = $request->fullUrl();
        $browser = request()->userAgent();
        $ip = request()->ip();
        $location = Location::get($ip);
        $id_user = Session::get('user._id');
        $v = Views::where('fullUrl', '=', $fullUrl)->first();
        if($v){
            Views::where('fullUrl', '=', $fullUrl)->increment("views");
        } else {
            $vi = new Views();
            $vi->fullUrl = $fullUrl;
            $vi->views = 1;
            $vi->save();
        }
        $log = new ViewsLog();
        $log->fullUrl = $fullUrl;
        $log->browser = $browser;
        $log->ip = $request->ip();
        $log->location = $location;
        $log->id_user = $id_user ? ObjectController::ObjejctId($id_user) : '';
        $log->save();
    }
}
