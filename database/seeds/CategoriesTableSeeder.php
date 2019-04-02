<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Jewelry & accessories',
                'fr' => 'Bijoux & accessoires',
                'de' => 'Schmuck & Zubehör',
                'it' => 'Gioielli & accessori',
            ],
            'description' => [
                'en' => 'Find all the accessories to perfect your look whether you are a man or a woman.',
                'fr' => 'Retrouvez tous les accessoires pour parfaire votre look que vous soyez un homme ou une femme.',
                'de' => 'Finden Sie alle Accessoires, um Ihren Look zu perfektionieren, egal ob Sie ein Mann oder eine Frau sind.',
                'it' => 'Trova tutti gli accessori per perfezionare il vostro look sia che vi siete un uomo o una donna.',
            ],
            'slug' => str_slug($name['en']),
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Clothing',
                'fr' => 'Vêtements',
                'de' => 'Kleidung',
                'it' => 'Vestiti',
            ],
            'description' => [
                'en' => 'For style from head to toe, check out all our categories of clothing.',
                'fr' => 'Pour avoir du style de la tête aux pieds, consultez toutes nos catégories de vêtement.',
                'de' => 'Schauen Sie sich alle unsere Kleidungskategorien an.',
                'it' => 'Per lo stile dalla testa ai piedi, controllate tutte le nostre categorie di abbigliamento.',
            ],
            'slug' => str_slug($name['en']),
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Beauty & Wellness',
                'fr' => 'Beauté & bien-être',
                'de' => 'Schönheit & Wellness',
                'it' => 'Bellezza & benessere',
            ],
            'description' => [
                'en' => 'Need to take care of yourself? Want to offer well-being? We offer a wide choice of ideas to spend a great moment of relaxation.',
                'fr' => "Besoin de prendre soin de soi? Envie d'offrir du bien-être? Nous vous proposons un large choix d’idées pour passer un super moment de détente.",
                'de' => 'Müssen Sie auf sich aufpassen Möchten Sie Wohlbefinden bieten? Wir bieten eine große Auswahl an Ideen, um einen Moment der Entspannung zu verbringen.',
                'it' => 'Hai bisogno di prenderti cura di te? Vuoi offrire benessere? Offriamo una vasta scelta di idee per trascorrere un ottimo momento di relax.',
            ],
            'slug' => str_slug($name['en']),
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Home & Furnishings',
                'fr' => 'Maison & ameublement',
                'de' => 'Haus & Einrichtung',
                'it' => 'Casa & arredamento',
            ],
            'description' => [
                'en' => 'Check out the original creations of our artisans to make your interior as unique as you.',
                'fr' => 'Consultez les créations originales de nos artisans pour rendre votre intérieur aussi unique que vous.',
                'de' => 'Schauen Sie sich die originellen Kreationen unserer Handwerker an, um Ihr Interieur so einzigartig wie Sie zu gestalten.',
                'it' => 'Scopri le creazioni originali dei nostri artigiani per rendere i tuoi interni unici come te.',
            ],
            'slug' => str_slug($name['en']),
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Stationery & Party',
                'fr' => 'Papeterie & Fêtes',
                'de' => 'Schreibwaren & Party',
                'it' => 'Cartoleria e feste',
            ],
            'description' => [
                'en' => 'To communicate a message in all originality, you are in the right place.',
                'fr' => 'Pour communiquer un message en tout originalité, vous êtes à la bonne place.',
                'de' => 'Um eine Nachricht in aller Originalität zu vermitteln, sind Sie an der richtigen Stelle.',
                'it' => "Per comunicare un messaggio in tutta l'originalità, sei nel posto giusto.",
            ],
            'slug' => str_slug($name['en']),
            'order' => 5,
            ]);
            
        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Children',
                'fr' => 'Enfants',
                'de' => 'Kinder',
                'it' => 'Bambini',
            ],
            'description' => [
                'en' => 'Discover the categories of clothing and games reserved for toddlers.',
                'fr' => 'Découvrez les catégories de vêtements et de jeux réservées aux tout-petits.',
                'de' => 'Entdecken Sie die Kategorien von Kleidung und Spielen für Kleinkinder.',
                'it' => 'Scopri le categorie di abbigliamento e giochi riservati ai più piccoli.',
            ],
            'slug' => str_slug($name['en']),
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Art',
                'fr' => 'Art',
                'de' => 'Kunst',
                'it' => 'Arte',
            ],
            'description' => [
                'en' => 'For those who know how to appreciate the beauty of the works of our often hidden talents.',
                'fr' => 'Pour ceux qui savent apprécier la beauté des œuvres de nos talents souvent cachés.',
                'de' => 'Für diejenigen, die die Schönheit der Werke unserer oft verborgenen Talente zu schätzen wissen.',
                'it' => 'Per coloro che sanno apprezzare la bellezza delle opere dei nostri talenti spesso nascosti.',
            ],
            'slug' => str_slug($name['en']),
            'order' => 7,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Local products',
                'fr' => 'Produits locaux',
                'de' => 'Lokale Produkte',
                'it' => 'Prodotti locali',
            ],
            'description' => [
                'en' => 'To discover or to offer, here is a multitude of artisan products that will delight your taste buds.',
                'fr' => 'Pour découvrir ou pour offrir, voici une multitude de produits artisanaux qui raviront vos papilles.',
                'de' => 'Entdecken oder anbieten: Hier finden Sie eine Vielzahl handgefertigter Produkte, die Ihren Gaumen erfreuen werden.',
                'it' => 'Per scoprire o offrire, ecco una moltitudine di prodotti artigianali che delizieranno le vostre papille gustative.',
            ],
            'slug' => str_slug($name['en']),
            'order' => 8,
        ]);
    }
}
