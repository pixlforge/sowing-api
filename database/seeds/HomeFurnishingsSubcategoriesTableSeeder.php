<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class HomeFurnishingsSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('home-furnishings')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Living room',
                'fr' => 'Salon',
                'de' => 'Wohnzimmer',
                'it' => 'Soggiorno',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Dining room',
                'fr' => 'Salle à manger',
                'de' => 'Esszimmer',
                'it' => 'Sala da pranzo',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Kitchen',
                'fr' => 'Cuisine',
                'de' => 'Küche',
                'it' => 'Cucina',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Office',
                'fr' => 'Bureau',
                'de' => 'Büro',
                'it' => 'Ufficio',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Adult\'s room',
                'fr' => 'Chambre d\'adulte',
                'de' => 'Erwachsenenzimmer',
                'it' => 'Stanze per adulti',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Child\'s room',
                'fr' => 'Chambre d\'enfant',
                'de' => 'Kinderzimmer',
                'it' => 'Stanze per bambini',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Baby room',
                'fr' => 'Chambre de bébé',
                'de' => 'Babyzimmer',
                'it' => 'Stanze per neonati',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 7,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Bathroom',
                'fr' => 'Salle de bain',
                'de' => 'Badezimmer',
                'it' => 'Bagno',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 8,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Adornment',
                'fr' => 'Décoration',
                'de' => 'Dekoration',
                'it' => 'Decorazioni',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 9,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Plants',
                'fr' => 'Plantes',
                'de' => 'Pflanzen',
                'it' => 'Piante',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 10,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Linens',
                'fr' => 'Linge de maison',
                'de' => 'Bettwäsche',
                'it' => 'Biancheria',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 11,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Carpet',
                'fr' => 'Tapis',
                'de' => 'Teppich',
                'it' => 'Tappeti',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 12,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Garden',
                'fr' => 'Jardin',
                'de' => 'Garten',
                'it' => 'Giardino',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 13,
        ]);
    }
}
