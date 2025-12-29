<?php


namespace App;

use Emeset\Container as EmesetContainer;

class Container extends EmesetContainer {

    public function __construct($config){
        parent::__construct($config);

        $dbType = $this->get("config")["db_type"];
        if($dbType == "PDO") {
            $this["Tasks"] = 
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.

                (fn($c): \App\Models\TasksPDO => new \App\Models\TasksPDO($c["Db"]->getDb()));

            $this["Users"] = 
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.

                (fn($c): \App\Models\UsersPDO => new \App\Models\UsersPDO($c["Db"]->getDb()));

            $this["Db"] = 
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.

                (fn($c): \App\Models\Db => new \App\Models\Db(
                $c["config"]["db"]["user"],
                $c["config"]["db"]["pass"],
                $c["config"]["db"]["dbname"], 
                $c["config"]["db"]["host"]
            ));
        } else  {
            $this["Tasks"] = 
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.

                (fn($c): \App\Models\TasksSQLite => new \App\Models\TasksSQLite($c->get("config")["sqlite"]));

            $this["Users"] = 
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.

                (fn($c): \App\Models\UsersSQLite => new \App\Models\UsersSQLite($c->get("config")["sqlite"]));
        }
    }
}