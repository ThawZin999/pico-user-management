<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $userId = $this->route('user')->id;

        return [
            'name' =>'required|string',
            'username' => ['required', Rule::unique('users')->ignore($userId)],
            'role_id' =>'required|exists:roles,id',
            'phone' =>'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'address' => 'nullable|string',
            'password' => 'nullable|string',
            'gender' => ['required', Rule::in(['0', '1'])],
            'is_active' =>'required|boolean'
        ];
    }
}
