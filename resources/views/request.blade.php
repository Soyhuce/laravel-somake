namespace {{ $namespace }};

use Illuminate\Foundation\Http\FormRequest;

class {{ $request }} extends FormRequest
{
    /**
     * @@return array<string, mixed>
     */
    public function rules(): array
    {
        return [
@foreach($fields as $field => $rules)
            '{{ $field }}' => ['{!! implode('\', \'', $rules) !!}'],
@endforeach
        ];
    }
}
