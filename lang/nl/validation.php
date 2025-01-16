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

    'accepted' => 'Dit moet worden geaccepteerd.',
    'accepted_if' => ':attribute moet worden geaccepteerd wanneer :other :value is.',
    'active_url' => ':attribute is geen geldige URL.',
    'after' => ':attribute moet een datum na :date zijn.',
    'after_or_equal' => ':attribute moet een datum na of gelijk aan :date zijn.',
    'alpha' => ':attribute mag alleen letters bevatten.',
    'alpha_dash' => ':attribute mag alleen letters, cijfers, streepjes en underscores bevatten.',
    'alpha_num' => ':attribute mag alleen letters en cijfers bevatten.',
    'array' => ':attribute moet een array zijn.',
    'before' => ':attribute moet een datum voor :date zijn.',
    'before_or_equal' => ':attribute moet een datum voor of gelijk aan :date zijn.',
    'between' => [
        'numeric' => ':attribute moet tussen :min en :max zijn.',
        'file' => ':attribute moet tussen :min en :max kilobytes zijn.',
        'string' => ':attribute moet tussen :min en :max tekens zijn.',
        'array' => ':attribute moet tussen :min en :max items bevatten.',
    ],
    'boolean' => ':attribute moet waar of onwaar zijn.',
    'confirmed' => ':attribute bevestiging komt niet overeen.',
    'current_password' => 'Het wachtwoord is onjuist.',
    'date' => ':attribute is geen geldige datum.',
    'date_equals' => ':attribute moet een datum gelijk aan :date zijn.',
    'date_format' => ':attribute komt niet overeen met het formaat :format.',
    'declined' => ':attribute moet worden afgewezen.',
    'declined_if' => ':attribute moet worden afgewezen wanneer :other :value is.',
    'different' => ':attribute en :other moeten verschillend zijn.',
    'digits' => ':attribute moet :digits cijfers zijn.',
    "digits_between" => "Dit moet tussen :min en :max cijfers liggen.",
    "dimensions" => "De afmetingen van de afbeelding :attribute zijn ongeldig.",
    "distinct" => "Dit veld heeft een duplicaat waarde.",
    "email" => "Dit moet een geldig e-mailadres zijn.",
    "ends_with" => "Dit moet eindigen met één van de volgende: :values.",
    "enum" => "De geselecteerde :attribute is ongeldig.",
    "exists" => "De geselecteerde :attribute is ongeldig.",
    "file" => "Dit moet een bestand zijn.",
    "filled" => "Dit veld moet een waarde hebben.",
    "gt" => [
        "numeric" => "Dit moet groter zijn dan :value.",
        "file" => "Dit moet groter zijn dan :value kilobytes.",
        "string" => "Dit moet groter zijn dan :value tekens.",
        "array" => "Dit moet meer dan :value items hebben.",
    ],
    "gte" => [
        "numeric" => "Dit moet groter zijn dan of gelijk aan :value.",
        "file" => "Dit moet groter zijn dan of gelijk aan :value kilobytes.",
        "string" => "Dit moet groter zijn dan of gelijk aan :value tekens.",
        "array" => "Dit moet :value items of meer hebben.",
    ],
    "image" => "Dit moet een afbeelding zijn.",
    "in" => "De geselecteerde :attribute is ongeldig.",
    "in_array" => "Dit veld bestaat niet in :other.",
    "integer" => "Dit moet een geheel getal zijn.",
    "ip" => "Dit moet een geldig IP-adres zijn.",
    "ipv4" => "Dit moet een geldig IPv4-adres zijn.",
    "ipv6" => "Dit moet een geldig IPv6-adres zijn.",
    "json" => "Dit moet een geldige JSON-string zijn.",
    "lt" => [
        "numeric" => "Dit moet minder zijn dan :value.",
        "file" => "Dit moet minder zijn dan :value kilobytes.",
        "string" => "Dit moet minder zijn dan :value tekens.",
        "array" => "Dit moet minder dan :value items hebben.",
    ],
    'lte' => [
        'numeric' => 'Dit moet kleiner zijn dan of gelijk aan :value.',
        'file' => 'Dit moet kleiner zijn dan of gelijk aan :value kilobytes.',
        'string' => 'Dit moet kleiner zijn dan of gelijk aan :value tekens.',
        'array' => 'Dit mag niet meer dan :value items hebben.',
    ],
     'mac_address' => 'Dit moet een geldig MAC-adres zijn.',
    'max' => [
        'numeric' => 'Dit mag niet groter zijn dan :max.',
        'file' => 'Dit mag niet groter zijn dan :max kilobytes.',
        'string' => 'Dit mag niet groter zijn dan :max tekens.',
        'array' => 'Dit mag niet meer dan :max items hebben.',
    ],
    'mimes' => 'Dit moet een bestand van het type zijn: :values.',
    'mimetypes' => 'Dit moet een bestand van het type zijn: :values.',
    'min' => [
        'numeric' => 'Dit moet minstens :min zijn.',
        'file' => 'Dit moet minstens :min kilobytes zijn.',
        'string' => 'Dit moet minstens :min tekens bevatten.',
        'array' => 'Dit moet minstens :min items hebben.',
    ],
    'multiple_of' => 'Dit moet een veelvoud zijn van :value.',
    'not_in' => 'De geselecteerde :attribute is ongeldig.',
    'not_regex' => 'Het formaat van Dit is ongeldig.',
    'numeric' => 'Dit moet een nummer zijn.',
    'password' => 'Het wachtwoord is onjuist.',
    'present' => 'Dit veld moet aanwezig zijn.',
    'prohibited' => 'Dit veld is verboden.',
    'prohibited_if' => 'Dit veld is verboden wanneer :other :value is.',
    'prohibited_unless' => 'Dit veld is verboden tenzij :other in :values is.',
    'prohibits' => 'Dit veld verbiedt :other om aanwezig te zijn.',
    'regex' => 'Het formaat van Dit is ongeldig.',
    'required' => 'Dit veld is verplicht.',
    'required_array_keys' => 'Dit veld moet ingangen bevatten voor: :values.',
    'required_if' => 'Dit veld is verplicht wanneer :other :value is.',
    'required_unless' => 'Dit veld is verplicht tenzij :other in :values zit.',
    'required_with' => 'Dit veld is verplicht wanneer :values aanwezig is.',
    'required_with_all' => 'Dit veld is verplicht wanneer alle :values aanwezig zijn.',
    'required_without' => 'Dit veld is verplicht wanneer :values niet aanwezig is.',
    'required_without_all' => 'Dit veld is verplicht wanneer geen van de :values aanwezig zijn.',
    'same' => ':attribute en :other moeten overeenkomen.',
    'size' => [
        'numeric' => ':attribute moet :size zijn.',
        'file' => ':attribute moet :size kilobytes zijn.',
        'string' => ':attribute moet :size karakters zijn.',
        'array' => ':attribute moet :size items bevatten.',
    ],
    'starts_with' => ':attribute moet beginnen met een van de volgende: :values.',
    'string' => ':attribute moet een string zijn.',
    'timezone' => ':attribute moet een geldige tijdzone zijn.',
    'unique' => ':attribute is al in gebruik en moet uniek zijn.',
    'uploaded' => 'Het uploaden van :attribute is mislukt.',
    'url' => ':attribute moet een geldige URL zijn.',
    'uuid' => ':attribute moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Custom Statamic Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may validation messages for the custom rules provided by Statamic.
    |
    */

    'unique_entry_value' => 'Deze waarde is al in gebruik.',
    'unique_user_value' => 'Deze waarde is al in gebruik.',
    'duplicate_field_handle' => 'Een veld met de aanduiding :handle kan niet meer dan één keer worden gebruikt.',
    'one_site_without_origin' => 'Er moet ten minste één site zijn zonder oorsprong.',
    'origin_cannot_be_disabled' => 'Een uitgeschakelde oorsprong kan niet worden geselecteerd.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
