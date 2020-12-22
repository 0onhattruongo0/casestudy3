<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRegisterRequest extends FormRequest
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
            'name' => 'required|min:2',
            'username' => 'required|min:2|max:30|unique:users',
            'email' => 'required|email|min:2|unique:users',
            'password' => 'required|min:2|max:30',
        ];
    }
    public function messages()
    {
        $messages = [
            'name.required' => 'Bạn phải điền tên!',
            'name.min'=>'Tên phải có từ 2 ký tự',
            'username.required' => 'Bạn phải điền tên đăng nhập',
            'username.min' => 'Tên đăng nhập phải có ít nhất 2 ký tự',
            'username.max'=> 'Tên đăng nhập phải có ít hơn 30 ký tự',
            'username.unique' =>'Tên đăng nhập đã tồn tại',
            'email.required' => 'Bạn phải điền email',
            'email.min' => 'Email phải có ít nhất 2 ký tự',
            'email.email'=>'Sai định dạng email',
            'email.unique' =>'Email đã tồn tại',
            'password.required' => 'Bạn phải điền mật khẩu!',
            'password.min'=>'Mật khẩu phải có từ 2 ký tự',
            'password.max'=> 'Mật khẩu phải có ít hơn 30 ký tự',
        ];

        return $messages;

    }
}
