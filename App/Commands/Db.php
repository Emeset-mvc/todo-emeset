<?php

namespace App\Commands;

use Emeset\Contracts\Cli\Output;
use Emeset\Contracts\Cli\Parser;
use Emeset\Contracts\Container;
use PDO;
use SQLite3;

class Db
{
    public function initSqlite(Parser $args, Output $output, Container $container): void
    {
        $config = $container->get('config')['sqlite'];
        $path = rtrim($config['path'], '/\\') . DIRECTORY_SEPARATOR . $config['name'];
        $db = new SQLite3($path);
        $db->enableExceptions(true);
        $db->exec('CREATE TABLE IF NOT EXISTS tasks (id INTEGER PRIMARY KEY, task CHAR(255), deleted INTEGER, user_id INTEGER)');
        $db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, user CHAR(255), password CHAR(512), deleted INTEGER)');

        $check = $db->prepare('SELECT id FROM users WHERE user = :user');
        $insert = $db->prepare('INSERT INTO users (user, password, deleted) VALUES (:user, :password, 0)');
        foreach (range(0, 9) as $i) {
            $user = "user$i";
            $check->bindValue(':user', $user, SQLITE3_TEXT);

            if ($check->execute()->fetchArray(SQLITE3_ASSOC) === false) {
                $insert->bindValue(':user', $user, SQLITE3_TEXT);
                $insert->bindValue(':password', password_hash($user, PASSWORD_DEFAULT, ['cost' => 12]), SQLITE3_TEXT);
                $insert->execute();
                $output->echo("Inserint l'usuari $user");
            }
        }
        $output->success("Base de dades SQLite inicialitzada: $path");
    }

    public function initPdo(Parser $args, Output $output, Container $container): void
    {
        $config = $container->get('config')['db'];
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";
        $db = new PDO($dsn, $config['user'], $config['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $db->exec('CREATE TABLE IF NOT EXISTS users (id int NOT NULL AUTO_INCREMENT PRIMARY KEY, user varchar(128) NOT NULL UNIQUE, pass varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
        $db->exec('CREATE TABLE IF NOT EXISTS tasks (id int NOT NULL AUTO_INCREMENT PRIMARY KEY, task text NOT NULL, user_id int NOT NULL, deleted tinyint(4) NOT NULL, KEY task_owner (user_id), CONSTRAINT task_owner FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $check = $db->prepare('SELECT id FROM users WHERE user = :user');
        $insert = $db->prepare('INSERT INTO users (user, pass) VALUES (:user, :password)');
        foreach (range(0, 9) as $i) {
            $user = "user$i";
            $check->execute([':user' => $user]);

            if ($check->fetchColumn() === false) {
                $insert->execute([
                    ':user' => $user,
                    ':password' => password_hash($user, PASSWORD_DEFAULT, ['cost' => 12]),
                ]);
                $output->echo("Inserint l'usuari $user");
            }
        }
        $output->success("Base de dades MySQL inicialitzada: {$config['dbname']}");
    }
}
