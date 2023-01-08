<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class AuthAPIController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        // JWTAuth::attempt

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'string | required',
            'email' => 'email | required',
            'passowrd' => 'string | min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Registration faild: ',
                'errors' => $validator->messages()
            ]);
        }

        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 200);

    }

    public function logout(Request $request)
    {
        $validator = validator()->make($request->all(), ['token' => 'required']);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        JWTAuth::invalidate($request->token);
 
        return response()->json([
            'success' => true,
            'message' => 'User has been logged out'
        ]);
    }

    public function get_user(Request $request)
    {
        $validator = validator()->make($request->all(), ['token' => 'required']);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'you are not authenticated',
                'error' => $validator->messages()
            ], 201);
        }

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'access' => true,
            'expires_in' => config('jwt.ttl')
        ]);
    }

}
