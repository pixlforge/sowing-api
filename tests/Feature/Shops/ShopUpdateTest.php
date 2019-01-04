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
    public function it_requires_a_short_description()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug));

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_short_description_of_at_least_2_characters()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'description_short' => 'A'
        ]);

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_short_description_of_at_most_3000_characters()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'description_short' => str_repeat('a', 3001)
        ]);

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_long_description()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug));

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_long_description_of_at_least_2_characters()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'description_long' => 'A'
        ]);

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_long_description_of_at_most_50000_characters()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'description_long' => str_repeat('a', 50001)
        ]);

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_theme()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug));

        $response->assertJsonValidationErrors(['theme']);
    }

    /** @test */
    public function it_requires_a_postal_code()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug));

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_in_string_format()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'theme_color' => 123
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_of_at_least_4_characters()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'postal_code' => '123'
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_of_at_most_10_characters()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'postal_code' => str_repeat('1', 11)
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_city()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug));

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_in_string_format()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'city' => 123
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_of_at_least_2_characters()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'city' => 'A'
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_of_at_most_255_characters()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'city' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_country()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug));

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_requires_a_valid_country()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'country_id' => $country->id
        ]);

        $response = $this->patchJsonAs($user, route('shops.update', $shop->slug), [
            'country_id' => 999
        ]);

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_shop()
    {
        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $anotherUser->id,
            'country_id' => $country->id
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
            'theme' => 'pink',
            'postal_code' => '2950',
            'city' => 'Courgenay',
            'country_id' => $country->id
        ]);

        $response->assertForbidden();
    }

    /** @test */
    public function it_can_update_a_shop()
    {
        $user = factory(User::class)->create();

        $country = factory(Country::class)->create();

        $shop = factory(Shop::class)->create([
            'user_id' => $user->id,
            'theme' => $theme = 'green',
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
            'theme' => $theme = 'pink',
            'postal_code' => $postal_code = '2950',
            'city' => $city = 'Courgenay',
            'country_id' => $country->id
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('shops', [
            'theme' => $theme,
            'postal_code' => $postal_code,
            'city' => $city,
            'country_id' => $country->id
        ]);
    }
}
