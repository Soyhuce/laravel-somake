namespace {{ $namespace }};

use Soyhuce\JsonResource\JsonResource;

/**
 * @@mixin \{{ $model->class }}
 */
class {{ $resource }} extends JsonResource
{
    /**
     * @@return array<string, mixed>
     */
    public function format(): array
    {
        return [
@foreach($model->allAttributes() as $attribute)
            '{{ $attribute->name }}' => $this->{{ $attribute->name }},
@endforeach
        ];
    }
}
