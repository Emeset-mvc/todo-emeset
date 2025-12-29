<?php

/**
    * Exemple per a M07 i M08.
    * @author: Dani Prados dprados@cendrassos.net
    *
    * Model que gestiona les tasques amb PDO.
    *
**/

namespace App\Models;

/**
    * Tasques: model que gestiona les tasques.
    * @author: Dani Prados dprados@cendrassos.net
    *
    * Per guardar, recuperar i gestionar les tasques.
    *
**/
class TasksPDO
{

    /**
     * __construct:  Crear el model tasques
     *
     * Model adaptat per PDO
     *
     * @param \App\Models\Db $sql connexió a la base de dades
     **/
    public function __construct(private $sql)
    {
    }

    /**
      * afegir:  afegeix una task
      *
      * @param $task string amb la task.
      *
    **/
    public function add($task, $userId)
    {
        $query = $this->sql->prepare('insert into tasks (task,deleted, user_id) values (:task, 0, :userId);');
        $result = $query->execute([':task' => $task, ':userId' => $userId]);
    }

    /**
      * delete:  esborra la task amb l'id $id
      *
      * La task amb id $id queda marcada com a feta i passa al llistat de fetes
      *
      * @param $id integer identificador de la task que volem esborrar.
      *
    **/
    public function delete($id)
    {
        $query = $this->sql->prepare('update tasks set deleted=1 where id=:id;');
        $result = $query->execute([":id" => $id]);
    }

    /**
      * restaura:  restaura la task amb id $id
      *
      * La task amb id $id de la llista de fetes torna a la llista de tasques.
      *
      * @param $id integer identificador de la task que volem esborrar.
      *
    **/
    public function restore($id)
    {

        //die("Restuara $id");
        $query = $this->sql->prepare('update tasks set deleted=0 where id=:id;');
        
        $result = $query->execute([":id" => $id]);
    }

    /**
      * save:  guarda les tasques codificades en format json a la cookie tasques
      *
    **/
    public function save()
    {
        //setcookie("tasques", json_encode($this->tasques));
    }

    /**
      * list:  retorna el llistat de tasques
      *
      * @return array retorna una array de strings amb les tasques pendents de fer.
    **/
    public function list($user = 1)
    {
        $tasks = [];
        $query = "select id, task from tasks where deleted=0 and user_id=:user;";
        $stm = $this->sql->prepare($query);
        $stm->execute([":user" => $user]);
        while ($task = $stm->fetch(\PDO::FETCH_ASSOC)){
            $tasks[$task["id"]] = $task["task"];
        }
        return $tasks;
    }
  
    /**
      * listDone:  retorna el llistat de tasques fetes.
      *
      * @return array retorna una array de strings amb les tasques fetes.
    **/
    public function listDone($user = 1)
    {
        $tasks = [];
        $query = "select id, task from tasks where deleted=1 and user_id=:user;";
        $stm = $this->sql->prepare($query);
        $stm->execute([":user" => $user]);
        while ($task = $stm->fetch(\PDO::FETCH_ASSOC)){
            $tasks[$task["id"]] = $task["task"];
        }
        return $tasks;
    }
}
