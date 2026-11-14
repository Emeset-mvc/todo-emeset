<?php

namespace App\Controllers;

class ErrorController 
{
    public function error404(\Emeset\Contracts\Http\Request $request, \Emeset\Contracts\Http\Response $response, \Emeset\Contracts\Container $container): \Emeset\Contracts\Http\Response
    {

      $error = $request->get("SESSION", "error");
      $response->set("error", $error);
      $response->SetTemplate("error.php");

      return $response;
    }
}