<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Country;

class ShopUpdateTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->patchJson(route('shops.update', 'whichever-shop'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_can_update_a_shop()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'theme_color' => $theme = Shop::THEME_GREEN,
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'description_short' => [
                'en' => 'Lorem ipsum dolor sit amet',
                'fr' => 'Lorem ipsum dolor sit amet',
                'de' => 'Lorem ipsum dolor sit amet',
                'it' => 'Lorem ipsum dolor sit amet'
            ],
            'description_long' => [
                'en' => 'Lorem ipsum dolor sit amet',
                'fr' => 'Lorem ipsum dolor sit amet',
                'de' => 'Lorem ipsum dolor sit amet',
                'it' => 'Lorem ipsum dolor sit amet'
            ],
            'theme_color' => $theme = Shop::THEME_PINK,
            'postal_code' => $postal_code = '2950',
            'city' => $city = 'Courgenay',
            'country_id' => $country->id
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('shops', [
            'theme_color' => $theme,
            'postal_code' => $postal_code,
            'city' => $city,
            'country_id' => $country->id
        ]);
    }
}
