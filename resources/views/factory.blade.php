namespace {{ $namespace }};

use {{ $model->class }};
use Illuminate\Database\Eloquent\Factories\Factory;

class {{ $className }} extends Factory
{
    /** @@var string */
    protected $model = {{ $model->getName() }}::class;

    /**
     * @@return array<string, mixed>
     */
    public function definition(): array
    {
        return [
@foreach($model->factoryAttributes() as $attribute)
            '{{ $attribute->name }}' => $this->faker,
@endforeach
        ];
    }
}
