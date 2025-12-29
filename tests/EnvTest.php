<?php

namespace Tests\Controllers;

use Emeset\Test\TestCase;
use App\Controllers\Portada;

class EnvTest extends TestCase
{
    public function test_enviroment(): void
    {
        // ARRANGE
        $container  = $this->container;
        $dbname = $container["config"]["db"]["dbname"];
        // ACT ...
        // ASSERT
        $this->assertEquals('test-todo', $dbname);
    }
}
