<?php

namespace Tests\Feature\Products;

use Tests\TestCase;

class ProductUpdateTest extends TestCase
{
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
}
