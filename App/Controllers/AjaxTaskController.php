<?php

namespace App\Controllers;

class AjaxTaskController 
{
    public function index($request, $response, $container)
    {
        $model = $container->get("Tasks");
        $user = $request->get("SESSION", "user");
        $todo = $model->list($user["id"]);
        $done = $model->listDone($user["id"]);

        $response->set("todo", $todo);
        $response->set("done", $done);
        $response->setSession("error", "");

        $response->setJSON();

        return $response;
    }

    public function add($request, $response, $container){
        $model = $container->get("Tasks");
        $tasca = $request->get(INPUT_POST, "task");
        $user = $request->get("SESSION", "user");
        $taskId = $model->add($tasca, $user["id"]);
        $task = $model->get($taskId);
        //print_r($task);
        //$response->redirect("Location: /");
        $response->set("task", $task);
        $response->setJSON();
        return $response;
    }

    public function delete($request, $response, $container){
        $model = $container->get("Tasks");
        $id = $request->getParam("id");
        $model->delete($id);
        //$response->redirect("Location: /");
        $response->setJSON();
        return $response;
    }

    public function undelete($request, $response, $container){
        $model = $container->get("Tasks");
        $id = $request->getParam("id");
        $model->restore($id);
        $response->redirect("Location: /");

        return $response;
    }
}