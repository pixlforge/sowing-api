<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\WithFaker;

class ProductUpdateTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->shop()->save(
            $this->shop = Shop::factory()->make()
        );

        $this->category = Category::factory()->create();

        $this->user->shop->products()->save(
            $this->product = Product::factory()->make()
        );
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->patchJson(route('products.update', $this->product));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_the_user_does_not_own_the_shop_the_product_is_associated_to()
    {
        $user = User::factory()->create();

        $response = $this->patchJsonAs($user, route('products.update', $this->product), [
            'category_id' => $this->category->id
        ]);

        $response->assertForbidden();
    }

    /** @test */
    public function it_requires_a_category_id()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product));

        $response->assertJsonValidationErrors(['category_id']);
    }

    /** @test */
    public function it_requires_a_valid_category()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            'category_id' => 999
        ]);

        $response->assertJsonValidationErrors(['category_id']);
    }

    /** @test */
    public function it_associates_the_product_with_the_provided_category()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            'category_id' => $this->category->id
        ]);

        $response->assertSuccessful();

        $this->assertEquals(
            $this->category->id,
            $this->user->fresh()->shop->products->first()->categories->first()->id
        );
    }

    /** @test */
    public function it_requires_a_price()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product));

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_numeric()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            'price' => 'abc'
        ]);

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_at_least_100_cents()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            'price' => 99
        ]);

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_requires_a_price_to_be_at_most_99995_cents()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            'price' => 1000000,
        ]);

        $response->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_updates_the_products_price()
    {
        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            'price' => $price = Arr::random(range(1000, 20000, 5)),
        ]);

        $response->assertSuccessful();

        $this->assertEquals($price, $this->product->fresh()->price->getAmount());
    }

    /** @test */
    public function it_updates_the_products_properties()
    {
        $this->withoutExceptionHandling();
        
        $category = Category::factory()->create();

        $response = $this->patchJsonAs($this->user, route('products.update', $this->product), [
            'name' => [
                'en' => $name = $this->faker->sentence,
                'fr' => $this->faker->sentence,
                'de' => $this->faker->sentence,
                'it' => $this->faker->sentence,
            ],
            'description' => [
                'en' => $description = $this->faker->paragraph,
                'fr' => $this->faker->paragraph,
                'de' => $this->faker->paragraph,
                'it' => $this->faker->paragraph,
            ],
            'price' => $price = Arr::random(range(1000, 20000, 5)),
            'category_id' => $category->id
        ]);

        $response->assertSuccessful();

        $this->product = $this->product->fresh();

        $this->assertEquals($name, $this->product->getTranslation('name', 'en'));
        $this->assertEquals($description, $this->product->getTranslation('description', 'en'));
        $this->assertEquals($price, $this->product->price->getAmount());
        $this->assertEquals($category->id, $this->product->categories->first()->id);
    }
}
