<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => ['required', 'string', 'min:3', 'max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'حقل التعليق مطلوب',
            'body.string' => 'يجب أن يكون التعليق نصياً',
            'body.min' => 'يجب أن يكون التعليق على الأقل 3 أحرف',
            'body.max' => 'يجب ألا يزيد التعليق عن 1000 حرف',
        ];
    }
}