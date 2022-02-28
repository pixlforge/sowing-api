<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Country;
use Illuminate\Foundation\Testing\WithFaker;

class ShopUpdateTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->country = Country::factory()->create();

        $this->shop = Shop::factory()->create([
            'user_id' => $this->user->id,
            'country_id' => $this->country->id
        ]);
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->patchJson(route('shops.update', 'whichever-shop'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_requires_a_short_description()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug));

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_short_description_of_at_least_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'description_short' => 'A'
        ]);

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_short_description_of_at_most_3000_characters()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'description_short' => str_repeat('a', 3001)
        ]);

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_long_description()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug));

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_long_description_of_at_least_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'description_long' => 'A'
        ]);

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_long_description_of_at_most_50000_characters()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'description_long' => str_repeat('a', 50001)
        ]);

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_theme()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug));

        $response->assertJsonValidationErrors(['theme']);
    }

    /** @test */
    public function it_requires_a_postal_code()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug));

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'theme_color' => 123
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_of_at_least_4_characters()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'postal_code' => '123'
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_of_at_most_10_characters()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'postal_code' => str_repeat('1', 11)
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_city()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug));

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'city' => 123
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_of_at_least_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'city' => 'A'
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_of_at_most_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'city' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_country()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug));

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_requires_a_valid_country()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'country_id' => 999
        ]);

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_shop()
    {
        $anotherUser = User::factory()->create();

        $shop = Shop::factory()->create([
            'user_id' => $anotherUser->id,
            'country_id' => $this->country->id
        ]);

        $response = $this->patchJsonAs($this->user, route('shops.update', $shop->slug), [
            'description_short' => [
                'en' => $descriptionShort = $this->faker->sentence,
                'fr' => $descriptionShort,
                'de' => $descriptionShort,
                'it' => $descriptionShort
            ],
            'description_long' => [
                'en' => $descriptionLong = $this->faker->sentences(3, true),
                'fr' => $descriptionLong,
                'de' => $descriptionLong,
                'it' => $descriptionLong
            ],
            'theme' => 'pink',
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country_id' => $this->country->id
        ]);

        $response->assertForbidden();
    }

    /** @test */
    public function it_can_update_a_shop()
    {
        $response = $this->patchJsonAs($this->user, route('shops.update', $this->shop->slug), [
            'description_short' => [
                'en' => $descriptionShort = $this->faker->sentence,
                'fr' => $descriptionShort,
                'de' => $descriptionShort,
                'it' => $descriptionShort
            ],
            'description_long' => [
                'en' => $descriptionLong = $this->faker->sentences(3, true),
                'fr' => $descriptionLong,
                'de' => $descriptionLong,
                'it' => $descriptionLong
            ],
            'theme' => $theme = 'pink',
            'postal_code' => $postalCode = $this->faker->postcode,
            'city' => $city = $this->faker->city,
            'country_id' => $this->country->id
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('shops', [
            'theme' => $theme,
            'postal_code' => $postalCode,
            'city' => $city,
            'country_id' => $this->country->id
        ]);
    }
}
