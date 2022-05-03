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
    public function simple(): void
    {
        $this->getJson("{{ $url }}")
            ->assertOk();
    }
}
