<?php

// translations for Made/Cms
return [
    'role' => [
        'default' => [
            'name' => 'Administrator',
            'description' => 'Hoofdrol van het Made CMS. Dit is de standaard rol welke toegang krijgt tot alle permissies.',
        ],
    ],

    'permissions' => [
        'accessPanel' => [
            'name' => 'Toegang tot het cms paneel.',
            'description' => 'Met deze permissie krijg je toegang tot het cms paneel. Deze permissie heb je nodig om in te kunnen loggen in het paneel.',
        ],
    ],

    'groups' => [
        'user' => 'Gebruikersbeheer',
    ],

    'resources' => [
        'common' => [
            'name' => 'Naam',
            'email' => 'E-mailadres',
            'created_at' => 'Aangemaakt op',
            'updated_at' => 'Gewijzigd op',
            'deleted_at' => 'Verwijderd op',
        ],

        'user' => [
            'heading' => 'De gebruikers',
            'description' => 'Hier vind je de Made CMS gebruikers welke toegang kunnen hebben tot het CMS paneel.',
            'label' => 'Gebruikers',
            'singular' => 'Gebruiker',
            'fields' => [
                'role' => 'Rol',
                'email_verified_at' => 'E-mailadres geverifieerd op',
                'password' => 'Wachtwoord',
                'remember_token' => 'Onthoud mij token',
            ],
        ],
    ],
];
