<?php

namespace App\Controllers;

class AboutController
{

    public static function index($request, $response, $container){
        $response->SetTemplate("about.php");
        return $response;
    }
}
