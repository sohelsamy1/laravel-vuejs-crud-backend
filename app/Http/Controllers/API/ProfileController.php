<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Controllers\API\Base\BaseApiController;

class ProfileController extends BaseApiController
{
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        $cacheKey = "user_profile_{$user->id}";
         Cache::put($cacheKey, new UserResource($user), now()->addHour(1));

        return $this->success(new UserResource($user), 'Profile Update Success');
    }
}
