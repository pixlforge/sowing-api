<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\PrivateUserResource;

class MeController extends Controller
{
    /**
     * MeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Returns the authenticated User resource.
     *
     * @param Request $request
     * @return PrivateUserResource
     */
    public function __invoke(Request $request)
    {
        if ($request->user()) {
            return new PrivateUserResource($request->user());
        }
    }
}
