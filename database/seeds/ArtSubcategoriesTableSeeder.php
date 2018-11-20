<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class ArtSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = Category::whereSlug('art')->first();

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Painting',
                'fr' => 'Peinture',
                'de' => 'Malerei',
                'it' => 'Pittura',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Photography',
                'fr' => 'Photographie',
                'de' => 'Fotografie',
                'it' => 'Fotografia',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Sculpture',
                'fr' => 'Sculpture',
                'de' => 'Skulptur',
                'it' => 'Scultura',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Engraving',
                'fr' => 'Gravure',
                'de' => 'Gravur',
                'it' => 'Incisione',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Drawings & illustrations',
                'fr' => 'Dessin & illustration',
                'de' => 'Zeichnungen & Illustrationen',
                'it' => 'Disegni e illustrazioni',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Other',
                'fr' => 'Autre',
                'de' => 'Andere',
                'it' => 'Altro',
            ],
            'slug' => 'art-other',
            'parent_id' => $parent->id,
            'order' => 6,
        ]);
    }
}
