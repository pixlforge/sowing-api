<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    /**
     * VerificationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Verify the account.
     *
     * @param Request $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $token = $request->token;
        $user = $request->user();

        if (!$token || !$user || !$this->compareTokens($user, $token)) {
            return response([
                'errors' => [
                    'token' => __('auth.verification.failed')
                ]
            ], 422);
        }

        $this->verifyAccount($user);
    }

    /**
     * Verify the user account.
     *
     * @param User $user
     * @return void
     */
    protected function verifyAccount(User $user)
    {
        $user->update([
            'email_verified_at' => now(),
            'confirmation_token' => null
        ]);
    }

    /**
     * Compare the user's confirmation token to the token from the request.
     *
     * @param User $user
     * @param string $token
     * @return boolean
     */
    protected function compareTokens(User $user, $token)
    {
        return $user->getConfirmationToken() === $token;
    }
}
