<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::factory()->create([
            'code' => 'AT',
            'name' => [
                'en' => 'Austria',
                'fr' => 'Autriche',
                'de' => 'Österreich',
                'it' => 'Austria'
            ]
        ]);

        Country::factory()->create([
            'code' => 'BE',
            'name' => [
                'en' => 'Belgium',
                'fr' => 'Belgique',
                'de' => 'Belgien',
                'it' => 'Belgio'
            ]
        ]);

        Country::factory()->create([
            'code' => 'CA',
            'name' => [
                'en' => 'Canada',
                'fr' => 'Canada',
                'de' => 'Kanada',
                'it' => 'Canada'
            ]
        ]);

        Country::factory()->create([
            'code' => 'CH',
            'name' => [
                'en' => 'Switzerland',
                'fr' => 'Suisse',
                'de' => 'Schweiz',
                'it' => 'Svizzera'
            ]
        ]);

        Country::factory()->create([
            'code' => 'DE',
            'name' => [
                'en' => 'Germany',
                'fr' => 'Allemagne',
                'de' => 'Deutschland',
                'it' => 'Germania'
            ]
        ]);

        Country::factory()->create([
            'code' => 'ES',
            'name' => [
                'en' => 'Spain',
                'fr' => 'Espagne',
                'de' => 'Spanien',
                'it' => 'Spagna'
            ]
        ]);

        Country::factory()->create([
            'code' => 'FR',
            'name' => [
                'en' => 'France',
                'fr' => 'France',
                'de' => 'Frankreich',
                'it' => 'Francia'
            ]
        ]);

        Country::factory()->create([
            'code' => 'IT',
            'name' => [
                'en' => 'Italy',
                'fr' => 'Italie',
                'de' => 'Italien',
                'it' => 'Italia'
            ]
        ]);

        Country::factory()->create([
            'code' => 'LI',
            'name' => [
                'en' => 'Liechtenstein',
                'fr' => 'Liechtenstein',
                'de' => 'Liechtenstein',
                'it' => 'Liechtenstein'
            ]
        ]);

        Country::factory()->create([
            'code' => 'LU',
            'name' => [
                'en' => 'Luxembourg',
                'fr' => 'Luxembourg',
                'de' => 'Luxemburg',
                'it' => 'Lussemburgo'
            ]
        ]);

        Country::factory()->create([
            'code' => 'NL',
            'name' => [
                'en' => 'Netherlands',
                'fr' => 'Pays-Bas',
                'de' => 'Niederlande',
                'it' => 'Paesi Bassi'
            ]
        ]);

        Country::factory()->create([
            'code' => 'PT',
            'name' => [
                'en' => 'Portugal',
                'fr' => 'Portugal',
                'de' => 'Portugal',
                'it' => 'Portogallo'
            ]
        ]);

        Country::factory()->create([
            'code' => 'PL',
            'name' => [
                'en' => 'Poland',
                'fr' => 'Pologne',
                'de' => 'Polen',
                'it' => 'Pologna'
            ]
        ]);

        Country::factory()->create([
            'code' => 'UK',
            'name' => [
                'en' => 'United Kingdom',
                'fr' => 'Royaume-Uni',
                'de' => 'Grossbritannien',
                'it' => 'Regno Unito'
            ]
        ]);

        Country::factory()->create([
            'code' => 'US',
            'name' => [
                'en' => 'United States',
                'fr' => 'États-Unis',
                'de' => 'Vereinigte Staaten',
                'it' => 'Stati Uniti'
            ]
        ]);
    }
}
