namespace {{ $namespace }};

use {{ $baseClass }};

/**
 * @@coversDefaultClass \{{ $coveredClass }}
 */
class {{ $className }} extends {{ $baseClassName }}
{
    /**
     * @@test
     * @@covers ::{{ $coveredMethod }}
     */
    public function success(): void
    {
        $this->getJson("{{ $url }}")
            ->assertValidContract(200);
    }
}
