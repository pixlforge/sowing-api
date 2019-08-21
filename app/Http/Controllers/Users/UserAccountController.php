<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\PrivateUserResource;

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
}
