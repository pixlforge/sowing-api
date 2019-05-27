<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Events\Users\AccountCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Users\PrivateUserResource;

class RegisterController extends Controller
{
    /**
     * Register a new user resource.
     *
     * @param RegisterRequest $request
     * @return PrivateUserResource
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'confirmation_token' => User::generateConfirmationToken($request->email)
        ]);

        AccountCreated::dispatch($user, $request->client_locale);

        return new PrivateUserResource($user);
    }
}
