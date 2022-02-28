<?php

namespace Tests\Unit\Models\Categories;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class CategoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
    }
    
    /** @test */
    public function it_has_many_children()
    {
        $this->category->children()->save(
            Category::factory()->create()
        );

        $this->assertInstanceOf(Category::class, $this->category->children->first());
    }

    /** @test */
    public function it_can_fetch_only_parents()
    {
        $this->category->children()->save(
            Category::factory()->create()
        );

        $this->assertCount(1, Category::parents()->get());
    }

    /** @test */
    public function it_is_orderable_by_a_numbered_order()
    {
        $category = Category::factory()->create([
            'order' => 2
        ]);

        $anotherCategory = Category::factory()->create([
            'order' => 1
        ]);

        $response = $this->getJson(route('categories.index'));

        $response->assertSeeInOrder([
            $anotherCategory->slug,
            $category->slug
        ]);
    }

    /** @test */
    public function it_has_many_products()
    {
        $this->category->products()->save(
            Product::factory()->create()
        );

        $this->assertInstanceOf(Product::class, $this->category->products->first());
    }
}
