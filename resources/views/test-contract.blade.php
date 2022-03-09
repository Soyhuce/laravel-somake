namespace {{ $namespace }};

use Tests\ContractTestCase;

/**
 * @@coversDefaultClass \{{ $coveredClass }}
 */
class {{ $className }} extends ContractTestCase
{
    /**
     * @@test
     * @@covers ::defineMe
     */
    public function success(): void
    {
    }
}
