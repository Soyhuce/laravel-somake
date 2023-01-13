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
            'email_verified_at' => ['nullable', 'string', 'date_format:Y-m-d H:i:s'],
        ];
    }
}
