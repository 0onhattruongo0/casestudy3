<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUserRequest extends FormRequest
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
            'name' => 'required|min:2|max:30',
            'username' => 'required|min:2|max:30|unique:users,username,'.$this->id,
            'email' => 'required|min:2|unique:users,email,'.$this->id,
            'password' => 'required|min:2|max:30',
            'roles' => 'required',

        ];
    }
}
