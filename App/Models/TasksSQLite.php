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
class TasksSQLite
{

    private $sql;
    private $db = "tasks.sqlite";
    /**
     * __construct:  Crear el model tasques
     *
     * Model adaptat per SQLite
     *
     * @param array $config paràmetres de configurció del model
     *
    **/
    public function __construct($config)
    {
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

    /**
      * add:  afegeix una tasca
      *
      * @param $tasca string amb la tasca.
      *
    **/
    public function add($tasca, $user = 1)
    {
        $query = $this->sql->prepare('insert into tasks (task,deleted,user_id) values (:tasca, 0, :user);');
        $query->bindValue(':tasca', $tasca, SQLITE3_TEXT);
        $query->bindValue(':user', $user, SQLITE3_INTEGER);
        $result = $query->execute();
    }

    /**
      * delete:  esborra la tasca amb l'id $id
      *
      * La tasca amb id $id queda marcada com a feta i passa al llistat de fetes
      *
      * @param $id integer identificador de la tasca que volem esborrar.
      *
    **/
    public function delete($id)
    {
        $query = $this->sql->prepare('update tasks set deleted=1 where id=:id;');
        $query->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $query->execute();
    }

    /**
      * restaura:  restaura la tasca amb id $id
      *
      * La tasca amb id $id de la llista de fetes torna a la llista de tasques.
      *
      * @param $id integer identificador de la tasca que volem esborrar.
      *
    **/
    public function restore($id)
    {
        $query = $this->sql->prepare('update tasks set deleted=0 where id=:id;');
        $query->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $query->execute();
    }

    /**
      * list:  retorna el llistat de tasques
      *
      * @return array retorna una array de strings amb les tasques pendents de fer.
    **/
    public function list($user = 1): array
    {
        $query = $this->sql->prepare('select id,task from tasks where deleted=0 and user_id=:user;');
        $query->bindValue(':user', $user, SQLITE3_INTEGER);
        $result = $query->execute();
        $tasks = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $tasks[$row['id']] = $row['task'];
        }
        return $tasks;
    }
  
    /**
      * llistatFetes:  retorna el llistat de tasques fetes.
      *
      * @return array retorna una array de strings amb les tasques fetes.
    **/
    public function listDone($user = 1): array
    {
        $query = $this->sql->prepare('select id,task from tasks where deleted=1 and user_id=:user;');
        $query->bindValue(':user', $user, SQLITE3_INTEGER);
        $result = $query->execute();
        $tasks = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $tasks[$row['id']] = $row['task'];
        }
        return $tasks;
    }
}
