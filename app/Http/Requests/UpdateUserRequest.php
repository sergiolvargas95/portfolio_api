<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:200',
            'password' => 'required|min:8',
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg, png, jpg|max:2048',
            'profesional_degree' => 'nullable|string|max:100',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name should not be more than 200 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Type an Email',
            'password.required' => 'password is required',
            'password.min' => 'password should have at least 8 characters',
        ];
    }
}
