<?php
declare(strict_types=1);

namespace Tests\Controllers;

use Emeset\Test\TestCase;
use App\Controllers\ErrorController;
use Emeset\Http\Request;

final class ErrorControllerTest extends TestCase
{
    public function test_error404_carrega_template_error_i_passa_error_de_sessio(): void
    {
        $_SESSION['error'] = '404';

        $controller = new ErrorController();

        $request = Request::fake(session: $_SESSION);
        $response = $this->makeResponse();

        $out = $controller->error404($request, $response, $this->container);

        $this->assertFalse($out->isRedirect());
        $this->assertSame('error.php', $out->getView()->getTemplate());

        $values = $out->getView()->getValues();
        $this->assertSame('404', $values['error']);
    }
}
