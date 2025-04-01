<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|string|max:200',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'repository_url' => 'required|url|max:255',
            'demo_url' => 'nullable|url|max:255',
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.max' => 'The title must not exceed 200 characters.',
            'description.required' => 'The description is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Allowed image formats are JPEG, PNG, JPG, and WEBP.',
            'repository_url.required' => 'The repository URL is required.',
            'repository_url.url' => 'The repository URL must be a valid URL.',
            'user_id.required' => 'The user is required.',
            'user_id.exists' => 'The selected user is not valid.'
        ];
    }
}
