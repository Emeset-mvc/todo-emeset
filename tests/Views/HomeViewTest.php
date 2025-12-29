<?php
declare(strict_types=1);

namespace Tests\Views;
use Emeset\Test\TestCase;

final class HomeViewTest extends TestCase
{
    public function test_home_renderitza_tasques_todo_i_done_amb_links(): void
    {
        $response = $this->container["response"];

        $response->set('user', ['user' => 'user0']);
        $response->set('logged', true);

        // El template espera arrays id => text
        $response->set('todo', [
            10 => 'Comprar pa',
            11 => 'Fer deures',
        ]);
        $response->set('done', [
            20 => 'Dormir',
        ]);

        $response->setTemplate('home.php');

        $html = $response->render();

        // Navbar / usuari
        $this->assertStringContainsString('Todo APP', $html);
        $this->assertStringContainsString('Tancar sessió (user0)', $html);

        // Items
        $this->assertStringContainsString('Comprar pa', $html);
        $this->assertStringContainsString('Fer deures', $html);
        $this->assertStringContainsString('Dormir', $html);

        // Links d'acció (done/undone)
        $this->assertStringContainsString('href="/done/10"', $html);
        $this->assertStringContainsString('href="/done/11"', $html);
        $this->assertStringContainsString('href="/undone/20"', $html);
    }

    public function test_home_amb_llistes_buides_no_peta(): void
    {
        $response = $this->container["response"];

        $response->set('user', ['user' => 'user0']);
        $response->set('logged', true);
        $response->set('todo', []);
        $response->set('done', []);
        $response->setTemplate('home.php');

        $html = $response->render();

        // “Smoke assert”: la pàgina existeix i no trenca el render
        $this->assertStringContainsString('Todo APP', $html);
        $this->assertStringContainsString('Tancar sessió (user0)', $html);
    }
}
