<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date|before:'. Carbon::now()->subYears(12),
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name',
        ];
    }

    public function messages()
    {
        return
        [
            'name.required' => 'Обязательное поле Имя',
            'role.exists' => 'Такой роли не существует'
        ];
    }
}
