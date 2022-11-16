<?php

namespace App\Controllers;

class ErrorController 
{
    public function error404($request, $response, $container)
    {

      $error = $request->get("SESSION", "error");
      $response->set("error", $error);
      $response->SetTemplate("error.php");

      return $response;
    }
}