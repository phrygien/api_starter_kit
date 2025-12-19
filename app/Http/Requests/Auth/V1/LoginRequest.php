<?php

namespace App\Http\Requests\Auth\V1;

use Illuminate\Foundation\Http\FormRequest;
use Mecene\Modules\Identity\DTOs\LoginObject;

class LoginRequest extends FormRequest
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
            'email' => [ 'required', 'email', 'max:255' ],
            'password' => [ 'required', 'string', 'max:255' ]
        ];
    }

    public function payload(): LoginObject
    {
        return new LoginObject(
            email: $this->string('email')->toString(),
            password: $this->string('password')->toString()
        );
    }
}
