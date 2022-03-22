namespace {{ $namespace }};

use {{ $baseClass }};

class {{ $className }} extends {{ $baseClassName }}
{
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
