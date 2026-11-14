<?php
require_once __DIR__ . "/vendor/autoload.php";

$container = new \App\Container(__DIR__ . "/App/config.php");

$cli = $container["cli"]; 

$cli->addCommand("config:show", [App\Commands\Config::class, "show"], "Mostra la configuració de l'aplicació");
$cli->addCommand("users:show", [App\Commands\Users::class, "show"], "Mostra la configuració de l'aplicació");
$cli->addCommand("users:add", [App\Commands\Users::class, "add"], "Afegeix usuaris")->opt("name:n", "Non de l'usuari", true, 'string')->arg("user", "User")->arg("pass", "Password");

$cli->addCommand("db:init-sqlite", [App\Commands\Db::class, "initSqlite"], "Inicialitza la base de dades SQLite");
$cli->addCommand("db:init-pdo", [App\Commands\Db::class, "initPdo"], "Inicialitza la base de dades MySQL");

$cli->run();