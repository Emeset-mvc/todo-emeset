<?php

namespace App\Controllers;

class AboutController
{

    public static function index(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response{
        $response->SetTemplate("about.php");
        return $response;
    }
}
