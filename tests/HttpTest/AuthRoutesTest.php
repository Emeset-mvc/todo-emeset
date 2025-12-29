<?php

declare(strict_types=1);

namespace Tests\Routes;

use Emeset\Test\TestDbCase;

final class AuthRoutesTest extends TestDbCase
{
    private function loginAsUser0(): array
    {
        $response = $this->post('/login', [
            'user' => 'user0',
            'password' => 'user0',
        ]);
        
        return $_SESSION;
    }

    public function test_get_login_mostra_template_login(): void
    {
        $response = $this->get('/login');

        $this->assertFalse($response->isRedirect());
        $this->assertSame('login.php', $response->getView()->getTemplate());
    }

    public function test_post_login_ok_redirigeix_a_home_i_crea_sessio(): void
    {
        $response = $this->post('/login', [
            'user' => 'user0',
            'password' => 'user0',
        ]);

        // 1) Redirecció correcta
        $this->assertTrue($response->isRedirect());
        $this->assertSame('Location: /', $response->getHeader());

        // 2) Sessió creada correctament
        $this->assertArrayHasKey('logged', $_SESSION);
        $this->assertTrue($_SESSION['logged']);

        $this->assertArrayHasKey('user', $_SESSION);
        $this->assertIsArray($_SESSION['user']);
        $this->assertArrayHasKey('id', $_SESSION['user']);
        $this->assertArrayHasKey('user', $_SESSION['user']);
        $this->assertSame('user0', $_SESSION['user']['user']);

        // 3) (Opcional però útil) El model valida que l’usuari existeix
        $users = $this->container->get('Users');
        $u = $users->validateUser('user0', 'user0');
        $this->assertIsArray($u);
        $this->assertSame('user0', $u['user']);
    }


    public function test_post_login_ko_redirigeix_a_login_i_seteja_error(): void
    {
        $response = $this->post('/login', [
            'user' => 'user0',
            'password' => 'malament',
        ]);

        $this->assertTrue($response->isRedirect());
        $this->assertSame('Location: /login', $response->getHeader());

        $this->assertFalse($_SESSION['logged']);
        $this->assertSame('Usuari o contrasenya incorrectes', $_SESSION['error']);
    }

    public function test_get_logout_redirigeix_a_login_i_buida_sessio(): void
    {
        $session = $this->loginAsUser0();

        $response = $this->get('/logout', [], $session);

        $this->assertTrue($response->isRedirect());
        $this->assertSame('Location: /login', $response->getHeader());

        $this->assertFalse($_SESSION['logged']);
    }
}
