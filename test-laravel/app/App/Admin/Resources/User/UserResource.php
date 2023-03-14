<?php declare(strict_types=1);

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
        ];
    }
}
