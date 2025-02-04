<?php

use Made\Cms\Models;

// translations for Made/Cms
return [
    'groups' => [
        'user' => 'Gebruikersbeheer',
        'administration' => 'Administratie',
        'website_management' => 'Website beheer',
    ],

    'class_names' => [
        Models\User::class => [
            'title' => 'Gebruikers',
            'description' => 'Beheren van de CMS gebruikers.',
        ],
        Models\Role::class => [
            'title' => 'Rollen',
            'description' => 'Beheren van de rollen binnen het CMS.',
        ],
        Models\Permission::class => [
            'title' => 'Permissies',
            'description' => 'Beheren van permissies die binnen het CMS gelden.',
        ],
        \Made\Cms\Page\Models\Page::class => [
            'title' => 'Pagina\'s',
            'description' => 'Beheren van de paginas binnen de website.',
        ],
        \Made\Cms\Shared\Models\Meta::class => [
            'title' => 'Meta',
            'description' => 'Beheren van de meta gegevens van de onderdelen in de website.',
        ],
        \Made\Cms\Language\Models\Language::class => [
            'title' => 'Talen',
            'description' => 'Beheren van de talen van de website.',
        ],
        \Made\Cms\News\Models\Post::class => [
            'title' => 'Nieuwsberichten',
            'description' => 'Beheren van het nieuws in de website.',
        ],
    ],

    'permissions' => [
        'fields' => [
            'subject' => [
                'label' => 'Onderwerp',
            ],
        ],

        'user' => [
            'view_any' => [
                'name' => 'Overzicht van de gebruikers zien',
                'description' => 'Hiermee kan de gebruiker het overzicht van alle gebruikers bekijken.',
            ],
            'view' => [
                'name' => 'Een gebruiker bekijken',
                'description' => 'Hiermee kan de gebruiker de detail gegevens van een gebruiker bekijken.',
            ],
            'create' => [
                'name' => 'Een gebruiker aanmaken',
                'description' => 'Hiermee kan de gebruiker een nieuwe gebruiker toevoegen.',
            ],
            'update' => [
                'name' => 'Een gebruiker wijzigen',
                'description' => 'Hiermee kan de gebruiker een bestaande gebruiker wijzigen.',
            ],
            'delete' => [
                'name' => 'Een gebruiker verwijderen',
                'description' => 'Hiermee kan de gebruiker een bestaande gebruiker verwijderen.',
            ],
            'restore' => [
                'name' => 'Een gebruiker herstellen',
                'description' => 'Hiermee kan de gebruiker een verwijderde gebruiker herstellen.',
            ],
            'force_delete' => [
                'name' => 'Een gebruiker geforceerd verwijderen',
                'description' => 'Hiermee kan de gebruiker een gebruiker geforceerd verwijderen.',
            ],
            'access_panel' => [
                'name' => 'Toegang tot het cms paneel',
                'description' => 'Hiermee kan de gebruiker inloggen in het Made CMS.',
            ],
        ],

        'role' => [
            'view_any' => [
                'name' => 'Overzicht van alle rollen zien',
                'description' => 'Hiermee kan de gebruiker het overzicht van alle rollen bekijken.',
            ],
            'view' => [
                'name' => 'Een rol bekijken',
                'description' => 'Hiermee kan de gebruiker de detail gegevens van een rol en zijn permissies bekijken.',
            ],
            'create' => [
                'name' => 'Een rol aanmaken',
                'description' => 'Hiermee kan de gebruiker een nieuwe rol toevoegen.',
            ],
            'update' => [
                'name' => 'Een rol wijzigen',
                'description' => 'Hiermee kan de gebruiker een bestaande rol wijzigen.',
            ],
            'delete' => [
                'name' => 'Een rol verwijderen',
                'description' => 'Hiermee kan de gebruiker een bestaande rol verwijderen.',
            ],
            'restore' => [
                'name' => 'Een rol herstellen',
                'description' => 'Hiermee kan de gebruiker een verwijderde rol herstellen.',
            ],
            'force_delete' => [
                'name' => 'Een rol geforceerd verwijderen',
                'description' => 'Hiermee kan de gebruiker een rol geforceerd verwijderen.',
            ],
        ],

        'permission' => [
            'view_any' => [
                'name' => 'Overzicht van alle permissies zien',
                'description' => 'Hiermee kan de gebruiker een overzicht zien van alle permissies.',
            ],
            'view' => [
                'name' => 'Permissie bekijken',
                'description' => 'Hiermee kan de gebruiker de detail gegevens van een permissie zien.',
            ],
            'create' => [
                'name' => 'Permissie aanmaken',
                'description' => 'Hiermee kan de gebruiker een nieuwe permissie toevoegen.',
            ],
            'update' => [
                'name' => 'Permissie wijzigen',
                'description' => 'Hiermee kan de gebruiker een bestaande permissie wijzigen.',
            ],
            'delete' => [
                'name' => 'Permissie verwijderen',
                'description' => 'Hiermee kan de gebruiker een bestaande permissie verwijderen.',
            ],
            'restore' => [
                'name' => 'Permissie herstellen',
                'description' => 'Hiermee kan de gebruiker een verwijderde permissie herstellen.',
            ],
            'force_delete' => [
                'name' => 'Geforceerd een permissie verwijderen',
                'description' => 'Hiermee kan de gebruiker een permissie geforceerd verwijderen.',
            ],
        ],

        'page' => [
            'view_any' => [
                'name' => 'Overzicht van alle pagina\'s zien',
                'description' => 'Hiermee kan de gebruiker een overzicht zien van alle pagina\'s.',
            ],
            'view' => [
                'name' => 'Pagina bekijken',
                'description' => 'Hiermee kan de gebruiker de detail gegevens van een pagina zien.',
            ],
            'create' => [
                'name' => 'Pagina aanmaken',
                'description' => 'Hiermee kan de gebruiker een nieuwe pagina toevoegen.',
            ],
            'update' => [
                'name' => 'Pagina wijzigen',
                'description' => 'Hiermee kan de gebruiker een bestaande pagina wijzigen.',
            ],
            'delete' => [
                'name' => 'Pagina verwijderen',
                'description' => 'Hiermee kan de gebruiker een bestaande pagina verwijderen.',
            ],
            'restore' => [
                'name' => 'Pagina herstellen',
                'description' => 'Hiermee kan de gebruiker een verwijderde pagina herstellen.',
            ],
            'force_delete' => [
                'name' => 'Geforceerd een pagina verwijderen',
                'description' => 'Hiermee kan de gebruiker een pagina geforceerd verwijderen.',
            ],
        ],

        'meta' => [
            'view_any' => [
                'name' => 'Alle meta informatie bekijken',
                'description' => 'Hiermee kan de gebruiker alle meta informatie zien van de onderdelen in het cms.',
            ],
            'view' => [
                'name' => 'Meta informatie bekijken',
                'description' => 'Hiermee kan de gebruiker de detail gegevens de meta informatie van een onderdeel zien.',
            ],
            'create' => [
                'name' => 'Meta gegevens aanmaken',
                'description' => 'Hiermee kan de gebruiker nieuwe meta gegevens toevoegen.',
            ],
            'update' => [
                'name' => 'Meta gegevens wijzigen',
                'description' => 'Hiermee kan de gebruiker bestaande meta gegevens wijzigen.',
            ],
            'delete' => [
                'name' => 'Meta gegevens verwijderen',
                'description' => 'Hiermee kan de gebruiker meta gegevens verwijderen.',
            ],
            'restore' => [
                'name' => 'Meta gegevens herstellen',
                'description' => 'Hiermee kan de gebruiker verwijderde meta gegevens herstellen.',
            ],
            'force_delete' => [
                'name' => 'Geforceerd meta gegevens verwijderen',
                'description' => 'Hiermee kan de gebruiker meta gegevens geforceerd verwijderen.',
            ],
        ],

        'language' => [
            'view_any' => [
                'name' => 'Overzicht bekijken van talen',
                'description' => 'Hiermee kan de gebruiker alle talen in de website zien.',
            ],
            'view' => [
                'name' => 'Taal bekijken',
                'description' => 'Hiermee kan de gebruiker de detail gegevens van een taal zien.',
            ],
            'create' => [
                'name' => 'Taal toevoegen',
                'description' => 'Hiermee kan de gebruiker een nieuwe taal toevoegen.',
            ],
            'update' => [
                'name' => 'Taal wijzigen',
                'description' => 'Hiermee kan de gebruiker een bestaande taal wijzigen.',
            ],
            'delete' => [
                'name' => 'Taal verwijderen',
                'description' => 'Hiermee kan de gebruiker een betaande taal verwijderen.',
            ],
            'restore' => [
                'name' => 'Taal herstellen',
                'description' => 'Hiermee kan een gebruiker een verwijderde taal herstellen en terugzetten.',
            ],
            'force_delete' => [
                'name' => 'Geforceerd een taal verwijderen',
                'description' => 'Hiermee kan een gebruiker een taal geforceerd verwijderen.',
            ],
        ],
    ],

    'navigation_groups' => [
        'pages' => 'Pagina\'s',
        'news' => 'Nieuws',
        'website' => 'Website',
        'security' => 'Beveiliging',
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
                'status' => [
                    'label' => 'Status',
                    'description' => 'Deze status van de pagina geeft aan waarvoor de pagina gebruikt kan worden. Zodra de status is ingesteld op gepubliceerd, kan elke bezoeker de pagina bekijken.',
                ],
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
                'created_by' => 'Aangemaakt door',
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

            'actions' => [
                'translate' => [
                    'label' => 'Maak een vertaling',
                    'heading' => 'Pagina vertaling aanmaken',
                    'description' => 'Er wordt een kopie van de pagina klaar gezet voor de geselecteerde taal. Hierin kun je vervolgens de inhoud verder gaan vertalen.',
                    'fields' => [
                        'language' => [
                            'label' => 'Taal',
                            'helperText' => 'Voor welke taal wil je een vertaling klaarzetten?',
                        ],
                    ],
                    'failure' => [
                        'title' => 'Er bestaat al een vertaling van pagina :name voor de geselecteerde taal.',
                    ],
                    'success' => [
                        'title' => 'De vertaling is aangemaakt van pagina :name en staat klaar om verder vertaald te worden.',
                    ],
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
        'post' => [
            'label' => 'Nieuwsberichten',
            'singular' => 'Nieuwsbericht',
            'tabs' => [
                'post' => 'Nieuwsbericht',
                'content' => 'Inhoud',
                'meta' => 'Meta gegevens',
            ],
            'fields' => [
                'name' => [
                    'label' => 'Titel',
                    'helperText' => 'De titel van het nieuwsbericht die zal worden gebruikt om het nieuwsbericht te presenteren en kan worden gebruikt voor de url.',
                ],
                'slug' => [
                    'label' => 'Slug',
                    'helperText' => 'Titel van het nieuwsbericht die kan worden gebruikt in de url. Deze waarde moet voldoen aan de url-standaarden en dit zijn kleine letters en geen spaties of speciale tekens.',
                ],
                'status' => [
                    'label' => 'Status',
                    'helperText' => 'Deze status van het nieuwsbericht geeft aan waarvoor het nieuwsbericht gebruikt kan worden. Zodra de status is ingesteld op gepubliceerd, kan elke bezoeker het nieuwsbericht bekijken.',
                ],
                'locale' => [
                    'label' => 'Taal',
                    'helperText' => 'De taal van de inhoud van het nieuwsbericht.',
                ],
                'translated_from' => [
                    'label' => 'Vertaling van',
                    'helperText' => 'Dit nieuwsbericht is een vertaling van het hierboven geselecteerde nieuwsbericht. Dit is niet te wijzigen.',
                ],
                'content' => [
                    'label' => 'Inhoudsstroken',
                    'helperText' => 'Nieuwsbericht-inhoud wordt opgebouwd uit stroken. Elke strook heeft zijn eigen instellingen en inhoud. Deze kunnen hier worden toegevoegd, versleept en/of verwijderd.',
                    'add_button' => 'Nieuwe inhoudsstrook toevoegen',
                ],
                'meta' => [
                    'title' => [
                        'label' => 'Nieuwsbericht titel',
                        'helperText' => 'Titel van het nieuwsbericht welke wordt weergegeven in de browser tab en in de zoek resultaten.',
                    ],
                    'description' => [
                        'label' => 'Omschrijving',
                        'helperText' => 'Een korte omschrijving van de inhoud van het nieuwsbericht. Deze omschrijving wordt gebruikt in de zoek resultaten.',
                    ],
                    'robot' => [
                        'label' => 'Robot instelling',
                        'helperText' => 'Met de meta-tag voor robots kun je een gedetailleerde, paginaspecifieke aanpak gebruiken om te bepalen hoe een individuele HTML-pagina moet worden geïndexeerd en aan gebruikers moet worden weergegeven in de zoekresultaten van Google.',
                    ],
                    'canonicals' => [
                        'label' => 'Canonical links',
                        'helperText' => 'Standaard wordt de canonieke link automatisch gegenereerd op basis van de huidige URL. Als je iets extra\'s wilt toevoegen, kun je hier meerdere canonieke links toevoegen.',
                    ],
                ],
            ],
        ],
    ],
];
