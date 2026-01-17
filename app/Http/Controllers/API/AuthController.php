<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\API\Base\BaseApiController;

class AuthController extends BaseApiController
{
      //Register
    public function register(RegisterRequest $request)
    {
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

       ]);
       return $this->success(new UserResource($user), 'User registered successfully',201);
    }
       //Login
     public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->error('Invalid credentials', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user'  => new UserResource($user),
            'token' => $token,
        ], 'Login successful');
    }
       //Logout
     public function logout(Request $request)
    {
        $user = $request->user();
        $cacheKey = "user_profile_{$user->id}";
        Cache::forget($cacheKey);
        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Logout successful');
    }
        //Me
    public function me(Request $request)
    {
        $user = $request->user();
        $cacheKey = "user_profile_{$user->id}";
        $cached = Cache::remember($cacheKey,now()->addHour(1),function () use ($user){
        return new UserResource($user);
        });
        return $this->success(new UserResource($request->user()), 'User profile');
    }
}
