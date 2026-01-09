<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // لو عايز تحد من التعليقات للمستخدمين المسجلين فقط، غيّرها لـ auth()->check()
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array<int, string>>
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'min:3', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'body.required' => 'حقل التعليق مطلوب',
            'body.string'   => 'يجب أن يكون التعليق نصياً',
            'body.min'      => 'يجب أن يكون التعليق على الأقل 3 أحرف',
            'body.max'      => 'يجب ألا يزيد التعليق عن 1000 حرف',
        ];
    }
}