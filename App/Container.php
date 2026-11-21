<?php


namespace App;

use Emeset\Container as EmesetContainer;

class Container extends EmesetContainer {

    public function __construct(array|string $config){
        parent::__construct($config);

        // fn($c): Tipus => expressió és una funció anònima curta: rep el
        // contenidor i retorna el servei. Emeset\Container l'executa quan es demana el servei.
        $dbType = $this->get("config")["db_type"];
        if($dbType == "PDO") {
            // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
            $this["Tasks"] = (fn(\Emeset\Container $c): \App\Models\TasksPDO => new \App\Models\TasksPDO($c["Db"]->getDb()));

            // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
            $this["Users"] = (fn(\Emeset\Container $c): \App\Models\UsersPDO => new \App\Models\UsersPDO($c["Db"]->getDb()));

            // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
            $this["Db"] = (fn(\Emeset\Container $c): \App\Models\Db => new \App\Models\Db(
                $c["config"]["db"]["user"],
                $c["config"]["db"]["pass"],
                $c["config"]["db"]["dbname"], 
                $c["config"]["db"]["host"]
            ));
        } else  {
            // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
            $this["Tasks"] = (fn(\Emeset\Container $c): \App\Models\TasksSQLite => new \App\Models\TasksSQLite($c->get("config")["sqlite"]));

            // Aqui podem inicialitzar totes les dependències del model i passar-les com a paràmetre.
            $this["Users"] = (fn(\Emeset\Container $c): \App\Models\UsersSQLite => new \App\Models\UsersSQLite($c->get("config")["sqlite"]));
        }
    }
}
