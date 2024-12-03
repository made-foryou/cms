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
            'default' => 'Standaard',
            'not_default' => 'Niet standaard',
            'enabled' => 'Geactiveerd',
            'not_enabled' => 'Niet geactiveerd',
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

        'language' => [
            'label' => 'Talen',
            'singular' => 'Taal',

            'fields' => [
                'country' => [
                    'label' => 'Land',
                ],

                'locale' => [
                    'label' => 'Taalcode',
                    'description' => 'De taalcode van de taal wordt gebruikt om de vertalingen te selecteren.',
                ],

                'abbreviation' => [
                    'label' => 'Afkorting',
                    'description' => 'Deze afkorting wordt toegevoegd aan de url die deze taal selecteert.',
                ],

                'is_default' => [
                    'label' => 'Standaard taal',
                    'description' => 'Is deze taal de standaardtaal die wordt geladen vanaf de website als er geen is geselecteerd?',
                ],

                'is_enabled' => [
                    'label' => 'Taal ingeschakeld?',
                    'description' => 'Kan deze taal op de website worden gebruikt?',
                ],

                'image' => [
                    'label' => 'Afbeelding',
                    'description' => 'Deze afbeelding kan in elke taalswitch worden gebruikt om de taal weer te geven.',
                ],
            ],

            'actions' => [
                'default' => [
                    'label' => 'Als standaard gebruiken',
                    'heading' => ':name standaard maken?',
                    'description' => 'Weet je zeker dat je :name als standaard wilt gebruiken?',
                    'successTitle' => ':name wordt nu als standaard gebruikt.',
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
                        'title' => 'Website',
                        'description' => 'Website-instellingen die de werking en initiële functionaliteit instellen.',
                    ],
                    'languages' => [
                        'title' => 'Talen',
                        'description' => 'De talen waarin de website inhoud zal verzorgen. De talen hier kunnen nog geactiveerd en/of gedeactiveerd worden zodat deze eerst nog ingevuld kunnen worden voordat ze actief worden gemaakt.',
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
