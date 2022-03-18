<?php

namespace App\Admin\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \Domain\User\Models\User
 */
class UserResource extends JsonResource
{
    /**
    * @param \Illuminate\Http\Request $request
    * @return array<string, mixed>
    */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_verified' => $this->is_verified,
        ];
    }
}
