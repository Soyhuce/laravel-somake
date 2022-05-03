<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Soyhuce\Somake\Domains\Request\RouteGuesser;
use Soyhuce\Somake\Tests\Unit\Fixtures\MyController;

it('guesses an url without parameter', function (): void {
    Route::get('some-route', [MyController::class, 'index']);

    $guesser = new RouteGuesser(MyController::class, 'index');

    expect($guesser)
        ->verb()->toBe('get')
        ->url()->toBe('some-route');
});

it('fallbacks to / when url is not found', function (): void {
    $guesser = new RouteGuesser(MyController::class, 'index');

    expect($guesser)
        ->verb()->toBe('get')
        ->url()->toBe('/');
});

it('guesses an url with parameters', function (): void {
    Route::put('some-route/{model}/{anotherModel}', [MyController::class, 'update']);

    $guesser = new RouteGuesser(MyController::class, 'update');

    expect($guesser)
        ->verb()->toBe('put')
        ->url()->toBe('some-route/{$model}/{$anotherModel}');
});
