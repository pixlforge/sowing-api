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

        $this->category = factory(Category::class)->create();
    }
    
    /** @test */
    public function it_has_many_children()
    {
        $this->category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $this->category->children->first());
    }

    /** @test */
    public function it_can_fetch_only_parents()
    {
        $this->category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertCount(1, Category::parents()->get());
    }

    /** @test */
    public function it_is_orderable_by_a_numbered_order()
    {
        $category = factory(Category::class)->create([
            'order' => 2
        ]);

        $anotherCategory = factory(Category::class)->create([
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
            factory(Product::class)->create()
        );

        $this->assertInstanceOf(Product::class, $this->category->products->first());
    }
}
