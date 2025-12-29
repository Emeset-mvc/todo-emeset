<?php

declare(strict_types=1);

namespace Tests\Routes;

use Emeset\Test\TestDbCase;

final class ProtectedRoutesTest extends TestDbCase
{
    protected function fakeLoggedSession( int $id = 1, string $user = 'user0'): array 
    {
        return [
            'logged' => true,
            'user' => [
                'id' => $id,
                'user' => $user,
            ],
        ];
    }

    public function test_get_home_sense_login_redirigeix_a_login(): void
    {
        $response = $this->get('/');

        $this->assertTrue($response->isRedirect());
        $this->assertSame('location: /login', $response->getHeader());
    }

    public function test_post_home_sense_login_redirigeix_a_login(): void
    {
        $response = $this->post('/', [
            'task' => 'No hauria de passar',
        ]);

        $this->assertTrue($response->isRedirect());
        $this->assertSame('location: /login', $response->getHeader());
    }

    public function test_get_done_sense_login_redirigeix_a_login(): void
    {
        $response = $this->get('/done/1');

        $this->assertTrue($response->isRedirect());
        $this->assertSame('location: /login', $response->getHeader());
    }

    public function test_get_undone_sense_login_redirigeix_a_login(): void
    {
        $response = $this->get('/undone/1');

        $this->assertTrue($response->isRedirect());
        $this->assertSame('location: /login', $response->getHeader());
    }

    public function test_get_home_amb_login_carrega_home_php(): void
    {
        $session = $this->fakeLoggedSession();

        $response = $this->get('/', [], $session);

        $this->assertFalse($response->isRedirect());
        $this->assertSame('home.php', $response->getView()->getTemplate());

        $values = $response->getView()->getValues();
        $this->assertArrayHasKey('todo', $values);
        $this->assertArrayHasKey('done', $values);
    }
}
