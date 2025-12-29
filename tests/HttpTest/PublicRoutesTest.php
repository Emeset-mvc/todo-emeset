<?php
declare(strict_types=1);

namespace Tests\Routes;

use Emeset\Test\TestDbCase;

final class PublicRoutesTest extends TestDbCase
{
    public function test_get_about_carrega_about_php(): void
    {
        $response = $this->get('/about');

        $this->assertFalse($response->isRedirect());
        $this->assertSame('about.php', $response->getView()->getTemplate());
        
    }
}
