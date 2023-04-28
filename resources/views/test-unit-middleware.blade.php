/* @@covers \{{ $covered }} */

use {{ $classFqcn }};
use Illuminate\Support\Facades\Route;

it('handles the request', function(): void {
    Route::get('test', fn() => 'ok')
        ->middleware({{ $classBasename }}::class);

    $this->get('test')
        ->assertOk();
});
