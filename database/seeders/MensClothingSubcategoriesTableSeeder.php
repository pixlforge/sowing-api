<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
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

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Men',
                'fr' => 'Hommes',
                'de' => 'Menschen',
                'it' => 'Uomini',
            ],
            'slug' => 'section-' . Str::slug($name['en']) . '-clothing',
            'parent_id' => $parent->id,
            'is_section' => true,
            'order' => 1,
        ]);

        $parent = Category::whereSlug('section-men-clothing')->first();

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Shirts',
                'fr' => 'Chemises',
                'de' => 'Hemden',
                'it' => 'Camicie',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'T-shirts & Polos',
                'fr' => 'T-shirts & Polos',
                'de' => 'T-Shirts & Polos',
                'it' => 'Magliette & Polo',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Sweaters',
                'fr' => 'Pulls',
                'de' => 'Pullover',
                'it' => 'Maglioni',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Pants',
                'fr' => 'Pantalons',
                'de' => 'Hose',
                'it' => 'Pantaloni',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Shorts',
                'fr' => 'Shorts',
                'de' => 'Kurze Hose',
                'it' => 'Pantaloncini',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Jackets',
                'fr' => 'Vestes',
                'de' => 'Jacken',
                'it' => 'Giacche',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Coats',
                'fr' => 'Manteaux',
                'de' => 'Coats',
                'it' => 'Cappotti',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 7,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Suits',
                'fr' => 'Costumes',
                'de' => 'Anzüge',
                'it' => 'Completi',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 8,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Underwear',
                'fr' => 'Sous-vêtements',
                'de' => 'Unterwäsche',
                'it' => 'Intimo',
            ],
            'slug' => 'mens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 9,
        ]);
    }
}
