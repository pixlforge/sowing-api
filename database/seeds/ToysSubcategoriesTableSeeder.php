<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class ToysSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('toys-entertainment')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Toys for babies',
                'fr' => 'Jouets pour bébés',
                'de' => 'Spielzeug für Babys',
                'it' => 'Giocattoli per bebè',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Toys for children',
                'fr' => 'Jouets pour enfants',
                'de' => 'Spielzeug für Kinder',
                'it' => 'Giocattoli per bambini',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Dolls',
                'fr' => 'Poupées',
                'de' => 'Puppen',
                'it' => 'Bambole',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Stuffed animals',
                'fr' => 'Peluches',
                'de' => 'Kuscheltier',
                'it' => 'Animali di peluche',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Adult games',
                'fr' => 'Jeux pour adultes',
                'de' => 'Spiele für Erwachsene',
                'it' => 'Giochi per adulti',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Musical instruments',
                'fr' => 'Instruments de musique',
                'de' => 'Musikinstrumente',
                'it' => 'Strumenti musicali',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Other',
                'fr' => 'Autre',
                'de' => 'Andere',
                'it' => 'Altro',
            ],
            'slug' => 'toys-other',
            'parent_id' => $parent->id,
            'order' => 7,
        ]);
    }
}
