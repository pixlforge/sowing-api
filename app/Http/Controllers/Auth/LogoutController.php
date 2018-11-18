<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * LogoutController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    //Log the user out (Invalidate the token).

    public function __invoke()
    {
        auth()->logout();

        return response(null, 204);
    }
}
