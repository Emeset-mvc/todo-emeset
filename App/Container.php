<?php


namespace App;

use Emeset\Container as EmesetContainer;

class Container extends EmesetContainer {

    public function __construct($config){
        parent::__construct($config);

        $dbType = $this->get("config")["db_type"];
        if($dbType == "PDO") {
            $this["Tasks"] = function ($c) {
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
                return new \App\Models\TasksPDO($c["Db"]->getDb());
            };

            $this["Users"] = function ($c) {
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
                return new \App\Models\UsersPDO($c["Db"]->getDb());
            };

            $this["Db"] = function ($c) {
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
                return new \App\Models\Db(
                    $c["config"]["db"]["user"],
                    $c["config"]["db"]["pass"],
                    $c["config"]["db"]["dbname"], 
                    $c["config"]["db"]["host"]
                );
            };
        } else  {
            $this["Tasks"] = function ($c) {
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
                return new \App\Models\TasksSQLite($c->get("config")["sqlite"]);
            };

            $this["Users"] = function ($c) {
                // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
                return new \App\Models\UsersSQLite($c->get("config")["sqlite"]);
            };
        }
    }
}