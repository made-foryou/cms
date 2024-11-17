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
            'label' => 'Gebruikers',
            'singular' => 'Gebruiker',
            'fields' => [
                'role' => 'Rol',
                'email_verified_at' => 'E-mailadres geverifieerd op',
                'password' => 'Wachtwoord',
                'remember_token' => 'Herinneringstoken',
            ],
            'helpers' => [
                'password' => 'Vul dit veld alleen in als je het wachtwoord wilt wijzigen.',
            ],
            'sections' => [
                'user' => [
                    'label' => 'Gebruiker',
                    'description' => 'Gebruikersgegevens.',
                ],
                'management' => [
                    'label' => 'Beheer',
                    'description' => 'Gegevens voor het beheer van de gebruiker.',
                ],
            ],
        ],

        'page' => [
            'label' => 'Pagina\'s',
            'singular' => 'Pagina',

            'fields' => [
                'locale' => [
                    'label' => 'Taal',
                    'description' => 'De taal van de inhoud van de pagina.',
                ],
            ],

            'table' => [
                'name' => 'Naam',
                'locale' => 'Taal',
                'status' => 'Status',
                'slug' => 'Slug',
                'author' => 'Auteur',
                'updated_at' => 'Gewijzigd op',
            ],

            'tabs' => [
                'meta' => 'Meta',
            ],

            'filters' => [
                'locale' => [
                    'label' => 'Taal',
                ],
            ],
        ],

        'settings' => [
            'website' => [
                'title' => 'Website instellingen',
                'label' => 'Website instellingen',
                'online' => [
                    'label' => 'Website bereikbaar?',
                    'description' => 'De website is alleen bereikbaar zodra deze instelling is aangezet.',
                ],
                'sections' => [
                    'general' => [
                        'title' => 'Algemene website instellingen',
                    ],
                ],
            ],
        ],

        'meta' => [
            'title' => [
                'label' => 'Pagina titel',
                'description' => 'De pagina titel welke wordt weergegeven in de browser tab en in de zoek resultaten.',
            ],
            'description' => [
                'label' => 'Omschrijving',
                'description' => 'Een korte omschrijving van de inhoud van de pagina. Deze omschrijving wordt gebruikt in de zoek resultaten.',
            ],
            'robot' => [
                'label' => 'Robot instelling',
                'description' => 'Met de meta-tag voor robots kun je een gedetailleerde, paginaspecifieke aanpak gebruiken om te bepalen hoe een individuele HTML-pagina moet worden geïndexeerd en aan gebruikers moet worden weergegeven in de zoekresultaten van Google.',
            ],
            'canonicals' => [
                'label' => 'Canonical links',
                'description' => 'Standaard wordt de canonieke link automatisch gegenereerd op basis van de huidige URL. Als je iets extra\'s wilt toevoegen, kun je hier meerdere canonieke links toevoegen.',
            ],
            'sections' => [
                'page_meta' => [
                    'title' => 'Meta gegevens van de pagina',
                    'description' => 'Informatie over de pagina die wordt gebruikt voor indexering door zoekmachines.',
                ],
                'meta' => [
                    'title' => 'Zoekmachine instellingen',
                    'description' => 'Instellingen die worden gebruikt om te bepalen hoe deze pagina wordt geïndexeerd en geserveerd aan zoekmachines.',
                ],
            ],
        ],
    ],
];
