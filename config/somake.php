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
    ],
];
