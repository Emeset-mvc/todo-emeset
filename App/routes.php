<?php
use App\Controllers\TaskController;
use Emeset\Contracts\Routers\Router;

$app->middleware([\App\Middleware\Auth::class, "isAuth"]);

$app->get("/", [TaskController::class,"index"], [[\App\Middleware\Auth::class,"auth"]]);
$app->post("/", [TaskController::class,"add"], [[\App\Middleware\Auth::class,"auth"]]);
$app->get("/done/{id}", [TaskController::class,"delete"], [[\App\Middleware\Auth::class,"auth"]]);
$app->get("/undone/{id}", [TaskController::class,"undelete"], [[\App\Middleware\Auth::class,"auth"]]);

$app->get("/login", "\App\Controllers\LoginController:index");
$app->post("/login", "\App\Controllers\LoginController:login");
$app->get("/logout", "\App\Controllers\LoginController:logout", [[\App\Middleware\Auth::class,"auth"]]);

$app->get("/about", "\App\Controllers\AboutController:index");


$app->route(\Emeset\Routers\RouterHttp::DEFAULT_ROUTE, "\App\Controllers\ErrorController:error404");