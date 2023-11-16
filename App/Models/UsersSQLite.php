<?php

/**
    * Exemple per a M07 i M08.
    * @author: Dani Prados dprados@cendrassos.net
    *
    * Model que gestiona les tasques amb SQLite.
    *
**/

namespace App\Models;

/**
    * TasksSQLite model que gestiona les tasques.
    * @author: Dani Prados dprados@cendrassos.net
    *
    * Per guardar, recuperar i gestionar les tasques.
    *
**/
class UsersSQLite
{

    private $sql;
    private $db = "tasks.sqlite";
    private $options = [];


    /**
     * __construct:  Crear el model tasques
     *
     * Model adaptat per SQLite
     *
     * @param array $config paràmetres de configurció del model
     *
    **/
    public function __construct($config, $options = ["cost"=> 12])
    {
        $this->options = $options;
        $db = $config["path"] . $this->db;
        $this->sql = new \SQLite3($db);
        if (! file_exists($db)) {
            die("No s'ha pogut obrir la base de dades");
        }

        $q = $this->sql->query("SELECT name FROM sqlite_master WHERE type='table' AND name='tasks';");
        if ($q->fetchArray() === false) {
            $this->sql->query("CREATE TABLE tasks ( id INTEGER PRIMARY KEY, task CHAR(255), deleted INTEGER, user_id INTEGER );");
            $q = $this->sql->query("insert into tasques (task,deleted,user_id) values ('Primera tasca', 0, 1);");
        }
    }

    public function getUser($user)
    {
        $query = 'select id, user, password from users where user=:user and deleted = 0;';
        $stm = $this->sql->prepare($query);
        // echo "Error in fetch ".$this->sql->lastErrorMsg();
        // die();
        $stm->bindValue(':user', $user, SQLITE3_TEXT);
        $result = $stm->execute();
        
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function validateUser($user, $pass)
    {
        
        $login = $this->getUser($user);

        if ($login !== false) {
            $hash = $login["password"];
            if (password_verify($pass, $hash)) {
                if (password_needs_rehash($hash, PASSWORD_DEFAULT, $this->options)) {
                    $newHash = password_hash($pass, PASSWORD_DEFAULT, $this->options);
                    $query = 'update usuaris set pass=:hash where usuari=:user;';
                    $stm = $this->sql->prepare($query);
                    $stm->bindValue(':user', $user, SQLITE3_TEXT);
                    $stm->bindValue(':pass', $newHash, SQLITE3_TEXT);
                    $result = $stm->execute();
                }
            } else {
                $login = false;
            }
        }
        //print_r($login);
        return $login;
    }
}
