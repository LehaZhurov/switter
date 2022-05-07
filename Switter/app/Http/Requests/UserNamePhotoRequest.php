<?php

namespace App\Http\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserNamePhotoRequest extends FormRequest
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
            'name'=>'max:16|unique:users',
            'photo'=>'image|mimes:jpeg,bmp,png'

        ];
    }

     public function messages()
    {
        return [
            'name.unique'=>"Пользователь с таким именем уже существует",
            'name.min'=>"Имя должно быть более 5 символов",
            'name.max'=>"Имя должно быть не более 16 символов",
            'photo.image'=>"файл не является изображение",
            'photo.mimes'=>"не известный тип файла"

        ];
    }
}