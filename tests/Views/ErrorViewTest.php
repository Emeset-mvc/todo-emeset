<?php
declare(strict_types=1);

namespace Tests\Views;
use Emeset\Test\TestCase;

final class ErrorViewTest extends TestCase
{
    public function test_error_sense_detall_no_mostra_alert(): void
    {
        $response = $this->container["response"];

        // Simulem que el controlador no ha passat error (o buit)
        $response->set('error', '');
        $response->setTemplate('error.php');

        $html = $response->render();

        $this->assertStringContainsString('Alguna cosa ha anat malament', $html);
        $this->assertStringNotContainsString('role="alert"', $html);
    }

    public function test_error_amb_detall_mostra_alert(): void
    {
        $response = $this->container["response"];

        $response->set('error', '404');
        $response->setTemplate('error.php');
        
        $html = $response->render();

        $this->assertStringContainsString('role="alert"', $html);
        $this->assertStringContainsString('404', $html);
    }
}
