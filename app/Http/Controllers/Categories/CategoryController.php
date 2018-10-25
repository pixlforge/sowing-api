<?php

namespace App\Http\Controllers\Categories;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(
            Category::with('children')->parents()->ordered()->get()
        );
    }

    public function show(Category $category)
    {
        return new CategoryResource(
            Category::with('children')->where('slug', $category->slug)->first()
        );
    }
}
