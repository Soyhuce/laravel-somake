<?php declare(strict_types=1);

namespace Domain\User\Models
{
    /**
     * @method static \IdeHelper\Domain\User\Models\UserQuery query()
     * @mixin \IdeHelper\Domain\User\Models\UserQuery
     */
    class User
    {
        /**
         * Create a new Eloquent model instance.
         */
        public function __construct(array $attributes = [])
        {
        }
    }
}

namespace IdeHelper\Domain\User\Models
{
    /**
     * @method \IdeHelper\Domain\User\Models\UserQuery whereId(int|string $value)
     * @method \IdeHelper\Domain\User\Models\UserQuery whereName(string $value)
     * @method \IdeHelper\Domain\User\Models\UserQuery whereEmail(string $value)
     * @method \IdeHelper\Domain\User\Models\UserQuery whereEmailVerifiedAt(\Illuminate\Support\Carbon|string|null $value)
     * @method \IdeHelper\Domain\User\Models\UserQuery wherePassword(string $value)
     * @method \IdeHelper\Domain\User\Models\UserQuery whereRememberToken(string|null $value)
     * @method \IdeHelper\Domain\User\Models\UserQuery whereCreatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \IdeHelper\Domain\User\Models\UserQuery whereUpdatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \Domain\User\Models\User create(array $attributes = [])
     * @method \Domain\User\Models\User|\Illuminate\Database\Eloquent\Collection|null find($id, array $columns = ['*'])
     * @method \Illuminate\Database\Eloquent\Collection findMany($id, array $columns = ['*'])
     * @method \Domain\User\Models\User|\Illuminate\Database\Eloquent\Collection findOrFail($id, array $columns = ['*'])
     * @method \Domain\User\Models\User findOrNew($id, array $columns = ['*'])
     * @method \Domain\User\Models\User|null first(array|string $columns = ['*'])
     * @method \Domain\User\Models\User firstOrCreate(array $attributes, array $values = [])
     * @method \Domain\User\Models\User firstOrFail(array $columns = ['*'])
     * @method \Domain\User\Models\User firstOrNew(array $attributes = [], array $values = [])
     * @method \Domain\User\Models\User forceCreate(array $attributes = [])
     * @method \Illuminate\Database\Eloquent\Collection get(array|string $columns = ['*'])
     * @method \Domain\User\Models\User getModel()
     * @method \Illuminate\Database\Eloquent\Collection getModels(array|string $columns = ['*'])
     * @method \Domain\User\Models\User newModelInstance(array $attributes = [])
     * @method \Domain\User\Models\User sole(array|string $columns = ['*'])
     * @method \Domain\User\Models\User updateOrCreate(array $attributes, array $values = [])
     */
    class UserQuery extends \Illuminate\Database\Eloquent\Builder
    {
    }
}
