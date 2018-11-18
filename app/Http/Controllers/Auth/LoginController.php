<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\PrivateUserResource;

class LoginController extends Controller
{
    /**
     * Log the user in.
     *
     * @param LoginRequest $request
     * @return PrivateUserResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response([
                'errors' => [
                    'email' => ['Could not sign you in with the credentials provided.']
                ]
            ], 422);
        }

        return (new PrivateUserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }
}
