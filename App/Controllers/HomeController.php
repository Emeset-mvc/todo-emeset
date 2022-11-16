<?php

namespace App\Controllers;

class HomeController 
{
    public function index($request, $response, $container)
    {
        $model = $container->get("Tasks");
        $tasques = $model->list();
        $fetes = $model->listDone();

        $response->set("tasques", $tasques);
        $response->set("fetes", $fetes);
        $response->setSession("error", "");

        $response->SetTemplate("home.php");

        return $response;
    }
}

function ctrlPortada($request, $response, $config)
{
    // Comptem quantes vegades has visitat aquesta pàgina
    $visites = $request->get(INPUT_COOKIE, "visites");
    if (!is_null($visites)) {
        $visites = (int)$visites + 1;
    } else {
        $visites = 1;
    }
    $response->setcookie("visites", $visites, strtotime("+1 month"));

    $missatge = "";
    if ($visites == 1) {
        $missatge = "Benvingut! Aquesta és la primera pàgina que visites d'aquesta web!";
    } else {
        $missatge = "Hola! Ja has visitat {$visites} pàgines d'aquesta web!";
    }

    $response->set("missatge", $missatge);
    $response->SetTemplate("portada.php");

    return $response;
}
