<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class LocalProductsSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('local-products')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Pasta',
                'fr' => 'Pâtes',
                'de' => 'Pasta',
                'it' => 'Pasta',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Non-alcoholic drinks',
                'fr' => 'Boissons sans alcool',
                'de' => 'Alkoholfreie Getränke',
                'it' => 'Bevande analcoliche',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Alcoholic drinks',
                'fr' => 'Boissons avec alcool',
                'de' => 'Alkoholische Getränke',
                'it' => 'Bevande alcoliche',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Meat',
                'fr' => 'Viande',
                'de' => 'Fleisch',
                'it' => 'Carne',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Coffee & Tea',
                'fr' => 'Café & Thés',
                'de' => 'Kaffee & Tee',
                'it' => 'Caffè & tè',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Preserves',
                'fr' => 'Conserves',
                'de' => 'Eingemachtes',
                'it' => 'Conserve',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Jams',
                'fr' => 'Confitures',
                'de' => 'Konfitüren',
                'it' => 'Marmellate',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 7,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Dressings',
                'fr' => 'Sauces',
                'de' => 'Sossen',
                'it' => 'Salse',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 8,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Herbs, spices & seasonings',
                'fr' => 'Herbes, épices & assaisonnements',
                'de' => 'Kräuter & Gewürze',
                'it' => 'Erbe, spezie e condimenti',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 9,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Confectionery',
                'fr' => 'Confiserie',
                'de' => 'Süsswaren',
                'it' => 'Pasticceria',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 10,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Biscuits',
                'fr' => 'Biscuits',
                'de' => 'Gebäck',
                'it' => 'Biscotti',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 11,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Dried fruits',
                'fr' => 'Fruits séchés',
                'de' => 'Getrocknete Früchte',
                'it' => 'Frutta secca',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 12,
        ]);
    }
}
