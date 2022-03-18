namespace {{ $namespace }};

use {{ $baseClass }};

/**
 * @@mixin \{{ $model->class }}
 */
class {{ $resource }} extends {{ $baseClassName }}
{
@if($baseClass === 'Soyhuce\\JsonResources\\JsonResource')
    /**
     * @@return array<string, mixed>
     */
    public function format(): array
@else
    /**
    * @@param \Illuminate\Http\Request $request
    * @@return array<string, mixed>
    */
    public function toArray($request): array
@endif
    {
        return [
@foreach($model->allAttributes() as $attribute)
            '{{ $attribute->name }}' => $this->{{ $attribute->name }},
@endforeach
        ];
    }
}
