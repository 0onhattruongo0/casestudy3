<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUserEditRequest extends FormRequest
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
            'oldpassword' => 'required|min:2|max:30',
            'newpassword' => 'required|min:2|max:30',
        ];
    }
    public function messages()
    {
        $messages = [
            'oldpassword.required' => 'Bạn phải điền mật khẩu cũ!',
            'oldpassword.min'=>'Mật khẩu cũ phải có từ 2 ký tự',
            'oldpassword.max'=> 'Mật khẩu cũ phải có ít hơn 30 ký tự',
            'newpassword.required' => 'Bạn phải điền mật khẩu mới!',
            'newpassword.min'=>'Mật khẩu mới phải có từ 2 ký tự',
            'newpassword.max'=> 'Mật khẩu mới phải có ít hơn 30 ký tự',
        ];

        return $messages;

    }
}
