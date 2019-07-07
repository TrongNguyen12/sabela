<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtName'   => 'required|unique:users,name',
            'txtPass'   => 'required',
            'txtRePass' => 'required|same:txtPass',
            'txtEmail'  => 'required|unique:users,email|regex:/^[a-z][a-z0-9]*(_[a-z0-9]+)*(\.[a-z0-9]+)*@[a-z0-9]([a-z0-9-][a-z0-9]+)*(\.[a-z]{2,4}){1,2}$/',
        ];
    }

    public function messages()
    {
        return [
            'txtName.required'      => 'Bạn chưa nhập tài khoản !',
            'txtName.unique'        => 'Tài khoản này đã tồn tại !',
            'txtPass.required'      => 'Bạn chưa nhập mật khẩu !',
            'txtRePass.required'    => 'Bạn chưa nhập lại mật khẩu !',
            'txtRePass.same'        => 'Mật khẩu nhập lại không đúng !',
            'txtEmail.required'     => 'Bạn chưa nhập email !',
            'txtEmail.unique'       => 'Email này đã tồn tại !',
            'txtEmail.regex'        => 'Email không hợp lệ !',
        ];
    }
}
