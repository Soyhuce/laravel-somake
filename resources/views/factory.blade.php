namespace {{ $namespace }};

use {{ $model->class }};
use {{ $baseClass }};

class {{ $className }} extends {{ $baseClassName }}
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
