<?php

namespace App\Http\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class RequestUpadateUserPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'=>'required|min:8',
            'new_password'=>'required|min:8'

        ];
    }

     public function messages()
    {
        return [
            'old_password.required'=>"Ввдети старый пароль",
            'old_password.min'=>"Пароль должнен быть менее 8 символов",
            'new_password.required'=>"Новый пароль",
            'new_password.min'=>"Пароль должнен быть менее 8 символов"
        ];
    }
}