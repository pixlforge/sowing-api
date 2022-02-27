<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class JewelrySubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('jewelry-accessories')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Necklaces',
                'fr' => 'Colliers',
                'de' => 'Halsketten',
                'it' => 'Collane',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Bracelets',
                'fr' => 'Bracelets',
                'de' => 'Armbänder',
                'it' => 'Bracciali',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Earrings',
                'fr' => "Boucles d'oreille",
                'de' => 'Ohrringe',
                'it' => 'Orecchini',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Rings',
                'fr' => 'Bagues',
                'de' => 'Ringe',
                'it' => 'Anelli',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Hats & Caps',
                'fr' => 'Chapeaux & Casquettes',
                'de' => 'Hüte & Mutzen',
                'it' => 'Cappelli',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Scarves',
                'fr' => 'Écharpes & foulards',
                'de' => 'Schals',
                'it' => 'Sciarpe',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Gloves',
                'fr' => 'Gants',
                'de' => 'Handschuhe',
                'it' => 'Guanti',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 7,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Belts & suspenders',
                'fr' => 'Ceintures & bretelles',
                'de' => 'Gürtel & Hosenträger',
                'it' => 'Cinture & bretelle',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 8,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Bags',
                'fr' => 'Sacs',
                'de' => 'Taschen',
                'it' => 'Borse',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 9,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Ties',
                'fr' => 'Nœuds & Cravates',
                'de' => 'Knoten & Krawatten',
                'it' => 'Nodi & cravatte',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 10,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Hair accessories',
                'fr' => 'Accessoires de coiffure',
                'de' => 'Haarschmuck',
                'it' => 'Accessori per capelli',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 11,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Key holders',
                'fr' => 'Porte-clés',
                'de' => 'Schlüsselanhänger',
                'it' => 'Portachiavi',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 12,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Wallets & Cases',
                'fr' => 'Portefeuilles & Étuis',
                'de' => 'Brieftaschen & Koffer',
                'it' => 'Portafogli & Custodie',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 13,
        ]);
    }
}
