<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Let the controller handle the authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $postId = $this->route('post')->id;
        
        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'min:3',
                'max:255',
                \Illuminate\Validation\Rule::unique('posts')->ignore($postId)
            ],
            'content' => 'sometimes|required|string|min:10',
            'slug' => [
                'sometimes',
                'nullable',
                'string',
                'alpha_dash',
                'max:255',
                \Illuminate\Validation\Rule::unique('posts')->ignore($postId)
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'حقل العنوان مطلوب',
            'title.min' => 'يجب أن يكون العنوان 3 أحرف على الأقل',
            'title.max' => 'يجب ألا يزيد العنوان عن 255 حرف',
            'title.unique' => 'هذا العنوان مستخدم مسبقاً',
            
            'content.required' => 'حقل المحتوى مطلوب',
            'content.min' => 'يجب أن يكون المحتوى 10 أحرف على الأقل',
            
            'slug.alpha_dash' => 'يجب أن يحتوي الرابط على أحرف لاتينية وأرقام وشرطات فقط',
            'slug.max' => 'يجب ألا يزيد الرابط عن 255 حرف',
            'slug.unique' => 'هذا الرابط مستخدم مسبقاً',
        ];
    }
}