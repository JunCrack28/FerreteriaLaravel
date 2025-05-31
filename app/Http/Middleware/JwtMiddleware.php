<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Si hay un token en la cookie, establecerlo en la solicitud
            if ($request->cookie('jwt_token')) {
                $request->headers->set('Authorization', 'Bearer ' . $request->cookie('jwt_token'));
            }
            
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['status' => 'Token inválido'], 401);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json(['status' => 'Token expirado'], 401);
            } else {
                return response()->json(['status' => 'Token de autorización no encontrado'], 401);
            }
        }
        return $next($request);
    }
}