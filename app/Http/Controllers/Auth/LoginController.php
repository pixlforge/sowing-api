<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\PrivateUserResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        $credentials = $request->only('email', 'password');
        
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response([
                    'errors' => [
                        'email' => ['Could not sign you in with the credentials provided.']
                    ]
                ], 422);
            }
        } catch (JWTException $e) {
            return response([
                'errors' => 'could_not_create_token'
            ], 500);
        }

        // $token = auth()->attempt($request->only('email', 'password'));

        // if (!$token) {
        //     return response([
        //         'errors' => [
        //             'email' => ['Could not sign you in with the credentials provided.']
        //         ]
        //     ], 422);
        // }

        return (new PrivateUserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }
}
