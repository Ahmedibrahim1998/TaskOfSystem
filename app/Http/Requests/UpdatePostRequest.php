<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Post;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, string|array<int, string|\Illuminate\Validation\Rules\Unique>>
     */
    public function rules(): array
    {
        /** @var Post $post */
        $post = $this->route('post');

        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'min:3',
                'max:255',
                // العنوان فريد للمستخدم نفسه فقط، مع استثناء المنشور الحالي
                Rule::unique('posts')
                    ->where('user_id', auth()->id())
                    ->ignore($post->id),
            ],
            'content' => [
                'sometimes',
                'required',
                'string',
                'min:10',
            ],
            'slug' => [
                'sometimes',
                'nullable',
                'string',
                'alpha_dash',
                'max:255',
                // الـ slug فريد عام (مش لكل مستخدم)، مع استثناء المنشور الحالي
                Rule::unique('posts')->ignore($post->id),
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
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
            'slug.unique'     => 'هذا الرابط مستخدم مسبقاً في منشور آخر',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->filled('title') && ! $this->has('slug')) {
            // لو المستخدم عدّل العنوان وما غيّرش الـ slug، نولّده تلقائيًا
            $this->merge([
                'slug' => Str::slug($this->title),
            ]);
        }

        if ($this->filled('slug')) {
            $this->merge([
                'slug' => strtolower(str_replace(' ', '-', $this->slug)),
            ]);
        }
    }
}