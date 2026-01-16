<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\Base\BaseApiController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends BaseApiController
{
    public function register(RegisterRequest $request)
    {
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

       ]);
       return $this->success(new UserResource($user), 'User registered successfully',201);
    }
}
