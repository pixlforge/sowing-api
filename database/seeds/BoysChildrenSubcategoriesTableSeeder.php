<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class BoysChildrenSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('children')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Boys',
                'fr' => 'Garçons',
                'de' => 'Jungs',
                'it' => 'Ragazzi',
            ],
            'slug' => 'section-' . str_slug($name['en']) . '-children',
            'parent_id' => $parent->id,
            'is_section' => true,
            'order' => 3,
        ]);

        $parent = Category::whereSlug('section-boys-children')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Tops',
                'fr' => 'Hauts',
                'de' => 'Tops',
                'it' => 'Top',
            ],
            'slug' => 'boys-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Bottom',
                'fr' => 'Bas',
                'de' => 'Boden',
                'it' => 'Pantaloni',
            ],
            'slug' => 'boys-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Jackets & coats',
                'fr' => 'Vestes & manteaux',
                'de' => 'Jacken und Mäntel',
                'it' => 'Giacche e cappotti',
            ],
            'slug' => 'boys-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);
    }
}
