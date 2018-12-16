<?php

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
        factory(Country::class)->create([
            'code' => 'AT',
            'name' => [
                'en' => 'Austria',
                'fr' => 'Autriche',
                'de' => 'Österreich',
                'it' => 'Austria'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'BE',
            'name' => [
                'en' => 'Belgium',
                'fr' => 'Belgique',
                'de' => 'Belgien',
                'it' => 'Belgio'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'CA',
            'name' => [
                'en' => 'Canada',
                'fr' => 'Canada',
                'de' => 'Kanada',
                'it' => 'Canada'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'CH',
            'name' => [
                'en' => 'Switzerland',
                'fr' => 'Suisse',
                'de' => 'Schweiz',
                'it' => 'Svizzera'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'DE',
            'name' => [
                'en' => 'Germany',
                'fr' => 'Allemagne',
                'de' => 'Deutschland',
                'it' => 'Germania'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'ES',
            'name' => [
                'en' => 'Spain',
                'fr' => 'Espagne',
                'de' => 'Spanien',
                'it' => 'Spagna'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'FR',
            'name' => [
                'en' => 'France',
                'fr' => 'France',
                'de' => 'Frankreich',
                'it' => 'Francia'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'IT',
            'name' => [
                'en' => 'Italy',
                'fr' => 'Italie',
                'de' => 'Italien',
                'it' => 'Italia'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'LI',
            'name' => [
                'en' => 'Liechtenstein',
                'fr' => 'Liechtenstein',
                'de' => 'Liechtenstein',
                'it' => 'Liechtenstein'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'LU',
            'name' => [
                'en' => 'Luxembourg',
                'fr' => 'Luxembourg',
                'de' => 'Luxemburg',
                'it' => 'Lussemburgo'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'NL',
            'name' => [
                'en' => 'Netherlands',
                'fr' => 'Pays-Bas',
                'de' => 'Niederlande',
                'it' => 'Paesi Bassi'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'PT',
            'name' => [
                'en' => 'Portugal',
                'fr' => 'Portugal',
                'de' => 'Portugal',
                'it' => 'Portogallo'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'PL',
            'name' => [
                'en' => 'Poland',
                'fr' => 'Pologne',
                'de' => 'Polen',
                'it' => 'Pologna'
            ]
        ]);

        factory(Country::class)->create([
            'code' => 'UK',
            'name' => [
                'en' => 'United Kingdom',
                'fr' => 'Royaume-Uni',
                'de' => 'Grossbritannien',
                'it' => 'Regno Unito'
            ]
        ]);

        factory(Country::class)->create([
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
