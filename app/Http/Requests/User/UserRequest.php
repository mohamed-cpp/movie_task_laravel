<?php

namespace App\Http\Requests\User;

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
        $rules = [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . request()->all()['id_user'],
            'birthdate' => 'required|date',
            'password' => 'sometimes|nullable|string|min:6|confirmed'
        ];
        if ($this->isMethod("POST")){
            $rules['password'] = 'required|string|min:6|confirmed';
        }
        return $rules;
    }
}
