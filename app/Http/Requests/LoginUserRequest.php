<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
     * @return array<string, string|array<int, string>>
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ];
        // أو بالصيغة القديمة المختصرة (مسموحة برضو):
        // return [
        //     'email'    => 'required|email',
        //     'password' => 'required',
        // ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'حقل البريد الإلكتروني مطلوب',
            'email.email'       => 'يجب إدخال بريد إلكتروني صالح',
            'password.required' => 'حقل كلمة المرور مطلوب',
        ];
    }
}