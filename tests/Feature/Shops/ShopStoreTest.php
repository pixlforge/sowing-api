<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Country;
use Illuminate\Support\Str;

class ShopStoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('shops.store'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'));

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_unique_name()
    {
        Shop::factory()->create([
            'name' => 'Capsule Corp'
        ]);

        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'name' => 'Capsule Corp'
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_name_of_at_least_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'name' => 'A'
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_name_of_at_most_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_short_description()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'));

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_short_description_of_at_least_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'description_short' => 'A'
        ]);

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_short_description_of_at_most_3000_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'description_short' => str_repeat('a', 3001)
        ]);

        $response->assertJsonValidationErrors(['description_short']);
    }

    /** @test */
    public function it_requires_a_long_description()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'));

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_long_description_of_at_least_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'description_long' => 'A'
        ]);

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_long_description_of_at_most_50000_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'description_long' => str_repeat('a', 50001)
        ]);

        $response->assertJsonValidationErrors(['description_long']);
    }

    /** @test */
    public function it_requires_a_theme()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'));

        $response->assertJsonValidationErrors(['theme']);
    }

    /** @test */
    public function it_requires_a_postal_code()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'));

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'postal_code' => 2900
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_of_at_least_4_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'postal_code' => '123'
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_postal_code_of_at_most_10_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'postal_code' => str_repeat('1', 11)
        ]);

        $response->assertJsonValidationErrors(['postal_code']);
    }

    /** @test */
    public function it_requires_a_city()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'));

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_in_string_format()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'city' => 123
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_of_at_least_2_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'city' => 'A'
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_city_of_at_most_255_characters()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'city' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['city']);
    }

    /** @test */
    public function it_requires_a_country()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'));

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_requires_a_valid_country()
    {
        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'country_id' => 999
        ]);

        $response->assertJsonValidationErrors(['country_id']);
    }

    /** @test */
    public function it_stores_a_new_shop()
    {
        $country = Country::factory()->create();

        $response = $this->postJsonAs($this->user, route('shops.store'), [
            'name' => $name = 'My awesome shop',
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
            'theme' => $theme = 'green',
            'postal_code' => $postal_code = '2950',
            'city' => $city = 'Courgenay',
            'country_id' => $country->id
        ]);

        $response->assertSuccessful();
        
        $this->assertDatabaseHas('shops', [
            'name' => $name,
            'slug' => Str::slug($name),
            'theme' => $theme,
            'postal_code' => $postal_code,
            'city' => $city,
            'country_id' => $country->id
        ]);
    }
}
