namespace {{ $namespace }};

use Tests\TestCase;

/**
 * @@coversDefaultClass \{{ $coveredClass }}
 */
class {{ $className }} extends TestCase
{
    /**
     * @@test
     * @@covers ::defineMe
     */
    public function simple(): void
    {
    }
}
