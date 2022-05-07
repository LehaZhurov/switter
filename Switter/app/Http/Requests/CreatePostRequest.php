<?php

namespace App\Http\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'text_post'=>'required|min:1',
            'images_post'=>'image|mimes:jpeg,bmp,png'

        ];
    }

     public function messages()
    {
        return [
            'text_post.required'=>"Пост не может быть пустым",
            'text_post.min'=>"Пост должнен быть менее 1 символа",
            'images_post.image'=>"Можно прикреплять только фото",
            'images_post.mimes'=>"Потдерживаемые форматы jpeg,bmp,png"
        ];
    }
}