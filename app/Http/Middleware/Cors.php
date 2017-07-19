<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

         $headers = [
        'Access-Control-Allow-Origin' => 'http://recargasnaor.kradac.com:8084',
        'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin, Authorization',
        //'Access-Control-Expose-Headers'=> 'X-My-Custom-Header, X-Another-Custom-Header',
    ];

    if($request->getMethod() == "OPTIONS") {
        echo "con"; die();
        $response = new Response();
        foreach($headers as $key => $value)
            $response->headers->set($key, $value);

        return $response;
    }

    $response = $next($request);

    foreach($headers as $key => $value)
        $response->headers->set($key, $value);

    return $response;
    }
}
