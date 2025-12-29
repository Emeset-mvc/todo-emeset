<?php

include "../vendor/autoload.php";
$config = require "../App/config.php";

$db = $config["db"]["dbname"];
echo "Creant la base de dades : {$db} \n";
$dsn = "mysql:dbname={$config['db']['dbname']};host={$config['db']['host']}";

$usuari = $config["db"]["user"];
$clau = $config["db"]["pass"];
try {
    $sql = new PDO($dsn, $usuari, $clau);
} catch (\PDOException $e) {
    die('Ha fallat la connexió: ' . $e->getMessage());
}

$sql->query("CREATE TABLE IF NOT EXISTS users (
    id int(11) NOT NULL AUTO_INCREMENT,
    user varchar(128) NOT NULL,
    pass varchar(128) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY name (user)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

$sql->query("delete from users;");

for ($i = 0; $i < 10; $i++) {

    $newHash = password_hash("user$i", PASSWORD_DEFAULT, ["cost" => 12]);
    $q = $sql->prepare("insert into users (user, pass) values (:user, :password);");
    $q->execute([":user" => "user$i", ":password" => $newHash]);
    echo "Inserint l'usuari user$i \n";
}

echo 1;
$sql->query("CREATE TABLE IF NOT EXISTS tasks (
    id int(11) NOT NULL AUTO_INCREMENT,
    task text NOT NULL,
    user_id int(11) NOT NULL,
    deleted tinyint(4) NOT NULL,
    PRIMARY KEY (id),
    KEY task_owner (user_id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
  
  echo 2;
  $sql->exec("ALTER TABLE tasks DROP FOREIGN KEY task_owner;");
  $sql->query("ALTER TABLE tasks
        ADD CONSTRAINT task_owner
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE;");


