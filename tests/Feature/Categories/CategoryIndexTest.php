<?php

namespace Tests\Feature\Categories;

use Tests\TestCase;
use App\Models\Category;

class CategoryIndexTest extends TestCase
{
    /** @test */
    public function it_returns_a_collection_of_categories()
    {
        $category = factory(Category::class)->create();

        $response = $this->getJson(route('categories.index'));

        $response->assertJsonFragment([
            'slug' => $category->slug,
        ]);
    }

    /** @test */
    public function it_returns_only_parent_categories()
    {
        $category = factory(Category::class)->create();

        $category->children()->save(
            factory(Category::class)->create()
        );

        $response = $this->getJson(route('categories.index'));

        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function it_returns_categories_ordered_by_their_given_order()
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
}
