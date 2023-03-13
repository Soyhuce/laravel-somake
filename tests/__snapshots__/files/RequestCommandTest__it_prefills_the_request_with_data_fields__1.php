<?php

namespace App\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'email_verified_at' => ['nullable'],
            'role' => ['required', \Illuminate\Validation\Rule::enum(\Domain\User\Enums\Role::class)],
        ];
    }
}
