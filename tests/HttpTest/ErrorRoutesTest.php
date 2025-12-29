<?php
declare(strict_types=1);

namespace Tests\Routes;

use Emeset\Test\TestDbCase;

final class ErrorRoutesTest extends TestDbCase
{
    public function test_ruta_inexistent_va_a_error404(): void
    {
        $response = $this->get('/aixo-no-existeix');

        $this->assertFalse($response->isRedirect());
        $this->assertSame('error.php', $response->getView()->getTemplate());
    }
}
