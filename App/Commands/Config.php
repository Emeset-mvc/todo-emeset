<?php

namespace App\Commands;

class Config
{
    public function show(\Emeset\Contracts\Cli\Parser $args, \Emeset\Contracts\Cli\Output $output, \Emeset\Contracts\Container $container): void
    {
        $output->json($container->get("config"));
    }
}