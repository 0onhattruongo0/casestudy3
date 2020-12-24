<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'email' => 'required|email|min:2',
            'message' => 'required|min:2',
        ];
    }
    public function messages()
    {
        $messages = [
            'name.required' => 'Bạn phải điền tên!',
            'name.min'=>'Tên phải có từ 2 ký tự',
            'email.required' => 'Bạn phải điền email',
            'email.min' => 'Email phải có ít nhất 2 ký tự',
            'email.email'=>'Sai định dạng email',
            'message.required' => 'Bạn phải điền tin nhắn!',
            'message.min'=>'Tin nhắn phải có từ 2 ký tự',
        ];

        return $messages;

    }
}
