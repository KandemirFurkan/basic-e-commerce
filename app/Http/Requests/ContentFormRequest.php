<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentFormRequest extends FormRequest
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
            'email'=>'required|email',
            'subject'=>'required|string|min:5',
            'message'=>'required|string|min:10'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' =>'Ad kısmı boş olamaz',
            'email.required' =>'Lütfen e-posta kısmını kontrol ediniz.',
            'subject.required' =>'Konu boş ya da 5 karakterden az olamaz!',
            'message.required' =>'Lütfen daha uzun bir mesaj yazınız.',
        ];
    }

}
