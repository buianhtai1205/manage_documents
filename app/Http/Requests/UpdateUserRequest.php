<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255',Rule::unique('users')->ignore($this->user->id)],
            'password' => 'required|string|min:6|',
            'document_id' => 'required|integer|exists:documents,id',
            'role' => 'required|string|in:admin,super_admin,user',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be less than 255 characters',
            'username.required' => 'Username is required',
            'username.string' => 'Username must be a string',
            'username.max' => 'Username must be less than 255 characters',
            'username.unique' => 'Username already exists',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 6 characters',
            'document_id.required' => 'Has error in coding',
            'document_id.integer' => 'Has error in coding',
            'document_id.exists' => 'Has error in coding',
            'role.required' => 'Role is required',
            'role.string' => 'Role must be a string',
            'role.in' => 'Role must be admin, super_admin or user',
        ];
    }
}
