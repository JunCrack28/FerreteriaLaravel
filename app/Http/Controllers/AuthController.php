<?php


namespace App\Http\Controllers;

use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Importa Str para usar Str::random
use Illuminate\Support\Facades\Log; // Importa la fachada Log
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Redirige al usuario a la página de autenticación de Google
     */
    public function redirectToGoogle()
{
    return Socialite::driver('google')
        ->scopes(['openid', 'email', 'profile'])
        ->redirect();
}

    /**
     * Obtiene la información del usuario de Google y lo autentica
     */
public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        
        Log::info('Google User Data:', [
            'id' => $googleUser->id,
            'email' => $googleUser->email,
            'name' => $googleUser->name,
            'avatar' => $googleUser->avatar
        ]);
        
        $usuario = Usuario::where('correo', $googleUser->email)->first();
        
        if (!$usuario) {
            $usuario = Usuario::create([
                'nombre' => $googleUser->name,
                'correo' => $googleUser->email,
                'contrasena' => Hash::make(Str::random(16)), // Usa Str::random en lugar de str_random
                'telefono' => null,
                'fecha_registro' => Carbon::now(),
                'tipo_usuario' => 2,
                'ruta_imagen_usuario' => $googleUser->avatar,
                'google_id' => $googleUser->id,
            ]);
        } else {
            $usuario->update(['google_id' => $googleUser->id]);
        }
        
        $token = JWTAuth::fromUser($usuario);
        $cookie = cookie('jwt_token', $token, 60 * 24);
        
        return redirect('/')->withCookie($cookie);
        
    } catch (\Exception $e) {
        Log::error('Error al autenticar con Google: ' . $e->getMessage(), [
            'stack' => $e->getTraceAsString()
        ]);
        return redirect('/login')->with('error', 'Error al autenticar con Google: ' . $e->getMessage());
    }
}

    /**
     * Cerrar sesión (invalidar token)
     */
public function logout(Request $request)
{
    $token = $request->cookie('jwt_token');
    Log::info('AuthController::logout - Token in logout: ', ['token' => $token]);

    // Siempre elimina la cookie, independientemente de si el token es válido
    $cookie = cookie()->forget('jwt_token');

    if ($token) {
        try {
            JWTAuth::setToken($token);
            auth('api')->logout(); // Intenta invalidar el token
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            // Si hay un error al parsear el token, no mostramos error, solo seguimos
            Log::warning('AuthController::logout - Could not parse token, but continuing logout: ' . $e->getMessage());
        }
    }

    // Redirige a la página principal sin mensaje de error
    return redirect('/')->withCookie($cookie);
}

    /**
     * Obtener información del usuario autenticado
     */
    public function me(Request $request)
{
    $user = $request->user(); // Esto debería devolver el usuario autenticado por JWT
    return response()->json([
        'user' => $user,
    ]);
}
}