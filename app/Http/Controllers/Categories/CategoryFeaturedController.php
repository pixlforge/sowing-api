<?php

namespace App\Http\Controllers\Categories;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Categories\CategoryResource;

class CategoryFeaturedController extends Controller
{
    /**
     * Get the featured categories for the day.
     *
     * @return App\Http\Resources\Categories\CategoryResource
     */
    public function __invoke()
    {
        $categories = Cache::remember(
            'featured_categories',
            now()->addDay(),
            function () {
                return Category::with('parent')
                    ->childrenOnly()
                    ->excludeSections()
                    ->inRandomOrder()
                    ->get()
                    ->take(3);
        });
        
        return CategoryResource::collection($categories);
    }
}
