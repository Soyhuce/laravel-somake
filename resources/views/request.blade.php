namespace {{ $namespace }};

use {{ $baseClass }};

class {{ $request }} extends {{ $baseClassName }}
{
    /**
     * @@return array<string, mixed>
     */
    public function rules(): array
    {
        return [
@foreach($fields as $field => $rules)
            '{{ $field }}' => [{!! implode(', ', $rules) !!}],
@endforeach
        ];
    }
}
