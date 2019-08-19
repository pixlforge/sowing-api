<?php

namespace Tests\Feature\Categories;

use Tests\TestCase;
use App\Models\Category;

class FeaturedCategoryIndexTest extends TestCase
{
    /** @test */
    public function it_can_access_the_endpoint()
    {
        $response = $this->getJson(route('categories.featured'));

        $response->assertOk();
    }

    /** @test */
    public function it_fetches_3_featured_categories()
    {
        $parentCategory = factory(Category::class)->create();

        factory(Category::class, 10)->create([
            'parent_id' => $parentCategory->id
        ]);

        $response = $this->getJson(route('categories.featured'));

        $response->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_excludes_categories_that_are_sections()
    {
        $parentCategory = factory(Category::class)->create();

        factory(Category::class)->create([
            'parent_id' => $parentCategory->id,
            'is_section' => true
        ]);

        $response = $this->getJson(route('categories.featured'));

        $response->assertJsonCount(0, 'data');
    }
}
