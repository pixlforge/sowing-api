<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Resources\Products\ProductResource;

class ProductStoreTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->user->shop()->save(
            $this->shop = factory(Shop::class)->make()
        );

        $this->category = factory(Category::class)->create();
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('products.store'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_name_in_french_when_the_others_are_not_set()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['name.fr']);
    }

    /** @test */
    public function it_requires_a_name_in_english_when_the_others_are_not_set()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['name.en']);
    }

    /** @test */
    public function it_requires_a_name_in_german_when_the_others_are_not_set()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['name.de']);
    }

    /** @test */
    public function it_requires_a_name_in_italian_when_the_others_are_not_set()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['name.it']);
    }

    /** @test */
    public function it_requires_each_name_to_be_a_string()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'name' => [
                'en' => 123,
                'fr' => 123,
                'de' => 123,
                'it' => 123,
            ]
        ]);

        $response->assertJsonValidationErrors([
            'name.en', 'name.fr', 'name.de', 'name.it',
        ]);
    }

    /** @test */
    public function it_requires_each_name_to_be_at_least_2_characters_long()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'name' => [
                'en' => 'e',
                'fr' => 'f',
                'de' => 'd',
                'it' => 'i',
            ]
        ]);

        $response->assertJsonValidationErrors([
            'name.en', 'name.fr', 'name.de', 'name.it',
        ]);
    }

    /** @test */
    public function it_requires_each_name_to_be_at_most_255_characters_long()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'name' => [
                'en' => str_repeat('a', 256),
                'fr' => str_repeat('a', 256),
                'de' => str_repeat('a', 256),
                'it' => str_repeat('a', 256),
            ]
        ]);

        $response->assertJsonValidationErrors([
            'name.en', 'name.fr', 'name.de', 'name.it',
        ]);
    }

    /** @test */
    public function it_requires_a_description()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['description']);
    }

    /** @test */
    public function it_allows_each_description_to_be_empty()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'description' => [
                'en' => '',
                'fr' => '',
                'de' => '',
                'it' => '',
            ]
        ]);

        $response->assertJsonMissingValidationErrors([
            'description.en', 'description.fr', 'description.de', 'description.it'
        ]);
    }

    /** @test */
    public function it_requires_each_description_to_be_a_string()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'description' => [
                'en' => 123,
                'fr' => 123,
                'de' => 123,
                'it' => 123,
            ]
        ]);

        $response->assertJsonValidationErrors([
            'description.en', 'description.fr', 'description.de', 'description.it',
        ]);
    }

    /** @test */
    public function it_requires_each_description_to_be_at_least_5_characters_long()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'description' => [
                'en' => str_repeat('a', 4),
                'fr' => str_repeat('a', 4),
                'de' => str_repeat('a', 4),
                'it' => str_repeat('a', 4)
            ]
        ]);

        $response->assertJsonValidationErrors([
            'description.en', 'description.fr', 'description.de', 'description.it'
        ]);
    }

    /** @test */
    public function it_requires_each_description_to_be_at_most_10000_characters_long()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'description' => [
                'en' => str_repeat('a', 10001),
                'fr' => str_repeat('a', 10001),
                'de' => str_repeat('a', 10001),
                'it' => str_repeat('a', 10001)
            ]
        ]);

        $response->assertJsonValidationErrors([
            'description.en', 'description.fr', 'description.de', 'description.it'
        ]);
    }

    /** @test */
    public function it_requires_a_price()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_numeric()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'price' => 'abc'
        ]);

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_at_least_100_cents()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'price' => 99
        ]);

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_at_most_99995_cents()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'price' => 1000000,
        ]);

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_category_id()
    {
        $response = $this->postJsonAs($this->user, route('products.store'));

        $response->assertJsonValidationErrors(['category_id']);
    }

    /** @test */
    public function it_requires_a_valid_category()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'category_id' => 999
        ]);

        $response->assertJsonValidationErrors(['category_id']);
    }

    /** @test */
    public function it_can_add_a_product()
    {
        $this->assertCount(0, $this->user->shop->products);

        $response = $this->postJsonAs($this->user, route('products.store'), [
            'name' => [
                'en' => $this->faker->sentence,
                'fr' => $this->faker->sentence,
                'de' => $this->faker->sentence,
                'it' => $this->faker->sentence,
            ],
            'description' => [
                'en' => $this->faker->sentences(10, true),
                'fr' => $this->faker->sentences(10, true),
                'de' => $this->faker->sentences(10, true),
                'it' => $this->faker->sentences(10, true),
            ],
            'price' => Arr::random(range(1000, 20000, 5)),
            'category_id' => $this->category->id
        ]);

        $response->assertStatus(201);

        $this->assertCount(1, $this->user->fresh()->shop->products);
    }

    /** @test */
    public function it_returns_a_product_resource()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'name' => [
                'en' => $this->faker->sentence,
                'fr' => $this->faker->sentence,
                'de' => $this->faker->sentence,
                'it' => $this->faker->sentence,
            ],
            'description' => [
                'en' => $this->faker->sentences(3, true),
                'fr' => $this->faker->sentences(3, true),
                'de' => $this->faker->sentences(3, true),
                'it' => $this->faker->sentences(3, true),
            ],
            'price' => Arr::random(range(1000, 20000, 5)),
            'category_id' => $this->category->id
        ]);

        $response->assertResource(ProductResource::make($this->user->shop->products->first()));
    }

    /** @test */
    public function it_associates_the_product_with_the_provided_category()
    {
        $response = $this->postJsonAs($this->user, route('products.store'), [
            'name' => [
                'en' => $this->faker->sentence,
                'fr' => $this->faker->sentence,
                'de' => $this->faker->sentence,
                'it' => $this->faker->sentence,
            ],
            'description' => [
                'en' => $this->faker->sentences(3, true),
                'fr' => $this->faker->sentences(3, true),
                'de' => $this->faker->sentences(3, true),
                'it' => $this->faker->sentences(3, true),
            ],
            'price' => Arr::random(range(1000, 20000, 5)),
            'category_id' => $this->category->id
        ]);

        $response->assertSuccessful();

        $this->assertEquals(
            $this->category->id,
            $this->user->fresh()->shop->products->first()->categories->first()->id
        );
    }
}
