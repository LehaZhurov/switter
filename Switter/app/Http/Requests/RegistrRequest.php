<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrRequest extends FormRequest
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
            'name'=>'required|min:5|max:16|unique:users',
            'login'=>'required|min:8|alpha_dash',
            'password'=>'required|min:8'
        ];
    }

     public function messages()
    {
        return [
            'name.required'=>"Введите имя",
            'name.unique'=>"Пользователь с таким именем уже существует",
            'name.min'=>"Имя должно быть более 5 символов",
            'name.max'=>"Имя должно быть не более 16 символов",
            'login.required'=>"Введите login",
            'login.min'=>"Login должен быть менее 8 символов",
            'login.alpha_dash'=>"Недопустимый  Login",
            'password.required'=>"Введите пароль",
            'password.min'=>"Пароль должнен быть менее 8 символов"
        ];
    }
}
