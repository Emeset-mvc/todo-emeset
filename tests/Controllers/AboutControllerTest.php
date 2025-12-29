<?php
declare(strict_types=1);

namespace Tests\Controllers;

use Emeset\Test\TestCase;
use App\Controllers\AboutController;
use Emeset\Http\Request;

final class AboutControllerTest extends TestCase
{
    public function test_index_carrega_template_about(): void
    {
        $request = Request::fake();
        $response = $this->makeResponse();

        $out = AboutController::index($request, $response, $this->container);

        $this->assertFalse($out->isRedirect());
        $this->assertSame('about.php', $out->getView()->getTemplate());
    }
}
