<?php

/**
 * Front controler
 * Exemple de MVC per a M07 Desenvolupament d'aplicacions web en entorn de servidor.
 * Aquest Framework implementa el mínim per tenir un MVC per fer pràctiques
 * de M07.
 * @author: Dani Prados dprados@cendrassos.net
 * @version 0.1.5
 *
 * Punt d'netrada de l'aplicació exemple del Framework Emeset.
 * Per provar com funciona es pot executer php -S localhost:8000 a la carpeta public.
 * I amb el navegador visitar la url http://localhost:8000/
 *
 */

 use App\Controllers\HomeController;
 use Emeset\Routers\Router;

error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../vendor/autoload.php";
include "../App/config.php";

include "../App/Middleware/auth.php";



/* Creem els diferents models */
$contenidor = new \App\Container($config);

$app = new \Emeset\Emeset($contenidor);


$app->get("/", "\App\Controllers\TaskController:index", ["auth"]);
$app->post("/", "\App\Controllers\TaskController:add", ["auth"]);
$app->get("/done/{id}", "\App\Controllers\TaskController:delete", ["auth"]);
$app->get("/undone/{id}", "\App\Controllers\TaskController:undelete", ["auth"]);

$app->get("/login", "\App\Controllers\LoginController:index");
$app->post("/login", "\App\Controllers\LoginController:login");
$app->get("/logout", "\App\Controllers\LoginController:logout", ["auth"]);

$app->route(Router::DEFAULT_ROUTE, "\App\Controllers\ErrorController:error404");

$app->execute();
