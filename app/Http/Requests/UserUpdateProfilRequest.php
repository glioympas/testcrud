<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfilRequest extends FormRequest
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
            'name' => 'required|min:5|max:40',
            'email' => 'required|email|unique:users,email,'.request()->edit_user_id, //Ignore user's email that wants to update his profile.,
            'current_password' => 'required',
            'new_password' => 'nullable|min:6|max:20'
        ];
    }
}
