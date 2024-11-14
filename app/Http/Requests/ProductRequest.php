<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

     public function rules(): array
     {
         return [
             'name'=>'required|string|min:3',
             'content'=>'required|min:10',

         ];
     }

     public function messages(): array
     {
         return [
             'name.required' =>'Başlık kısmı boş olamaz',
             'name.min' =>'3 karakterden az olamaz',
             'name.string' =>'Sadece karakter kullanabilirsiniz',
             'content.required' =>'Slogan kısmı boş bırakılamaz',
             'content.min' =>'10 karakterden az olamaz',
         ];
     }

}
