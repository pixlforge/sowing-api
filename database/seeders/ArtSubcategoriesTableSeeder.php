<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
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

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Painting',
                'fr' => 'Peinture',
                'de' => 'Malerei',
                'it' => 'Pittura',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 1,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Photography',
                'fr' => 'Photographie',
                'de' => 'Fotografie',
                'it' => 'Fotografia',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 2,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Sculpture',
                'fr' => 'Sculpture',
                'de' => 'Skulptur',
                'it' => 'Scultura',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 3,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Engraving',
                'fr' => 'Gravure',
                'de' => 'Gravur',
                'it' => 'Incisione',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 4,
        ]);

        Category::factory()->create([
            'name' => $name = [
                'en' => 'Drawings & illustrations',
                'fr' => 'Dessin & illustration',
                'de' => 'Zeichnungen & Illustrationen',
                'it' => 'Disegni e illustrazioni',
            ],
            'slug' => Str::slug($name['en']),
            'parent_id' => $parent->id,
            'order' => 5,
        ]);

        Category::factory()->create([
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
