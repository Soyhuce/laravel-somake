namespace {{ $namespace }};

use {{ $baseClass }};

/**
 * @@coversDefaultClass \{{ $coveredClass }}
 */
class {{ $className }} extends {{ $baseClassName }}
{
    /**
     * @@test
     * @@covers ::defineMe
     */
    public function simple(): void
    {
    }
}
