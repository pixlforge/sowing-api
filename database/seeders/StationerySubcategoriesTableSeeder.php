<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
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
            'slug' => Str::slug($name['en']),
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
            'slug' => Str::slug($name['en']),
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
            'slug' => Str::slug($name['en']),
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
            'slug' => Str::slug($name['en']),
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
            'slug' => Str::slug($name['en']),
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
            'slug' => Str::slug($name['en']),
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
            'slug' => 'stationery-other',
            'parent_id' => $parent->id,
            'order' => 8,
        ]);
    }
}
