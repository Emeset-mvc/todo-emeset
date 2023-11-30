<?php

function test($request, $response, $container, $next)
    {

        //echo "test";
        $response = \Emeset\Middleware::next($request, $response, $container, $next);
        return $response;
    }