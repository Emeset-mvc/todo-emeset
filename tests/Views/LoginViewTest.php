<?php
declare(strict_types=1);

namespace Tests\Views;
use Emeset\Test\TestCase;

final class LoginViewTest extends TestCase
{
    public function test_login_sense_error_no_mostra_alert(): void
    {
        $response = $this->container["response"];

        $response->set('error', '');
        $response->setTemplate('login.php');

        $html = $response->render();

        $this->assertStringContainsString('Emeset - Exemple de login', $html);
        $this->assertStringNotContainsString('role="alert"', $html);
    }

    public function test_login_amb_error_mostra_alert_i_text(): void
    {
        $response = $this->container["response"];

        $response->set('error', 'Usuari o contrasenya incorrectes');
        $response->setTemplate('login.php');

        $html = $response->render();

        $this->assertStringContainsString('role="alert"', $html);
        $this->assertStringContainsString('Usuari o contrasenya incorrectes', $html);
    }
}
