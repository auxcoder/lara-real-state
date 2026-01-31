<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Company Information
    |--------------------------------------------------------------------------
    |
    | Company details for meta tags, titles, and contact information
    |
    */

    'name' => env('COMPANY_NAME', 'Inmobiliaria España'),
    'tagline' => env('COMPANY_TAGLINE', 'Expertos en Propiedades'),
    'country' => env('COMPANY_COUNTRY', 'España'),
    
    'address' => [
        'street' => env('COMPANY_ADDRESS_STREET', 'Calle Gran Vía, 123'),
        'city' => env('COMPANY_ADDRESS_CITY', 'Madrid'),
        'postal_code' => env('COMPANY_ADDRESS_POSTAL', '28013'),
        'country' => env('COMPANY_ADDRESS_COUNTRY', 'España'),
    ],
    
    'contact' => [
        'phone' => env('COMPANY_PHONE', '+34 91 123 4567'),
        'email' => env('COMPANY_EMAIL', 'info@inmobiliaria.es'),
    ],
];
