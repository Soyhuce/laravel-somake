<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Soyhuce\Somake\Domains\Request\UrlGuesser;
use Soyhuce\Somake\Tests\Unit\Fixtures\MyController;

it('guesses an url without parameter', function (): void {
    Route::get('some-route', [MyController::class, 'index']);

    $guesser = new UrlGuesser(MyController::class, 'index');

    expect($guesser->guess())->toBe('/some-route');
});

it('fallbacks to / when url is not found', function (): void {
    $guesser = new UrlGuesser(MyController::class, 'index');

    expect($guesser->guess())->toBe('/');
});

it('guesses an url with one parameter', function (): void {
    Route::get('some-route/{model}', [MyController::class, 'show']);

    $guesser = new UrlGuesser(MyController::class, 'show');

    expect($guesser->guess())->toBe('/some-route/{$model}');
});

it('guesses an url with multiple parameters', function (): void {
    Route::get('some-route/{model}/{anotherModel}', [MyController::class, 'show']);

    $guesser = new UrlGuesser(MyController::class, 'show');

    expect($guesser->guess())->toBe('/some-route/{$model}/{$anotherModel}');
});
