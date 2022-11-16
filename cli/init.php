<?php

require "../App/config.php";

$db = $config["sqlite"]["path"] . $config["sqlite"]["name"];
echo "Creant la base de dades : {$db} \n";
$sql = new SQLite3($db);
if (! file_exists($db)) {
    die("No s'ha pogut obrir la base de dades");
}

$q = $sql->query("SELECT name FROM sqlite_master WHERE type='table' AND name='tasks';");
if ($q->fetchArray() === false) {
    $sql->query("CREATE TABLE tasks ( id INTEGER PRIMARY KEY, task CHAR(255), deleted INTEGER, user_id INTEGER );");
}

$q = $sql->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users';");
if ($q->fetchArray() === false) {
    $sql->query("CREATE TABLE users ( id INTEGER PRIMARY KEY, user CHAR(255), password CHAR(512), deleted INTEGER );");
}

$sql->query("delete from users;");

for ($i = 0; $i < 10; $i++) {

    $newHash = password_hash("user$i", PASSWORD_DEFAULT, ["cost" => 12]);
    $q = $sql->prepare("insert into users (user, password, deleted) values (:user, :password, 0);");
    $q->bindValue(':user', "user$i", SQLITE3_TEXT);
    $q->bindValue(':password', $newHash, SQLITE3_TEXT);
    $q->execute();
    echo "Inserint l'usuari user$i \n";
}
