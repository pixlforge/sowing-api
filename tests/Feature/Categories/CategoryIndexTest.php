<?php

namespace Tests\Feature\Categories;

use Tests\TestCase;
use App\Models\Category;
use App\Http\Resources\Categories\CategoryResource;

class CategoryIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
    }
    
    /** @test */
    public function it_returns_a_collection_of_categories()
    {
        $response = $this->getJson(route('categories.index'));

        $response->assertResource(CategoryResource::collection(Category::get()));
    }

    /** @test */
    public function it_returns_only_parent_categories()
    {
        $this->category->children()->save(
            Category::factory()->create()
        );

        $response = $this->getJson(route('categories.index'));

        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function it_returns_categories_ordered_by_their_given_order()
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
}
