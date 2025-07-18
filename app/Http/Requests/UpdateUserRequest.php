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
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'weight' => 'numeric',
            'height' => 'numeric',
            'gender' => 'in:masculino,feminino,outro',
            'activity_level' => 'in:sedentário,leve,moderado,intenso',
            'password' => 'string|min:6',
        ];
    }
}
