<?php
declare(strict_types=1);

namespace Tests\Views;
use Emeset\Test\TestCase;

final class AboutViewTest extends TestCase
{
    public function test_about_sense_login_no_mostra_logout(): void
    {
        $response = $this->container["response"];

        $response->set('logged', false);
        $response->set('user', []);
        $response->setTemplate('about.php');

        $html = $response->render();

        $this->assertStringContainsString('About Page', $html);
        $this->assertStringNotContainsString('Tancar sessió', $html);
    }

    public function test_about_amb_login_mostra_logout_i_username(): void
    {
        $response = $this->container["response"];

        $response->set('logged', true);
        $response->set('user', ['user' => 'user0']);
        $response->setTemplate('about.php');

        $html = $response->render();

        $this->assertStringContainsString('About Page', $html);
        $this->assertStringContainsString('Tancar sessió (user0)', $html);
        $this->assertStringContainsString('href="/logout"', $html);
    }
}
