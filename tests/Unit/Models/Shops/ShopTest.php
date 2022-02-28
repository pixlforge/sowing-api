<?php

namespace Tests\Unit\Models\Shops;

use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;

class ShopTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->shop = Shop::factory()->create();
    }
    
    /** @test */
    public function it_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->shop->user);
    }

    /** @test */
    public function it_belongs_to_a_country()
    {
        $this->assertInstanceOf(Country::class, $this->shop->country);
    }

    /** @test */
    public function it_has_many_products()
    {
        $this->shop->products()->save(
            Product::factory()->create()
        );

        $this->assertInstanceOf(Product::class, $this->shop->products()->first());
    }

    /** @test */
    public function it_generates_a_slug_based_on_the_name()
    {
        $this->assertEquals(Str::slug($this->shop->name), $this->shop->slug);
    }
}
