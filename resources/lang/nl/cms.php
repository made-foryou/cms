<?php

// translations for Made/Cms
return [
    'groups' => [
        'user' => 'Gebruikersbeheer',
        'administration' => 'Administratie',
        'website_management' => 'Website beheer',
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
            'helpers' => [
                'password' => 'Pas dit veld alleen aan zodra je het wachtwoord van de gebruiker wilt wijzigen.',
            ],
            'sections' => [
                'user' => [
                    'label' => 'Gebruiker',
                    'description' => 'Gegevens van de gebruiker.',
                ],
                'management' => [
                    'label' => 'Beheer',
                    'description' => 'Gegevens voor het beheer van deze gebruiker.',
                ],
            ],
        ],

        'page' => [
            'label' => 'Pagina\'s',
            'singular' => 'Pagina',
        ],
    ],
];
