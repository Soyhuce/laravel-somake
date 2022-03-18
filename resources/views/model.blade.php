namespace {{ $namespace }};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use {{ $baseClass }};

class {{ $model }} extends {{ $baseClassName }}
{
    use HasFactory;

    /** @@var array<string, string> */
    protected $casts = [];
}
