<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (empty(auth()->user())) {
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
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title field may not be greater than :max characters.',
        ];
    }


}
