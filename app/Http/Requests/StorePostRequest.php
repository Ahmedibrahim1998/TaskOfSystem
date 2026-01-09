<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // لو عايز تقصر إنشاء المنشورات على المستخدمين المسجلين فقط
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array<int, string|\Illuminate\Validation\Rules\Unique>>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('posts')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
            'content' => ['required', 'string', 'min:10'], // غيرتها للصيغة الموحدة
            'slug' => [
                'nullable',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique('posts'),
            ],
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
            'title.required' => 'حقل العنوان مطلوب',
            'title.min'      => 'يجب أن يكون العنوان 3 أحرف على الأقل',
            'title.max'      => 'يجب ألا يزيد العنوان عن 255 حرف',
            'title.unique'   => 'لديك منشور بنفس العنوان مسبقاً',

            'content.required' => 'حقل المحتوى مطلوب',
            'content.min'      => 'يجب أن يكون المحتوى 10 أحرف على الأقل',

            'slug.alpha_dash' => 'يجب أن يحتوي الرابط على أحرف لاتينية وأرقام وشرطات فقط',
            'slug.max'        => 'يجب ألا يزيد الرابط عن 255 حرف',
            'slug.unique'     => 'هذا الرابط مستخدم مسبقاً',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $slug = $this->slug 
            ? strtolower(str_replace(' ', '-', $this->slug))
            : Str::slug($this->title);

        $this->merge([
            'slug' => $slug,
        ]);
    }
}