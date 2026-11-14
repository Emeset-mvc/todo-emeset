<?php

namespace App\Controllers;

class TaskController 
{
    public function index(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response
    {
        $model = $container->get("Tasks");
        $user = $request->get("SESSION", "user");
        $todo = $model->list($user["id"]);
        $done = $model->listDone($user["id"]);

        $response->set("todo", $todo);
        $response->set("done", $done);
        $response->setSession("error", "");

        $response->SetTemplate("home.php");

        return $response;
    }

    public function add(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response{
        $model = $container->get("Tasks");
        $tasca = $request->get(INPUT_POST, "task");
        $user = $request->get("SESSION", "user");
        $model->add($tasca, $user["id"]);
        $response->redirect("Location: /");

        return $response;
    }

    public function delete(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response{
        $model = $container->get("Tasks");
        $id = $request->getParam("id");
        $model->delete($id);
        $response->redirect("Location: /");

        return $response;
    }

    public function undelete(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response{
        $model = $container->get("Tasks");
        $id = $request->getParam("id");
        $model->restore($id);
        $response->redirect("Location: /");

        return $response;
    }
}