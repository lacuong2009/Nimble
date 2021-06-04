<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 8/24/17
 * Time: 4:13 PM
 */

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * @param $request
     * @param \Closure $next
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory|mixed
     */
    public function handle($request, Closure $next)
    {
        //Intercepts OPTIONS requests
        if ($request->isMethod('OPTIONS')) {
            $response = response('', 204);
        } else {
            // Pass the request to the next middleware
            $response = $next($request);
        }

        // Adds headers to the response
        if (method_exists($response, 'header')) {
            $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
            $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
            $response->header('Access-Control-Allow-Origin', '*');
        } elseif (method_exists($response, 'addHttpHeaders')) { // OAuth2\HttpFoundationBridge\Response
            $response->addHttpHeaders(
                [
                    'Access-Control-Allow-Methods' => 'HEAD, GET, POST, PUT, PATCH, DELETE',
                    'Access-Control-Allow-Origin'  => '*',
                    'Access-Control-Allow-Headers' => $request->header('Access-Control-Request-Headers')
                ]
            );
        }

        return $response;
    }
}
