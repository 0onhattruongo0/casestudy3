<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUserLoginRequest extends FormRequest
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
            'username' => 'required|min:2|max:30',
            'password' => 'required|min:2|max:30',
        ];
    }
    public function messages()
    {
        $messages = [
            'username.required' => 'Bạn phải điền tên đăng nhập',
            'username.min' => 'Tên đăng nhập phải có ít nhất 2 ký tự',
            'username.max'=> 'Tên đăng nhập phải có ít hơn 30 ký tự',
            'password.required' => 'Bạn phải điền mật khẩu!',
            'password.min'=>'Mật khẩu phải có từ 2 ký tự',
            'password.max'=> 'Mật khẩu phải có ít hơn 30 ký tự',
        ];

        return $messages;

    }
}
