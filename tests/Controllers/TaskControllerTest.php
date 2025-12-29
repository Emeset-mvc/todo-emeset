<?php
declare(strict_types=1);

namespace Tests\Controllers;

use Emeset\Test\TestCase;
use App\Controllers\TaskController;
use Emeset\Http\Request;

final class TaskControllerTest extends TestCase
{
    private function loginSessionUser0(): array
    {
        // La BD seed ha d’incloure user0 amb id 1 (o similar)
        // Per no dependre de l'id exacte, podem fer login amb el model.
        $users = $this->container->get('Users');
        $u = $users->validateUser('user0', 'user0');

        return [
            'logged' => true,
            'user' => $u,
        ];
    }

    public function test_index_carrega_home_i_defineix_todo_i_done(): void
    {
        $controller = new TaskController();

        $request = Request::fake(session: $this->loginSessionUser0());
        $response = $this->makeResponse();

        $out = $controller->index($request, $response, $this->container);

        $this->assertFalse($out->isRedirect());
        $this->assertSame('home.php', $out->getView()->getTemplate());

        $values = $out->getView()->getValues();
        $this->assertArrayHasKey('todo', $values);
        $this->assertArrayHasKey('done', $values);
        $this->assertIsArray($values['todo']);
        $this->assertIsArray($values['done']);
    }

    public function test_add_crea_tasca_i_redirigeix_a_home(): void
    {
        $controller = new TaskController();
        $sess = $this->loginSessionUser0();

        $request = Request::fake(
            post: ['task' => 'Nova tasca test'],
            session: $sess
        );
        $response = $this->makeResponse();

        $out = $controller->add($request, $response, $this->container);

        $this->assertTrue($out->isRedirect());
        $this->assertSame('Location: /', $out->getHeader());

        // Verifiquem que existeix a la llista
        $tasks = $this->container->get('Tasks')->list($sess['user']['id']);
        $this->assertContains('Nova tasca test', array_values($tasks));
    }

    public function test_delete_marca_com_feta_i_redirigeix(): void
    {
        $controller = new TaskController();
        $sess = $this->loginSessionUser0();
        $tasksModel = $this->container->get('Tasks');

        // creem tasca
        $tasksModel->add('Tasca a fer delete', $sess['user']['id']);
        $todo = $tasksModel->list($sess['user']['id']);
        $id = array_key_last($todo);

        $request = Request::fake(
            session: $sess,
            params: ['id' => (string)$id]
        );
        $response = $this->makeResponse();

        $out = $controller->delete($request, $response, $this->container);

        $this->assertTrue($out->isRedirect());
        $this->assertSame('Location: /', $out->getHeader());

        $done = $tasksModel->listDone($sess['user']['id']);
        $this->assertArrayHasKey($id, $done);
    }

    public function test_undelete_restaura_i_redirigeix(): void
    {
        $controller = new TaskController();
        $sess = $this->loginSessionUser0();
        $tasksModel = $this->container->get('Tasks');

        // creem tasca i la marquem feta
        $tasksModel->add('Tasca a restaurar', $sess['user']['id']);
        $todo = $tasksModel->list($sess['user']['id']);
        $id = array_key_last($todo);
        $tasksModel->delete($id);

        $request = Request::fake(
            session: $sess,
            params: ['id' => (string)$id]
        );
        $response = $this->makeResponse();

        $out = $controller->undelete($request, $response, $this->container);

        $this->assertTrue($out->isRedirect());
        $this->assertSame('Location: /', $out->getHeader());

        $todo2 = $tasksModel->list($sess['user']['id']);
        $this->assertArrayHasKey($id, $todo2);
    }
}
