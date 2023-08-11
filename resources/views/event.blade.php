namespace {{ $namespace }};

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class {{ $event }}
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
    }
}
