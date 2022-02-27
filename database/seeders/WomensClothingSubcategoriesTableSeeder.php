<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class WomensClothingSubcategoriesTableSeeder extends Seeder
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
                'en' => 'Women',
                'fr' => 'Femmes',
                'de' => 'Frauen',
                'it' => 'Donne',
            ],
            'slug' => 'section-' . Str::slug($name['en']) . '-clothing',
            'parent_id' => $parent->id,
            'is_section' => true,
            'order' => 1,
        ]);

        $parent = Category::whereSlug('section-women-clothing')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Dresses',
                'fr' => 'Robes',
                'de' => 'Kleider',
                'it' => 'Abiti',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Shirts & Tunics',
                'fr' => 'Chemises & Tuniques',
                'de' => 'Hemden & Tuniken',
                'it' => 'Camicie & tuniche',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Tops & T-shirts',
                'fr' => 'Tops & T-shirts',
                'de' => 'Tops & T-shirts',
                'it' => 'Top & Magliette',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Sweaters',
                'fr' => 'Pulls',
                'de' => 'Pullover',
                'it' => 'Maglioni',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Sweatshirts',
                'fr' => 'Sweatshirts',
                'de' => 'Sweatshirts',
                'it' => 'Felpe',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Pants',
                'fr' => 'Pantalons',
                'de' => 'Hose',
                'it' => 'Pantaloni',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Overalls',
                'fr' => 'Combinaisons',
                'de' => 'Overall',
                'it' => 'Tute',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 7,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Skirts',
                'fr' => 'Jupes',
                'de' => 'Röcke',
                'it' => 'Gonne',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 8,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Shorts',
                'fr' => 'Shorts',
                'de' => 'Kurze Hose',
                'it' => 'Pantaloncini',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 9,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Jackets',
                'fr' => 'Vestes',
                'de' => 'Jacken',
                'it' => 'Giacche',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 10,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Blazers',
                'fr' => 'Blazers',
                'de' => 'Blazer',
                'it' => 'Blazers',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 11,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Coats',
                'fr' => 'Manteaux',
                'de' => 'Coats',
                'it' => 'Cappotti',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 12,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Lingerie',
                'fr' => 'Lingerie',
                'de' => 'Unterwäsche',
                'it' => 'Intimo',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 13,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Shoes',
                'fr' => 'Chaussures',
                'de' => 'Schuhe',
                'it' => 'Scarpe',
            ],
            'slug' => 'womens-' . Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 14,
        ]);
    }
}
