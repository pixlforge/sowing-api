<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class GirlsChildrenSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('children')->first();

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Girls',
                'fr' => 'Filles',
                'de' => 'Mädchen',
                'it' => 'Ragazze',
            ],
            'slug' => 'section-' . Str::slug($name['en']) . '-children',
            'parent_id' => $parent->id,
            'is_section' => true,
            'order' => 2,
        ]);

        $parent = Category::whereSlug('section-girls-children')->first();

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Dresses',
                'fr' => 'Robes',
                'de' => 'Kleider',
                'it' => 'Vestiti',
            ],
            'slug' => 'girls-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Skirts',
                'fr' => 'Jupes',
                'de' => 'Röcke',
                'it' => 'Gonne',
            ],
            'slug' => 'girls-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Tops',
                'fr' => 'Hauts',
                'de' => 'Tops',
                'it' => 'Top',
            ],
            'slug' => 'girls-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Jackets & coats',
                'fr' => 'Vestes & manteaux',
                'de' => 'Jacken und Mäntel',
                'it' => 'Giacche e cappotti',
            ],
            'slug' => 'girls-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);
    }
}
