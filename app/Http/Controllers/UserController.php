<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DMDiaChi;
use App\Models\User;
use Validator;
use Session;

class UserController extends Controller
{
    // CẢI TIẾN: Để Key và Value gốc là Tiếng Anh chuẩn hóa làm nhãn dịch (Translation Keys)
    private static $roles = array(
        'Admin'     => 'Admin Role',
        'Manager'   => 'Manager Role',
        'Updater'   => 'Updater Role',
        'Consulter' => 'Consulter Role'
    );

    // Hàm bốc mảng và dịch động theo Locale hiện tại của hệ thống
    static function getRoles()
    {
        $translatedRoles = array();
        foreach (self::$roles as $key => $value) {
            $translatedRoles[$key] = __($value);
        }
        return $translatedRoles;
    }

    static function is_roles($roles)
    {
        $arr = explode(",", $roles);
        $roles_arr = Session::get('user.roles');
        foreach ($arr as $key => $value) {
            if (in_array($value, $roles_arr)) {
                return true;
            }
        }
        return false;
    }

    function list()
    {
        $users = User::orderBy('updated_at', 'desc')->get()->toArray();

        $users = array_map(function ($user) {
            if (!isset($user['_id']) && isset($user['id'])) {
                $user['_id'] = is_object($user['id']) ? (string) $user['id'] : $user['id'];
            } elseif (isset($user['_id']) && is_object($user['_id'])) {
                $user['_id'] = (string) $user['_id'];
            }
            return $user;
        }, $users);

        // Đảm bảo truyền mảng roles đã được dịch qua hàm getRoles()
        return view('Admin.User.list', ['users' => $users, 'roles' => self::getRoles()]);
    }

    function add()
    {
        $address = DMDiaChi::where('matructhuoc', 'exists', false)->orWhere('matructhuoc', '=', '')->get();
        // CẬP NHẬT: Đổi từ self::$roles thành self::getRoles() để trang thêm mới cũng được chuyển ngữ các hộp chọn
        return view('Admin.User.add', ['address' => $address, 'roles' => self::getRoles()]);
    }

    function create(Request $request, $locale = '')
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'fullname' => 'required',
            'phone'    => ['required', 'regex:/^(03|05|07|08|09)\d{8}$/'],
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $user = new User();
        $user->fullname = $data['fullname'];
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->roles = isset($data['roles']) ? $data['roles'] : '';
        $user->phone = $data['phone'];
        $user->active = isset($data['active']) ? intval($data['active']) : 0;
        $user->save();
        return redirect()->intended(env('APP_URL') . $locale . '/admin/user');
    }

    function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
        ]);
        if ($validator->fails()) {
            echo 'Địa chỉ email đã tồn tại, vui lòng chọn địa chỉ khác.';
        } else if ($data['password'] != $data['confirm_password']) {
            echo 'Mật khẩu không trùng khớp.';
        } else {
            $user = new User();
            $user->username = $data['username'];
            $user->fullname = $data['fullname'];
            $user->password = Hash::make($data['password']);
            $user->roles = array('Customer');
            $user->phone = '';
            $user->active = 1;
            if ($user->save()) {
                echo 'Đăng ký thành công, vui lòng đăng nhập để giao dịch nhanh chóng.';
            } else {
                echo 'Đăng ký thất bại.';
            }
        }
    }

    function edit(Request $request, $locale = '', $id = '')
    {
        $destination = $request->get('destination');
        $user = User::find($id);
        $address = DMDiaChi::where('matructhuoc', 'exists', false)->orWhere('matructhuoc', '=', '')->get();

        $address_1 = (isset($user['address'][0]) && $user['address'][0])
            ? DMDiaChi::where('matructhuoc', '=', $user['address'][0])->get()
            : '';

        $address_2 = (isset($user['address'][1]) && $user['address'][1])
            ? DMDiaChi::where('matructhuoc', '=', $user['address'][1])->get()
            : '';

        // CẬP NHẬT: Đổi từ self::$roles thành self::getRoles() để giao diện chỉnh sửa hiển thị chuẩn ngôn ngữ
        return view('Admin.User.edit', [
            'user' => $user,
            'address' => $address,
            'address_1' => $address_1,
            'address_2' => $address_2,
            'roles' => self::getRoles(),
            'destination' => $destination
        ]);
    }

    function update(Request $request, $locale = '')
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . $data['id'] . ',_id',
            'fullname' => 'required',
            'phone'    => ['required', 'regex:/^(03|05|07|08|09)\d{8}$/'],
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($data['id']);
        if (isset($data['password']) && $data['password']) {
            $password = Hash::make($data['password']);
        } else {
            $password = $user['password'];
        }

        $user->fullname = $data['fullname'];
        $user->password = $password;
        $user->roles = isset($data['roles']) ? $data['roles'] : '';
        $user->phone = $data['phone'];
        $user->active = isset($data['active']) ? intval($data['active']) : 0;
        $user->save();

        if (isset($data['destination']) && $data['destination']) {
            return redirect()->intended(env('APP_URL') . $data['destination']);
        } else {
            return redirect()->intended(env('APP_URL') . $locale . '/admin/user');
        }
    }

    function delete(Request $request, $locale = '', $id = '')
    {
        $destination = $request->get('destination');
        User::destroy($id);
        if ($destination) {
            return redirect()->intended($destination);
        } else {
            return redirect()->intended(env('APP_URL') . $locale . '/admin/user');
        }
    }

    function customer()
    {
        $users = User::where('roles', '=', 'Customer')->orderBy('updated_at', 'desc')->get()->toArray();
        return view('Admin.Customer.index', ['users' => $users]);
    }

    function customerUpdate(Request $request)
    {
        $data = $request->all();
        $password = isset($data['password']) ? $data['password'] : '';
        $confirm_password = isset($data['confirm_password']) ? $data['confirm_password'] : '';

        if ($password && $password === $confirm_password) {
            $user = User::find($data['id']);
            $user->name = $data['name'];
            $user->phone = $data['phone'];
            $user->password = Hash::make($password);
            $user->save();
            $request->session()->put('customer', User::find($data['id']));
            echo 'Cập nhật thành công.';
        } else if (!$password) {
            $user = User::find($data['id']);
            $user->name = $data['name'];
            $user->phone = $data['phone'];
            $user->save();
            $request->session()->put('customer', User::find($data['id']));
            echo 'Cập nhật thành công.';
        } else {
            echo 'Mật khẩu không trùng khớp';
        }
    }

    function change_password(Request $request)
    {
        return view('Admin.User.change_password');
    }

    function update_password(Request $request, $locale = '')
    {
        $data = $request->all();
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['old_password']])) {
            return redirect(env('APP_URL') . $locale . '/admin/user/change-password')->withErrors(['msg' => 'Mật khẩu cũ không trùng khớp'])->withInput();
        } else {
            if ($data['password'] !== $data['confirm_password']) {
                return redirect(env('APP_URL') . $locale . '/admin/user/change-password')->withErrors(['msg' => 'Mật khẩu mới không trùng khớp'])->withInput();
            } else {
                $user = User::find($data['id']);
                $user->password = Hash::make($data['password']);
                $user->save();
                return redirect(env('APP_URL') . $locale . '/admin/user/change-password')->withErrors(['msg' => 'Thay đổi mật khẩu thành công'])->withInput();
            }
        }
    }
}
