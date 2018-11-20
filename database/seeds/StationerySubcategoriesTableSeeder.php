<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class StationerySubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('stationery-party')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Cards',
                'fr' => 'Cartes',
                'de' => 'Karten',
                'it' => 'Carte',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Invitations',
                'fr' => 'Faire-parts',
                'de' => 'Einladungen',
                'it' => 'Inviti',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Decorations',
                'fr' => 'Décorations',
                'de' => 'Dekorationen',
                'it' => 'Decorazioni',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Boxes',
                'fr' => 'Boîtes',
                'de' => 'Schachteln',
                'it' => 'Scatole',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Wedding Cushions',
                'fr' => 'Coussins d\'alliances',
                'de' => 'Hochzeitskissen',
                'it' => 'Cuscini da sposa',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Stencils',
                'fr' => 'Pochoirs',
                'de' => 'Schablonen',
                'it' => 'Matrice',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Notebooks',
                'fr' => 'Cahiers',
                'de' => 'Notebooks',
                'it' => 'Taccuini',
            ],
            'slug' => str_slug($name['en']),
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
            'slug' => 'stationery-other',
            'parent_id' => $parent->id,
            'order' => 8,
        ]);
    }
}
