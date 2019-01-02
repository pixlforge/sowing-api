<?php

namespace App\Http\Controllers\Images;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopImageController extends Controller
{
    /**
     * ShopImageController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Store and associate an image to the shop.
     *
     * @param Shop $shop
     * @param Request $request
     * @return string
     */
    public function store(Shop $shop, Request $request)
    {
        $type = $request->query('type');

        if ($shop->hasMedia($type)) {
            $this->deleteExistingMedia($shop, $type);
        }
    
        $shop->addMedia($request->file('file'))->toMediaCollection($type);

        return response([
            'media' => [
                'type' => $type,
                'url' => $shop->fresh()->getFirstMedia($type)->getFullUrl()
            ]
        ], 200);
    }

    /**
     * Delete all existing media of type associated with the shop.
     *
     * @param Shop $shop
     * @param string $type
     * @return void
     */
    protected function deleteExistingMedia(Shop $shop, $type)
    {
        $shop->getMedia($type)->each(function ($media) {
            $media->delete();
        });
    }
}
