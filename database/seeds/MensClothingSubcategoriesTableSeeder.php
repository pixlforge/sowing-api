<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class MensClothingSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('clothing')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Shirts',
                'fr' => 'Chemises',
                'de' => 'Hemden',
                'it' => 'Camicie',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'T-shirts & Polos',
                'fr' => 'T-shirts & Polos',
                'de' => 'T-Shirts & Polos',
                'it' => 'Magliette & Polo',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Sweaters',
                'fr' => 'Pulls',
                'de' => 'Pullover',
                'it' => 'Maglioni',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Pants',
                'fr' => 'Pantalons',
                'de' => 'Hose',
                'it' => 'Pantaloni',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Shorts',
                'fr' => 'Shorts',
                'de' => 'Kurze Hose',
                'it' => 'Pantaloncini',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Jackets',
                'fr' => 'Vestes',
                'de' => 'Jacken',
                'it' => 'Giacche',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Coats',
                'fr' => 'Manteaux',
                'de' => 'Coats',
                'it' => 'Cappotti',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 7,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Suits',
                'fr' => 'Costumes',
                'de' => 'Anzüge',
                'it' => 'Completi',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 8,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Underwear',
                'fr' => 'Sous-vêtements',
                'de' => 'Unterwäsche',
                'it' => 'Intimo',
            ],
            'slug' => 'mens-' . str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 9,
        ]);
    }
}
