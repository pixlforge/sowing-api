<?php

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BeautyWellnessSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('beauty-wellness')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Facial care',
                'fr' => 'Soin du visage',
                'de' => 'Gesichtsbehandlung',
                'it' => 'Trattamento viso',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Body care',
                'fr' => 'Soin du corps',
                'de' => 'Körperpflege',
                'it' => 'Cura del corpo',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Hair care',
                'fr' => 'Soin des cheveux',
                'de' => 'Haarpflege',
                'it' => 'Cura dei capelli',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Perfume',
                'fr' => 'Parfums',
                'de' => 'Parfüm',
                'it' => 'Profumo',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Makeup',
                'fr' => 'Maquillages',
                'de' => 'Make-up',
                'it' => 'Trucco',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Soaps',
                'fr' => 'Savons',
                'de' => 'Seifen',
                'it' => 'Sapone',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Natural household products',
                'fr' => 'Produits ménagers naturels',
                'de' => 'Natürliche Haushaltsprodukte',
                'it' => 'Prodotti per la casa naturali',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 7,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Other',
                'fr' => 'Autre',
                'de' => 'Andere',
                'it' => 'Altro',
            ],
            'slug' => 'beauty-wellness-other',
            'parent_id' => $parent->id,
            'order' => 8,
        ]);
    }
}
