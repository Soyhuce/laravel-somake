namespace {{ $namespace }};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {{ $model }} extends Model
{
    use HasFactory;

    /** @@var array<string, string> */
    protected $casts = [];
}
