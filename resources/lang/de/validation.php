<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => ':attribute muss akzeptiert werden.',
    'active_url' => ':attribute ist keine gültige Internet-Adresse.',
    'after' => ':attribute muss ein Datum nach dem :date sein.',
    'after_or_equal' => ':attribute muss ein Datum nach dem :date oder gleich dem :date sein.',
    'alpha' => ':attribute darf nur aus Buchstaben bestehen.',
    'alpha_dash' => ':attribute darf nur aus Buchstaben, Zahlen, Binde- und Unterstrichen bestehen.',
    'alpha_num' => ':attribute darf nur aus Buchstaben und Zahlen bestehen.',
    'array' => ':attribute muss ein Array sein.',
    'before' => ':attribute muss ein Datum vor dem :date sein.',
    'before_or_equal' => ':attribute muss ein Datum vor dem :date oder gleich dem :date sein.',
    'between' => [
        'numeric' => ':attribute muss zwischen :min & :max liegen.',
        'file' => ':attribute muss zwischen :min & :max Kilobytes groß sein.',
        'string' => ':attribute muss zwischen :min & :max Zeichen lang sein.',
        'array' => ':attribute muss zwischen :min & :max Elemente haben.',
    ],
    'boolean' => ":attribute muss entweder 'true' oder 'false' sein.",
    'confirmed' => ':attribute stimmt nicht mit der Bestätigung überein.',
    'date' => ':attribute muss ein gültiges Datum sein.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => ':attribute entspricht nicht dem gültigen Format für :format.',
    'different' => ':attribute und :other müssen sich unterscheiden.',
    'digits' => ':attribute muss :digits Stellen haben.',
    'digits_between' => ':attribute muss zwischen :min und :max Stellen haben.',
    'dimensions' => ':attribute hat ungültige Bildabmessungen.',
    'distinct' => ':attribute beinhaltet einen bereits vorhandenen Wert.',
    'email' => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'exists' => 'Der gewählte Wert für :attribute ist ungültig.',
    'file' => ':attribute muss eine Datei sein.',
    'filled' => ':attribute muss ausgefüllt sein.',
    'gt' => [
        'numeric' => ':attribute muss mindestens :value sein.',
        'file' => ':attribute muss mindestens :value Kilobytes groß sein.',
        'string' => ':attribute muss mindestens :value Zeichen lang sein.',
        'array' => ':attribute muss mindestens :value Elemente haben.',
    ],
    'gte' => [
        'numeric' => ':attribute muss größer oder gleich :value sein.',
        'file' => ':attribute muss größer oder gleich :value Kilobytes sein.',
        'string' => ':attribute muss größer oder gleich :value Zeichen lang sein.',
        'array' => ':attribute muss größer oder gleich :value Elemente haben.',
    ],
    'image' => ':attribute muss ein Bild sein.',
    'in' => 'Der gewählte Wert für :attribute ist ungültig.',
    'in_array' => 'Der gewählte Wert für :attribute kommt nicht in :other vor.',
    'integer' => ':attribute muss eine ganze Zahl sein.',
    'ip' => ':attribute muss eine gültige IP-Adresse sein.',
    'ipv4' => ':attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => ':attribute muss eine gültige IPv6-Adresse sein.',
    'json' => ':attribute muss ein gültiger JSON-String sein.',
    'lt' => [
        'numeric' => ':attribute muss kleiner :value sein.',
        'file' => ':attribute muss kleiner :value Kilobytes groß sein.',
        'string' => ':attribute muss kleiner :value Zeichen lang sein.',
        'array' => ':attribute muss kleiner :value Elemente haben.',
    ],
    'lte' => [
        'numeric' => ':attribute muss kleiner oder gleich :value sein.',
        'file' => ':attribute muss kleiner oder gleich :value Kilobytes sein.',
        'string' => ':attribute muss kleiner oder gleich :value Zeichen lang sein.',
        'array' => ':attribute muss kleiner oder gleich :value Elemente haben.',
    ],
    'max' => [
        'numeric' => ':attribute darf maximal :max sein.',
        'file' => ':attribute darf maximal :max Kilobytes groß sein.',
        'string' => ':attribute darf maximal :max Zeichen haben.',
        'array' => ':attribute darf nicht mehr als :max Elemente haben.',
    ],
    'mimes' => ':attribute muss den Dateityp :values haben.',
    'mimetypes' => ':attribute muss den Dateityp :values haben.',
    'min' => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file' => ':attribute muss mindestens :min Kilobytes groß sein.',
        'string' => ':attribute muss mindestens :min Zeichen lang sein.',
        'array' => ':attribute muss mindestens :min Elemente haben.',
    ],
    'not_in' => 'Der gewählte Wert für :attribute ist ungültig.',
    'not_regex' => ':attribute hat ein ungültiges Format.',
    'numeric' => ':attribute muss eine Zahl sein.',
    'present' => ':attribute muss vorhanden sein.',
    'regex' => ':attribute Format ist ungültig.',
    'required' => ':attribute muss ausgefüllt sein.',
    'required_if' => ':attribute muss ausgefüllt sein, wenn :other :value ist.',
    'required_unless' => ':attribute muss ausgefüllt sein, wenn :other nicht :values ist.',
    'required_with' => ':attribute muss angegeben werden, wenn :values ausgefüllt wurde.',
    'required_with_all' => ':attribute muss angegeben werden, wenn :values ausgefüllt wurde.',
    'required_without' => ':attribute muss angegeben werden, wenn :values nicht ausgefüllt wurde.',
    'required_without_all' => ':attribute muss angegeben werden, wenn keines der Felder :values ausgefüllt wurde.',
    'same' => ':attribute und :other müssen übereinstimmen.',
    'size' => [
        'numeric' => ':attribute muss gleich :size sein.',
        'file' => ':attribute muss :size Kilobyte groß sein.',
        'string' => ':attribute muss :size Zeichen lang sein.',
        'array' => ':attribute muss genau :size Elemente haben.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => ':attribute muss ein String sein.',
    'timezone' => ':attribute muss eine gültige Zeitzone sein.',
    'unique' => ':attribute ist schon vergeben.',
    'uploaded' => ':attribute konnte nicht hochgeladen werden.',
    'url' => ':attribute muss eine URL sein.',
    'uuid' => ':attribute muss ein UUID sein.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'Name',
        'username' => 'Benutzername',
        'email' => 'E-Mail-Adresse',
        'first_name' => 'Vorname',
        'last_name' => 'Nachname',
        'password' => 'Passwort',
        'password_confirmation' => 'Passwort-Bestätigung',
        'city' => 'Stadt',
        'country' => 'Land',
        'address' => 'Adresse',
        'phone' => 'Telefonnummer',
        'mobile' => 'Handynummer',
        'age' => 'Alter',
        'sex' => 'Geschlecht',
        'gender' => 'Geschlecht',
        'day' => 'Tag',
        'month' => 'Monat',
        'year' => 'Jahr',
        'hour' => 'Stunde',
        'minute' => 'Minute',
        'second' => 'Sekunde',
        'title' => 'Titel',
        'content' => 'Inhalt',
        'description' => 'Beschreibung',
        'excerpt' => 'Auszug',
        'date' => 'Datum',
        'time' => 'Uhrzeit',
        'available' => 'verfügbar',
        'size' => 'Größe',

        'company_name' => 'Firma',
        'address_line_1' => 'Anschrift Zeile 1',
        'address_line_2' => 'Anschrift Zeile 2',
        'postal_code' => 'Postleitzahl',
        'country_id' => 'Land',

        'description_short' => 'Kurze Beschreibung',
        'description_long' => 'Lange Beschreibung',
        'theme' => 'Thema',

        'payment_method_id' => 'Zahlungsmethode',

        'name.fr' => 'Name (französisch)',
        'name.en' => 'Name (englisch)',
        'name.de' => 'Name (deutsch)',
        'name.it' => 'Name (italienisch)',

        'description.fr' => 'Beschreibung (französisch)',
        'description.en' => 'Beschreibung (englisch)',
        'description.de' => 'Beschreibung (deutsch)',
        'description.it' => 'Beschreibung (italienisch)',

        'category_id' => 'Kategorie',
    ],

    'rules' => [
        'invalid_shipping_method_id' => 'Die Versandart ist ungültig.',
        'cart_quantities_changed' => 'Ein oder mehrere Artikel in Ihrem Warenkorb wurden aktualisiert. Bitte überprüfen Sie sie vor der Bestellung.',
        'cart_is_empty' => 'Ihr Warenkorb ist leer.'
    ]
];
