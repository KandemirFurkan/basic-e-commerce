<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
             'name'=>'string|required|min:2',
             'email'=>'required|min:2',
             'phone'=>'required|min:2',
             'address'=>'required|min:2',
             'country'=>'required|min:2',
             'city'=>'required|min:2',
             'district'=>'required|min:2',

         ];
     }

     public function messages(): array
     {
         return [
             'name.required' =>__('Başlık kısmı boş olamaz'),
             'name.min' =>__('2 karakterden az olamaz'),
             'name.string' =>__('Sadece karakter kullanınız'),
             'email.required' =>__('Başlık kısmı boş olamaz'),
             'email.min' =>__('2 karakterden az olamaz'),
             'phone.required' =>__('Başlık kısmı boş olamaz'),
             'phone.min' =>__('2 karakterden az olamaz'),
             'address.required' =>__('Başlık kısmı boş olamaz'),
             'address.min' =>__('2 karakterden az olamaz'),
             'country.required' =>__('Başlık kısmı boş olamaz'),
             'country.min' =>__('2 karakterden az olamaz'),
             'city.required' =>__('Başlık kısmı boş olamaz'),
             'city.min' =>__('2 karakterden az olamaz'),
             'district.required' =>__('Başlık kısmı boş olamaz'),
             'district.min' =>__('2 karakterden az olamaz'),

         ];
     }




}
