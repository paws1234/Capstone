<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  
    
     public function handle($request, Closure $next)
     {
         $response = $next($request);
     
         if ($request->getMethod() === "OPTIONS") {

             return response('', 200)
                 ->header('Access-Control-Allow-Origin', '*')
                 ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                 ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
         }
     
         return $response
             ->header('Access-Control-Allow-Origin', '*')
             ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
             ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
     }
    
}
