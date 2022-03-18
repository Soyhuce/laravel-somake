namespace {{ $namespace }};

use {{ $baseClass }};

class {{ $className }} extends {{ $baseClassName }}
{
    /** @@var string */
    protected $signature = 'command:name';

    /** @@var string */
    protected $description = 'Command description';

    public function handle(): void
    {
    }
}
