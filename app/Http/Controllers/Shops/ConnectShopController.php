<?php

namespace App\Http\Controllers\Shops;

use Illuminate\Http\Request;
use GuzzleHttp\Client as Guzzle;
use App\Http\Controllers\Controller;

class ConnectShopController extends Controller
{
    /**
     * ConnectController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Guzzle $guzzle
     * @return void
     */
    public function __invoke(Request $request, Guzzle $guzzle)
    {
        abort_if(!$request->user()->hasShop(), 403);

        if (!$request->code) {
            return response(null, 400);
        }

        $stripeRequest = $guzzle->request('POST', 'https://connect.stripe.com/oauth/token', [
            'form_params' => [
                'client_secret' => config('services.stripe.secret'),
                'code' => $request->code,
                'grant_type' => 'authorization_code'
            ]
        ]);

        $stripeResponse = json_decode($stripeRequest->getBody());

        $request->user()->shop->update([
            'stripe_user_id' => $stripeResponse->stripe_user_id,
            'stripe_publishable_key' => $stripeResponse->stripe_publishable_key
        ]);
    }
}
