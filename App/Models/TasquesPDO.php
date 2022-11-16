<?php

/**
    * Exemple per a M07 i M08.
    * @author: Dani Prados dprados@cendrassos.net
    *
    * Model que gestiona les tasques amb PDO.
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
class TasquesPDO
{

    private $sql;

    /**
     * __construct:  Crear el model tasques
     *
     * Model adaptat per PDO
     *
     * @param \Daw\connexio $conn connexió a la base de dades
     *
    **/
    public function __construct($conn)
    {
        $this->sql = $conn->getConn();
    }

    /**
      * afegir:  afegeix una tasca
      *
      * @param $tasca string amb la tasca.
      *
    **/
    public function afegir($tasca)
    {
        $query = $this->sql->prepare('insert into tasques (tasca,borrat) values (:tasca, 0);');
        $result = $query->execute([':tasca' => $tasca]);
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
        $query = $this->sql->prepare('update tasques set borrat=1 where id=:id;');
        $result = $query->execute([":id" => $id]);
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

        //die("Restuara $id");
        $query = $this->sql->prepare('update tasques set borrat=0 where id=:id;');
        
        $result = $query->execute([":id" => $id]);
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
        $tasques = array();
        $query = "select id, tasca from tasques where borrat=0;";
        foreach ($this->sql->query($query, \PDO::FETCH_ASSOC) as $tasca) {
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
        $tasques = array();
        $query = "select id, tasca from tasques where borrat=1;";
        foreach ($this->sql->query($query, \PDO::FETCH_ASSOC) as $tasca) {
            $tasques[$tasca["id"]] = $tasca["tasca"];
        }
        return $tasques;
    }
}
