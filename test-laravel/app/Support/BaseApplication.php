<?php declare(strict_types=1);

namespace Support;

use Illuminate\Foundation\Application as LaravelApplication;

class BaseApplication extends LaravelApplication
{
    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $namespace = 'App\\';

    /**
     * @param string $path
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function path($path = ''): string
    {
        return $this->basePath . \DIRECTORY_SEPARATOR . 'app/App' . ($path ? \DIRECTORY_SEPARATOR . $path : $path);
    }
}
