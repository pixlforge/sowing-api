<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BabiesChildrenSubcategoriesTableSeeder extends Seeder
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
                'en' => 'Babies',
                'fr' => 'Bébés',
                'de' => 'Babys',
                'it' => 'Bambini',
            ],
            'slug' => 'section-' . Str::slug($name['en']) . '-children',
            'parent_id' => $parent->id,
            'is_section' => true,
            'order' => 1,
        ]);

        $parent = Category::whereSlug('section-babies-children')->first();

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Tops',
                'fr' => 'Hauts',
                'de' => 'Tops',
                'it' => 'Top',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Bottom',
                'fr' => 'Bas',
                'de' => 'Boden',
                'it' => 'Pantaloni',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Dresses',
                'fr' => 'Robes',
                'de' => 'Kleider',
                'it' => 'Vestiti',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Sets',
                'fr' => 'Ensembles',
                'de' => 'Sets',
                'it' => 'Set',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Bodys',
                'fr' => 'Bodys',
                'de' => 'Bodys',
                'it' => 'Bodys',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Pajamas',
                'fr' => 'Pyjamas',
                'de' => 'Nachtwäsche',
                'it' => 'Pigiami',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Bathrobs',
                'fr' => 'Peignoirs',
                'de' => 'Bademäntel',
                'it' => 'Accappatoi',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 7,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Overalls & coats',
                'fr' => 'Combinaisons & manteaux',
                'de' => 'Overall und Mäntel',
                'it' => 'Tute e cappotti',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 8,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Sleeping bags',
                'fr' => 'Gigoteuses',
                'de' => 'Schlafsäcke',
                'it' => 'Sacchi a pelo',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 9,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Slippers',
                'fr' => 'Chaussons',
                'de' => 'Pantoffeln',
                'it' => 'Pantofole',
            ],
            'slug' => 'babies-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 10,
        ]);
    }
}
