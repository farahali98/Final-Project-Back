<?php
namespace App\Http\Controllers;
use App\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessAuthController extends Controller
{
    public function register(Request $request)
    {
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        $user = Business::create([
             'name' => $request->name,
             'email'    => $request->email,
             'password' => $request->password,
             'location' =>$request->location,
             'url'=>$request->url,
             'phone_number'=>$request->phone_number,
             'image'=>$path
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
        $user= auth('businesses')->user();
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('businesses')->factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }
}