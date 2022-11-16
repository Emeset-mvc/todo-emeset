<?php

/**
    * Exemple per a M07 i M08.
    * @author: Dani Prados dprados@cendrassos.net
    *
    * Model que gestiona les tasques amb MySQLi.
    *
**/

namespace Daw;

/**
* Tasques: model que gestiona les tasques.
* @author: Dani Prados dprados@cendrassos.net
*
* Per guardar, recuperar i gestionar les tasques.
*
**/
class TasquesMySqli
{

    private $sql;

    /**
     * __construct:  Crear el model tasques
     *
     * Model adaptat per mysqli
     *
     * @param array $config paràmetres de configurció del model
     *
    **/
    public function __construct($config)
    {
        $this->sql = new \mysqli(
            $config["host"],
            $config["user"],
            $config["pass"],
            $config["dbname"]
        );
        if ($this->sql->connect_error) {
            die(
                'Error de Conexión (' . $this->sql->connect_errno . ') '
                . $this->sql->connect_error
            );
        }
    }

    /**
      * afegir:  afegeix una tasca
      *
      * @param $tasca string amb la tasca.
      *
    **/
    public function afegir($tasca)
    {
        $query = $this->sql->prepare('insert into tasques (tasca,borrat) values (?, 0);');
        $query->bind_param("s", $tasca);
        $result = $query->execute();
    }

    /**
      * esborrar:  esborra la tasca amb l'id $id
      *
      * La tasca amb id $id queda marcada com a feta i passa al llistat de fetes
      *
      * @param $id integer identificador de la tasca que volem esborrar.
      *
    **/
    public function esborrar($id)
    {
        $query = $this->sql->prepare('update tasques set borrat=1 where id=?;');
        $query->bind_param('i', $id);
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
    public function restaura($id)
    {
        $query = $this->sql->prepare('update tasques set borrat=0 where id=?;');
        $query->bind_param('i', $id);
        $result = $query->execute();
    }

    /**
      * guardar:  guarda les tasques codificades en format json a la cookie tasques
      *
    **/
    public function guardar()
    {
        //setcookie("tasques", json_encode($this->tasques));
    }

    /**
      * llistat:  retorna el llistat de tasques
      *
      * @return array retorna una array de strings amb les tasques pendents de fer.
    **/
    public function llistat()
    {
        $result = $this->sql->query("select id, tasca from tasques where borrat=0;");
        $tasques = array();
        while ($tasca = $result->fetch_array(MYSQLI_ASSOC)) {
        //print_r($tasca);
            $tasques[$tasca["id"]] = $tasca["tasca"];
        }
        return $tasques;
    }
  
    /**
      * llistatFetes:  retorna el llistat de tasques fetes.
      *
      * @return array retorna una array de strings amb les tasques fetes.
    **/
    public function llistatFetes()
    {
        $result = $this->sql->query("select id, tasca from tasques where borrat=1;");
        $tasques = array();
        while ($tasca = $result->fetch_array(MYSQLI_ASSOC)) {
            $tasques[$tasca["id"]] = $tasca["tasca"];
        }
        return $tasques;
    }
}
