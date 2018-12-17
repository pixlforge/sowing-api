<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function creating(Category $category) : void
    {
        if (is_null($category->slug)) {
            $category->slug = str_slug(request()->translations_name_en);
        }
    }
}
