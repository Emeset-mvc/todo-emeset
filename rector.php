<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/App',
        __DIR__ . '/cli',
        __DIR__ . '/public',
        __DIR__ . '/tests',
    ])
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    ->withTypeCoverageLevel(1)
    ->withDeadCodeLevel(1)
    ->withCodeQualityLevel(1)
    ->withPhpSets(php84: true);;
