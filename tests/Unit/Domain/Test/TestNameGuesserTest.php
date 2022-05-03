<?php declare(strict_types=1);

use Soyhuce\Somake\Domains\Test\TestNameGuesser;

it('guesses the test name', function (string $controller, string $method, string $testName): void {
    $guesser = new TestNameGuesser();

    expect($guesser->guess($controller, $method))->toBe($testName);
})->with([
    ['PostController', 'show', 'ShowPostTest'],
    ['App\Admin\Controller\PostController', 'show', 'ShowPostTest'],
    ['PostController', 'index', 'IndexPostsTest'],
    ['PostController', 'store', 'CreatePostTest'],
    ['PostController', 'update', 'UpdatePostTest'],
    ['PostController', 'destroy', 'DeletePostTest'],
    ['PostController', 'activate', 'ActivatePostTest'],
]);
