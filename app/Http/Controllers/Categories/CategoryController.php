<?php

namespace App\Http\Controllers\Categories;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Returns a collection of categories along with their associated sub-categories.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = Category::with('children')->parents()->ordered()->get();
        
        return CategoryResource::collection($categories);
    }

    /**
     * Returns a specific category along with its associated sub-categories.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource(
            Category::with('children.children')->where('slug', $category->slug)->first()
        );
    }
}
