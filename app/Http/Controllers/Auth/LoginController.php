<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Resources\Users\PrivateUserResource;

class LoginController extends Controller
{
    use ThrottlesLogins;

    /**
     * Number of login attempts before the user is locked out.
     *
     * @var integer
     */
    protected $maxAttempts = 5;

    /**
     * Lockout duration.
     *
     * @var integer
     */
    protected $decayMinutes = 1;

    /**
     * Log the user in.
     *
     * @param LoginRequest $request
     * @return PrivateUserResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $token = auth()->attempt($request->only('email', 'password'));

        if (!$token) {
            $this->incrementLoginAttempts($request);

            return response([
                'errors' => [
                    'email' => [__('auth.failed')]
                ]
            ], 422);
        }

        return (PrivateUserResource::make($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return response([
            'errors' => [
                'email' => Lang::get('auth.throttle', ['seconds' => $seconds]),
            ]
        ], 429);
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input($this->username())) . '|' . $request->ip();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
