<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Users\AccountEmailUpdated;
use App\Http\Resources\Users\PrivateUserResource;
use App\Http\Requests\Users\UserAccountUpdateRequest;

class UserAccountController extends Controller
{
    /**
     * UserAccountController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Get the user's account infos.
     *
     * @param Request $request
     * @return PrivateUserResource
     */
    public function index(Request $request)
    {
        return new PrivateUserResource($request->user());
    }

    public function update(Request $request)
    {
        $originalEmail = $request->user()->getOriginal('email');

        $request->user()->update($request->only(['name', 'email']));

        if ($originalEmail !== $request->user()->email) {
            $request->user()->update([
                'email_verified_at' => null,
                'confirmation_token' => User::generateConfirmationToken($request->user()->email)
            ]);

            AccountEmailUpdated::dispatch($request->user(), $request->client_locale);
        }

        return new PrivateUserResource($request->user());
    }
}
