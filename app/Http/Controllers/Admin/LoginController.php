<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;
class LoginController extends Controller
{
    public function getLogin()
    {
    	return view('backend.auth.login');
    }
    public function postLogin(LoginRequest $request)
    {
    	$auth = array(
            'name' => $request->username,
            'password' => $request->password
        );
        $remember = $request->remember ? true : false;
        if (Auth::attempt($auth, $remember)){
            if (Auth::user()->level == 1 ) {
                return redirect('backend')->with('flash_notice', 'Đăng nhập thành công.');
            }else{
                 return redirect('login')
                 ->with('flash_error', 'Bạn không có quyền vào khu vực này !')
                 ->withInput();
            }
        }else{
            return redirect('login')
                 ->with('flash_error', 'Tên đăng nhập hoặc mật khẩu không đúng.')
                 ->withInput();
        }
    }
}
