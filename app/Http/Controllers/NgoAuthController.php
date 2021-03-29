<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Ngo;
use Illuminate\Http\Request;

class NgoAuthController extends Controller
{
    public function register(Request $request)
    {
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        $user = Ngo::create([
             'name' => $request->name,
             'email'    => $request->email,
             'password' => $request->password,
             'location' =>$request->location,
             'url'=>$request->url,
             'image'=>$path,
             'phone_number' => $request->phone_number,
         ]);

        $token = auth()->guard('ngos')->login($user);
        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('ngos')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('ngos')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {        $user= auth('ngos')->user();

        return response()->json([

            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('ngos')->factory()->getTTL() * 60,
            'user'=>$user
        ]);
    }
}