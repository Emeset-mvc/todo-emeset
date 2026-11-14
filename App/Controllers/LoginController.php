<?php

namespace App\Controllers;

class LoginController 
{
    public function index(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response
    {
        $error = $request->get("SESSION", "error");

        $response->set("error", $error);
        $response->setSession("error", "");
        $response->SetTemplate("login.php");

        return $response;
    }

    public function login(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response {
        $user = $request->get(INPUT_POST, "user");
        $password = $request->get(INPUT_POST, "password");

        $model = $container->get("Users");
        $login = $model->validateUser($user, $password);

        if ($login) {
            $response->setSession("logged", true);
            $response->setSession("user", $login);
            $response->redirect("Location: /");
        } else {
            $response->setSession("logged", false);
            $response->setSession("error", "Usuari o contrasenya incorrectes");
            $response->redirect("Location: /login");
        }

        return $response;
    }

    public function logout(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response {
        
        $response->setSession("logged", false);
        $response->setSession("user", []);
        $response->redirect("Location: /login");

        return $response;
    }

}

