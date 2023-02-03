<?php declare(strict_types=1);

return [
    // Provide the path to your IDE and this package will open
    // newly created files automatically.
    'ide_path' => env('IDE'),

    'base_classes' => [
        'action' => null,
        'builder' => Illuminate\Database\Eloquent\Builder::class,
        'command' => Illuminate\Console\Command::class,
        'controller' => null,
        'dto' => Spatie\DataTransferObject\DataTransferObject::class,
        'data' => Spatie\LaravelData\Data::class,
        'factory' => Illuminate\Database\Eloquent\Factories\Factory::class,
        'model' => Illuminate\Database\Eloquent\Model::class,
        'policy' => null,
        'request' => Illuminate\Foundation\Http\FormRequest::class,
        'resource' => Illuminate\Http\Resources\Json\JsonResource::class,
    ],

    'test_generators' => [
        Soyhuce\Somake\Domains\Test\UnitTestGenerators\DefaultTestGenerator::class,
    ],
];
