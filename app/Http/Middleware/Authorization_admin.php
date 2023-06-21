<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorization_admin
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->header('Authorization')){
            if(auth('admin')->user()){
                return $next($request);
            }else{
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Unauthorized',
                ],400);
            }
        }else{
            return response()->json([
                'status' => 'Error',
                'message' => 'token not provided',
            ],400);
        }
    }
}
