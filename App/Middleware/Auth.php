<?php

namespace App\Middleware;

class Auth {

    /**
     * Middleware que gestiona l'autenticació
     *
     * @param \Emeset\Http\Request $request petició HTTP
     * @param \Emeset\Http\Response $response resposta HTTP
     * @param \Emeset\Container $container  
     * @param callable $next  següent middleware o controlador.   
     * @return \Emeset\Http\Response resposta HTTP
     */
    public function auth($request, $response, $container, $next)
    {

        $user = $request->get("SESSION", "user");
        $logged = $request->get("SESSION", "logged");

        if (!isset($logged)) {
            $user = "";
            $logged = false;
        }

        $response->set("user", $user);
        $response->set("logged", $logged);

        // si l'usuari està logat permetem carregar el recurs
        if ($logged) {
            $response = \Emeset\Middleware::next($request, $response, $container, $next);
        } else {
            $response->redirect("location: /login");
        }
        
        return $response;
    }


    public function isAuth($request, $response, $container, $next)
    {

        $user = $request->get("SESSION", "user");
        $logged = $request->get("SESSION", "logged");
 
        if (!isset($logged)) {
            $user = "";
            $logged = false;
        }

        $response->set("user", $user);
        $response->set("logged", $logged);
        
        $response = \Emeset\Middleware::next($request, $response, $container, $next);
        
        return $response;
    }

}