<?php
namespace App\Http\Controllers;
use App\Business;
use Illuminate\Http\Request;
class BusinessAuthController extends Controller
{
    public function register(Request $request)
    {
        $user = Business::create([
             'name' => $request->name,
             'email'    => $request->email,
             'password' => $request->password,
             'location' =>$request->location,
         ]);

        $token = auth()->guard('businesses')->login($user);
        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('businesses')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('businesses')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('businesses')->factory()->getTTL() * 60
        ]);
    }
}