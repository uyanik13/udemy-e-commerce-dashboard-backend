<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(empty(auth()->user())){
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:161',
            'content' => 'required',
            'post_category_id' => 'required|exists:post_categories,id',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The Title field is required',
            'title.max' => 'The Title field may not be greater than :max characters',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id ?? null,
        ]);
    }
}
