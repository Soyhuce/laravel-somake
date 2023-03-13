<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\Test\UnitTestGenerators;

use Illuminate\Foundation\Http\FormRequest;
use Soyhuce\Somake\Contracts\UnitTestGenerator;

/**
 * @implements UnitTestGenerator<FormRequest>
 */
class FormRequestTestGenerator implements UnitTestGenerator
{
    public static function shouldHandle(string $class): bool
    {
        return is_subclass_of($class, FormRequest::class);
    }

    public function view(): string
    {
        return 'test-unit-form-request';
    }

    public function data(string $class): array
    {
        return [
            'parameters' => array_keys(app()->call([new $class(), 'rules'])),
        ];
    }
}
