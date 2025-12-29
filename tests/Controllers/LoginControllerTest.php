<?php
declare(strict_types=1);

namespace Tests\Controllers;

use Emeset\Test\TestDbCase;
use App\Controllers\LoginController;
use Emeset\Http\Request;

final class LoginControllerTest extends TestDbCase
{
    public function test_index_carrega_template_login_i_llegeix_error_de_sessio(): void
    {
        $_SESSION['error'] = 'Error';

        $controller = new LoginController();
        $request = Request::fake(session: $_SESSION);
        $response = $this->makeResponse();

        $out = $controller->index($request, $response, $this->container);

        $this->assertFalse($out->isRedirect());
        $this->assertSame('login.php', $out->getView()->getTemplate());

        $values = $out->getView()->getValues();
        $this->assertSame('Error', $values['error']);

        // index() posa error a blanc a sessió
        $this->assertSame('', $_SESSION['error']);
    }

    public function test_login_ok_redirigeix_a_home_i_seteja_sessio(): void
    {
        // El seed de DB (via Db/reset.php + schema.sql) ha de crear user0 amb password "user0"
        $controller = new LoginController();

        $request = Request::fake(
            post: ['user' => 'user0', 'password' => 'user0'],
            session: []
        );
        $response = $this->makeResponse();

        $out = $controller->login($request, $response, $this->container);

        $this->assertTrue($out->isRedirect());
        $this->assertSame('Location: /', $out->getHeader());

        $this->assertTrue($_SESSION['logged']);
        $this->assertIsArray($_SESSION['user']);
        $this->assertSame('user0', $_SESSION['user']['user']);
    }

    public function test_login_ko_redirigeix_a_login_i_seteja_error(): void
    {
        $controller = new LoginController();

        $request = Request::fake(
            post: ['user' => 'user0', 'password' => 'INCORRECTA'],
            session: []
        );
        $response = $this->makeResponse();

        $out = $controller->login($request, $response, $this->container);

        $this->assertTrue($out->isRedirect());
        $this->assertSame('Location: /login', $out->getHeader());

        $this->assertFalse($_SESSION['logged']);
        $this->assertSame('Usuari o contrasenya incorrectes', $_SESSION['error']);
    }

    public function test_logout_redirigeix_a_login_i_buida_sessio(): void
    {
        $_SESSION['logged'] = true;
        $_SESSION['user'] = ['id' => 1, 'user' => 'user0'];

        $controller = new LoginController();
        $request = Request::fake(session: $_SESSION);
        $response = $this->makeResponse();

        $out = $controller->logout($request, $response, $this->container);

        $this->assertTrue($out->isRedirect());
        $this->assertSame('Location: /login', $out->getHeader());

        $this->assertFalse($_SESSION['logged']);
        $this->assertSame([], $_SESSION['user']);
    }
}
