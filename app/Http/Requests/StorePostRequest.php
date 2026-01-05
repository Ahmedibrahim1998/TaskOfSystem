<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('posts')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'content' => 'required|string|min:10',
            'slug' => [
                'nullable',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique('posts')
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'حقل العنوان مطلوب',
            'title.min' => 'يجب أن يكون العنوان 3 أحرف على الأقل',
            'title.max' => 'يجب ألا يزيد العنوان عن 255 حرف',
            'title.unique' => 'لديك منشور بنفس العنوان مسبقاً',
            
            'content.required' => 'حقل المحتوى مطلوب',
            'content.min' => 'يجب أن يكون المحتوى 10 أحرف على الأقل',
            
            'slug.alpha_dash' => 'يجب أن يحتوي الرابط على أحرف لاتينية وأرقام وشرطات فقط',
            'slug.max' => 'يجب ألا يزيد الرابط عن 255 حرف',
            'slug.unique' => 'هذا الرابط مستخدم مسبقاً',
        ];
    }
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->slug) {
            $this->merge([
                'slug' => strtolower(str_replace(' ', '-', $this->slug))
            ]);
        } else {
            $this->merge([
                'slug' => \Str::slug($this->title)
            ]);
        }
    }
}
