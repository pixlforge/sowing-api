<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute doit être accepté.',
    'active_url' => ":attribute n'est pas une URL valide.",
    'after' => ':attribute doit être une date ultérieure à :date.',
    'after_or_equal' => ':attribute doit être une date ultérieure ou égale à :date.',
    'alpha' => ':attribute ne doit contenir que des lettres.',
    'alpha_dash' => ':attribute ne peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
    'alpha_num' => ':attribute ne peut contenir que des lettres et des chiffres.',
    'array' => ':attribute doit être un tableau.',
    'before' => ':attribute doit être une date antérieure à :date.',
    'before_or_equal' => ':attribute doit être une date antérieure ou égale à :date.',
    'between' => [
        'numeric' => ':attribute doit être un nombre entre :min et :max.',
        'file' => ':attribute doit avoir une valeur entre :min et :max kilo-octets.',
        'string' => ':attribute doit contenir entre :min et :max caractères.',
        'array' => ':attribute doit contenir entre :min et :max objets.',
    ],
    'boolean' => ':attribute doit être vrai ou faux.',
    'confirmed' => ':attribute ne concorde pas.',
    'date' => ':attribute n\'est pas une date valide.',
    'date_format' => ':attribute ne concorde pas avec le format :format.',
    'different' => ':attribute et :other doivent être différents.',
    'digits' => ':attribute doit contenir :digits numéros.',
    'digits_between' => ':attribute doit contenir entre :min et :max numéros.',
    'dimensions' => 'Les dimensions de :attribute sont invalides.',
    'distinct' => ':attribute a une valeur à double.',
    'email' => ':attribute doit être une adresse e-mail valide.',
    'exists' => ':attribute est invalide.',
    'file' => ':attribute doit être un fichier.',
    'filled' => ':attribute doit être rempli.',
    'gt' => [
        'numeric' => ':attribute doit être plus grand que :value.',
        'file' => 'Le poids du fichier :attribute doit être supérieur à :value kilo-octets.',
        'string' => ':attribute doit être plus long que :value caractères.',
        'array' => ':attribute doit posséder plus que :value objets.',
    ],
    'gte' => [
        'numeric' => ':attribute doit être plus grand ou égal à :value.',
        'file' => 'Le poids du fichier :attribute doit être supérieur ou égal à :value kilo-octets.',
        'string' => ':attribute doit contenir un nombre de caractères égal ou supérieur à :value.',
        'array' => ':attribute doit contenir un nombre d\'objets égal ou supérieur à :value',
    ],
    'image' => ':attribute doit être une image.',
    'in' => ':attribute est invalide.',
    'in_array' => ':attribute ne doit pas exister dans :other.',
    'integer' => ':attribute doit être un nombre entier.',
    'ip' => ':attribute doit être une adresse IP valide.',
    'ipv4' => ':attribute doit être une adresse IPv4 valide.',
    'ipv6' => ':attribute doit être une adresse IPv6 valide.',
    'json' => ':attribute doit être une chaîne de caractères valide au format JSON.',
    'lt' => [
        'numeric' => ':attribute doit être inférieur à :value.',
        'file' => 'Le poids du fichier :attribute doit être d\'au moins :value kilo-octets.',
        'string' => ':attribute doit contenir un nombre de caractères inférieur à :value.',
        'array' => ':attribute doit contenir un nombre d\'objets inférieur à :value.',
    ],
    'lte' => [
        'numeric' => ':attribute doit être inférieur ou égal à :value.',
        'file' => 'Le poids du fichier :attribute doit être égal ou inférieur à :value kilo-octets.',
        'string' => ':attribute doit contenir un nombre de caractères inférieur ou égal à :value.',
        'array' => ':attribute doit posséder un nombre d\'objets inférieur ou égal à :value.',
    ],
    'max' => [
        'numeric' => ':attribute ne peut pas être supérieur à :max.',
        'file' => 'Le poids du fichier :attribute ne peut pas être plus grand que :max kilo-octets.',
        'string' => ':attribute ne peut pas contenir plus de :max caractères.',
        'array' => ':attribute ne peut pas contenir plus de :max objets.',
    ],
    'mimes' => ':attribute doit être un fichier de type: :values.',
    'mimetypes' => ':attribute doit être un fichier de type: :values.',
    'min' => [
        'numeric' => ':attribute doit être d\'au moins :min.',
        'file' => 'Le poids du fichier :attribute doit être d\'au moins :min kilo-octets.',
        'string' => ':attribute doit contenir au moins :min caractères.',
        'array' => ':attribute doit contenir au moins :min objets.',
    ],
    'not_in' => ':attribute est invalide.',
    'not_regex' => 'Le format de :attribute est invalide.',
    'numeric' => ':attribute doit être un nombre.',
    'present' => ':attribute doit être présent.',
    'regex' => 'Le format de :attribute est invalide.',
    'required' => ':attribute est requis.',
    'required_if' => ':attribute est requis si :other est :value.',
    'required_unless' => ':attribute est requis à moins que :other ne soit :values.',
    'required_with' => ':attribute est requis quand :values est présent.',
    'required_with_all' => ':attribute est requis lorsque :values sont présents.',
    'required_without' => ':attribute est requis lorsque :values est absent.',
    'required_without_all' => ':attribute est requis lorsque :values sont absents.',
    'same' => ':attribute et :other doivent correspondre.',
    'size' => [
        'numeric' => 'Le taille de :attribute doit être de :size.',
        'file' => 'Le poids du fichier doit être de :size kilo-octets.',
        'string' => ':attribute doit contenir :size caractères.',
        'array' => ':attribute doit contenir :size objets.',
    ],
    'string' => ':attribute doit être une chaîne de caractères.',
    'timezone' => ':attribute doit être une fuseau horaire valide.',
    'unique' => ':attribute existe déjà.',
    'uploaded' => 'Le téléchargement de :attribute a échoué.',
    'url' => 'Le format de :attribute est invalide.',
    
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

    'attributes' => [],
];
