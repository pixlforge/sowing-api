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

    /**
     * Update a user's account.
     *
     * @param UserAccountUpdateRequest $request
     * @return PrivateUserResource
     */
    public function update(UserAccountUpdateRequest $request)
    {
        $request->user()->update($request->only(['name', 'email']));

        return PrivateUserResource::make($request->user());
    }
}
