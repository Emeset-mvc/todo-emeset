<?php
declare(strict_types=1);

namespace Tests\Middleware;

use Emeset\Test\TestCase;
use App\Middleware\Auth;
use Emeset\Http\Request;

final class AuthMiddlewareTest extends TestCase
{

    public function test_auth_redirigeix_a_login_si_no_logat(): void
    {
        $mw = new Auth();

        $request = Request::fake(session: []); // sense logged
        $response = $this->makeResponse();

        $next = function () {
            $this->fail("No s'hauria d'executar el next si no està logat");
        };

        $out = $mw->auth($request, $response, $this->container, $next);

        $this->assertTrue($out->isRedirect());
        $this->assertSame('location: /login', $out->getHeader());
    }

    public function test_auth_deixa_passar_si_logat_i_injecta_variables_a_la_view(): void
    {
        $mw = new Auth();

        $request = Request::fake(session: [
            'logged' => true,
            'user' => ['id' => 1, 'user' => 'user0'],
        ]);

        $response = $this->makeResponse();

        $next = function ($req, $res, $c) {
            $res->set('next', true);
            return $res;
        };

        $out = $mw->auth($request, $response, $this->container, $next);

        $this->assertFalse($out->isRedirect());

        $values = $out->getView()->getValues();
        $this->assertTrue($values['logged']);
        $this->assertSame('user0', $values['user']['user']);
        $this->assertTrue($values['next']);
    }

    public function test_isAuth_no_redirigeix_mai(): void
    {
        $mw = new Auth();

        $request = Request::fake(session: []);
        $response = $this->makeResponse();

        $next = function ($req, $res, $c) {
            $res->set('ok', 1);
            return $res;
        };

        $out = $mw->isAuth($request, $response, $this->container, $next);

        $this->assertFalse($out->isRedirect());
        $this->assertSame(1, $out->getView()->getValues()['ok']);
    }
}