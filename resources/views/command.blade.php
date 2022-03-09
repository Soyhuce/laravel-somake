namespace {{ $namespace }};

use Illuminate\Console\Command;

class {{ $className }} extends Command
{
    /** @@var string */
    protected $signature = 'command:name';

    /** @@var string */
    protected $description = 'Command description';

    public function handle(): void
    {
    }
}
