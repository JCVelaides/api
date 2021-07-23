<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login', 'register']]);
    }

    public function register()
    {
        $user = new Usuario(request()->all());
        $user->name = $user->name;
        $user->surname = $user->surname;
        $user->email = $user->email;
        $user->password = bcrypt($user->password);
        $user->contact = $user->contact;
        $user->save();

        return response()->json(request()->all(), 200);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if(! $token = auth()->attempt($credentials))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()*60
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message'=>'succesfully logged out']);
    }

}
