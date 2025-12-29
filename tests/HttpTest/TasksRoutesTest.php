<?php

declare(strict_types=1);

namespace Tests\Routes;

use Emeset\Test\TestDbCase;

final class TasksRoutesTest extends TestDbCase
{
    protected function fakeLoggedSession(): array
    {
        /** @var \App\Models\Users $users */
        $users = $this->container->get('Users');

        // Agafem el primer usuari real de la BD
        $user = $users->getUser("user1");

        if (!$user || !isset($user['id'], $user['user'])) {
            throw new \RuntimeException(
                "No s'ha pogut crear fake session: la BD no té usuaris vàlids"
            );
        }

        return [
            'logged' => true,
            'user' => $user,
        ];
    }

    public function test_post_home_add_crea_tasca_i_redirigeix(): void
    {
        $session = $this->fakeLoggedSession();

        $response = $this->post('/', [
            'task' => 'Tasca creada des de test de ruta',
        ], $session);

        $this->assertTrue($response->isRedirect());
        $this->assertSame('Location: /', $response->getHeader());

        // Verifiquem a BD via model
        $tasks = $this->container->get('Tasks');
        $userId = (int)$session['user']['id'];
        $todo = $tasks->list($userId);

        $this->assertContains('Tasca creada des de test de ruta', array_values($todo));
    }

    public function test_get_done_marca_tasca_com_feta_i_redirigeix(): void
    {
        $session = $this->fakeLoggedSession();

        $tasks = $this->container->get('Tasks');
        $userId = (int)$session['user']['id'];

        $tasks->add('Tasca per marcar done', $userId);
        $todo = $tasks->list($userId);
        $id = array_key_last($todo);

        $response = $this->get("/done/{$id}", [], $session);

        $this->assertTrue($response->isRedirect());
        $this->assertSame('Location: /', $response->getHeader());

        $done = $tasks->listDone($userId);
        $this->assertArrayHasKey($id, $done);
    }

    public function test_get_undone_restaurar_tasca_i_redirigeix(): void
    {
        $session = $this->fakeLoggedSession();

        $tasks = $this->container->get('Tasks');
        $userId = (int)$session['user']['id'];

        $tasks->add('Tasca per restaurar', $userId);
        $todo = $tasks->list($userId);
        $id = array_key_last($todo);

        $tasks->delete($id);

        $response = $this->get("/undone/{$id}", [], $session);

        $this->assertTrue($response->isRedirect());
        $this->assertSame('Location: /', $response->getHeader());

        $todo2 = $tasks->list($userId);
        $this->assertArrayHasKey($id, $todo2);
    }
}
