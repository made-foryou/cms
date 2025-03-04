<?php

use Made\Cms\Models;
use Made\Cms\Website\Models\MenuItem;

// translations for Made/Cms
return [
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
        MenuItem::class => [
            'title' => 'Menu onderdelen',
            'description' => 'Beheren van de inhoud van de menu locaties.',
        ],
    ],

    'default_data' => [
        'menu_locations' => [
            'main' => [
                'name' => 'Hoofdmenu',
                'description' => 'Basis hoofdmenu welke bovenaan de pagina wordt gebruikt.',
            ],
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
        'analytics' => 'Analytics',
        'information' => "Gegevens",
    ],

    'common' => [
        'yes' => 'Ja',
        'no' => 'Nee',
        'all' => 'Allemaal',
        'other' => 'Overig',
        'overview' => 'Overzicht',
    ],

    'resources' => [
        'common' => [
            'overview' => 'Overzicht',
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

        'role' => [
            'label' => 'Rollen',
            'singular' => 'Rol',

            'table' => [
                'name' => [
                    'label' => 'Naam',
                ],
                'description' => [
                    'label' => 'Omschrijving',
                    'helperText' => 'Een korte omschrijving waaruit duidelijk wordt wat voor rol dit is.',
                ],
                'is_default' => [
                    'label' => 'Admin rol?',
                    'tooltip' => 'Een rol waarbij dit is aangevinkt krijgt automatisch toegang tot alle huidige en nieuwe permissies.',
                ],
                'users_count' => [
                    'label' => 'Gebruikers met deze rol',
                ],
            ],

            'form' => [
                'sections' => [
                    'main' => [
                        'heading' => 'Rol',
                        'description' => 'Algemene gegevens van de rol. ',
                    ],
                    'permissions' => [
                        'heading' => 'Rechten',
                        'description' => 'Hier selecteer je de rechten die de rol heeft.',
                    ],
                ],

                'fields' => [
                    'name' => [
                        'label' => 'Naam',
                    ],
                    'description' => [
                        'label' => 'Omschrijving',
                        'helperText' => 'Een korte omschrijving waaruit duidelijk wordt wat voor rol dit is.',
                    ],
                    'is_default' => [
                        'label' => 'Admin role?',
                        'helperText' => 'Een rol waarbij dit is aangevinkt krijgt automatisch toegang tot alle huidige en nieuwe permissies.',
                    ],
                ],
            ],
        ],

        'user' => [
            'label' => 'Gebruikers',
            'singular' => 'Gebruiker',

            'table' => [
                'heading' => 'Gebruikers',
                'description' => 'Een lijst van alle gebruikers in de applicatie.',

                'columns' => [
                    'cms_access' => [
                        'label' => 'Heef toegang tot het CMS?',
                    ],
                    'role_name' => [
                        'label' => 'Rol',
                    ],
                    'email_verified_at' => [
                        'label' => 'E-mailadres geverifieerd op',
                    ],
                ],
            ],

            'form' => [
                'sections' => [
                    'user' => [
                        'heading' => 'Gebruiker',
                        'description' => 'Algemene gegevens van de gebruiker.',
                    ],
                ],

                'fields' => [
                    'role' => [
                        'label' => 'Gebruikersrol',
                        'helperText' => 'De gebruiker krijgt zijn rechten aan de hand van deze rol.',
                    ],
                    'email_verified_at' => [
                        'label' => 'E-mailadres geverifieerd op',
                    ],
                    'password' => [
                        'label' => 'Wachtwoord',
                        'helperText' => 'Vul dit veld alleen in als je het wachtwoord wilt wijzigen.',
                    ],
                ],
            ],

            'infolist' => [
                'sections' => [
                    'user' => [
                        'heading' => 'Gebruiker',
                        'description' => 'Algemene gegevens van de gebruiker.',
                    ],
                    'management' => [
                        'heading' => 'Beheer',
                        'description' => 'Gegevens voor het beheer van de gebruiker.',
                    ],
                ],

                'entries' => [
                    'email_verified_at' => [
                        'label' => 'E-mailadres geverifieerd op',
                    ],
                    'role_name' => [
                        'label' => 'Rol',
                    ],
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
                'preview_builder' => [
                    'label' => 'Bekijk voorbeeld van inhoudsblokken',
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

                'fields' => [
                    'menu_locations' => [
                        'add_action_label' => 'Menu locatie toevoegen',
                        'fields' => [
                            'key' => [
                                'label' => 'ID',
                                'helperText' => 'Aan de hand van deze waarde kan de inhoud van het menu opgehaald worden.',
                            ],
                            'name' => [
                                'label' => 'Naam',
                                'helperText' => 'De naam van de locatie.',
                            ],
                            'description' => [
                                'label' => 'Omschrijving',
                                'helperText' => 'Een korte omschrijving van de menu locatie en waar deze gebruikt wordt.',
                            ],
                        ],
                    ],
                    'online' => [
                        'label' => 'Is de website bereikbaar?',
                        'helperText' => 'Als je de website (tijdelijk) uit wilt zetten kun je deze instelling uitzetten. Bezoekers kunnen de website dan niet meer bereiken.',
                    ],
                    'landing_page' => [
                        'label' => 'Selecteer een landingspagina',
                        'helperText' => 'Selecteer een pagina welke als landingspagina moet worden geladen. Dit is de eerste pagina die bezoekers te zien krijgen als ze naar je website komen.',
                    ],
                    'not_found_page' => [
                        'label' => 'Selecteer een niet gevonden pagina',
                        'helperText' => 'Selecteer een pagina welke wordt getoond zodra er niks kan worden gevonden om te tonen.',
                    ],
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
                    'menulocations' => [
                        'title' => 'Menu locaties',
                        'description' => 'Beheer hier de menu locaties welke worden gebruikt om navigatie menu\'s te vullen en op bepaalde plekken in de website te tonen.',
                    ],
                ],
            ],

            'analytics' => [
                'label' => 'Analytische instellingen',

                'sections' => [
                    'visits' => [
                        'heading' => 'Analytische instellingen voor bezoeken',
                        'description' => 'Instellingen voor het bijhouden van gebruikersbezoeken aan secties op de website.',
                    ],
                ],
                'fields' => [
                    'ip_blacklist' => [
                        'label' => 'Zwarte IP-lijst',
                        'helperText' => 'Een lijst met IP-adressen die niet gevolgd mogen worden. Eén IP-adres per regel.',
                        'placeholder' => 'Vul het ip-adres in',
                    ],
                    'saving_strategy' => [
                        'label' => 'Logboeken van bezoeken opslaan',
                        'helperText' => 'Hoe lang wil je de bezoeklogs bewaren? De logs worden na de geselecteerde periode verwijderd en geback-upt en per e-mail verzonden.',
                    ],
                ],
            ],

            'information' => [
                'label' => 'Bedrijfsgegevens',
                'title' => 'Algemene gegevens',
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
            'actions' => [
                'preview_builder' => [
                    'label' => 'Bekijk voorbeeld van inhoudsblokken',
                ],
            ],
        ],

        'menuitem' => [
            'label' => 'Menu',
            'singular' => 'Menu-item',

            'sections' => [
                'data' => [
                    'heading' => 'Presentatie',
                    'description' => 'Met behulp van deze gegevens kun je het menu-item vormgeven en ervoor zorgen dat het ergens naartoe linkt. <strong>Let op!</strong> Zodra je een Website onderdeel selecteerd worden standaard alle informatie van het Website onderdeel gebruikt tenzij je het overschrijft met de andere velden.',
                ],
                'placement' => [
                    'heading' => 'Plaatsing',
                    'description' => 'Met behulp van deze instellingen kun je het menu-item verplaatsen naar een ander menu en/of hem onder een ander menu-item plaatsen.',
                ],
                'extra' => [
                    'heading' => 'Extra gegevens',
                    'description' => 'Hier vind je de wat seo / code technische instellingen van de links.',
                ],
            ],

            'fields' => [
                'location' => [
                    'label' => 'Menu locatie',
                ],
                'linkable' => [
                    'label' => 'Website onderdeel',
                ],
                'parent_id' => [
                    'label' => 'Bovenliggende pagina',
                    'helperText' => 'Selecteer hier een menu-item waaronder dit menu-item moet vallen',
                ],
                'link' => [
                    'label' => 'Handmatige link',
                    'helperText' => '<strong>Let op!</strong> Hiermee overschrijf je gegevens van het geselecteerde website onderdeel. <br />Vul hier een url in wanneer je wilt linken naar een externe of aangepaste url.',
                ],
                'label' => [
                    'label' => 'Menu item naam',
                    'helperText' => '<strong>Let op!</strong> Hiermee overschrijf je gegevens van het geselecteerde website onderdeel. <br />Hiermee kun je of de naam van het menu-item overschrijven en/of het menu-item een naam geven als het een handmatige url is.',
                ],
                'title' => [
                    'label' => 'Titel',
                    'helperText' => '<strong>Let op!</strong> Hiermee overschrijf je gegevens van het geselecteerde website onderdeel. <br />Vul hier een titel in welke wordt gebruikt voor de `title` attribuut van de link.',
                ],
                'rel' => [
                    'label' => 'Selecteer de rel waardes van de link',
                ],
                'target' => [
                    'label' => 'Selecteer de target waarde van de link',
                ],
            ],

            'columns' => [
                'linkable' => [
                    'label' => 'Website onderdeel',
                    'placeholder' => 'Geen website onderdeel geselecteerd.',
                ],
                'label' => [
                    'label' => 'Aangepaste link',
                    'placeholder' => 'Geen aangepaste link ingevuld.',
                ],
                'parent' => [
                    'label' => 'Onderdeel van',
                    'placeholder' => 'Hoofd menu-item',
                ],
                'children' => [
                    'label' => 'Onderliggende menu-item|Onderliggende menu-items',
                ],
                'target' => [
                    'label' => 'Link target',
                ],
                'location' => [
                    'label' => 'Menu locatie',
                ],
            ],
        ],
    ],

    'enums' => [
        'visit_saving' => [
            'save_all' => [
                'label' => 'Bewaar alles',
            ],
            'save_half_year' => [
                'label' => 'Bewaar de bezoeken voor een half jaar.',
            ],
            'save_year' => [
                'label' => 'Bewaar de bezoeken voor een jaar.',
            ],
            'save_2_years' => [
                'label' => 'Bewaar de bezoeken voor twee jaar.',
            ],
            'save_3_years' => [
                'label' => 'Bewaar de bezoeken voor drie jaar.',
            ],
        ],

        'ahrefrel' => [
            'external' => [
                'label' => 'external - Externe link',
                'description' => 'Het document waarnaar wordt verwezen maakt geen deel uit van dezelfde site als het huidige document.',
            ],
            'nofollow' => [
                'label' => 'nofollow - Niet volgbare link',
                'description' => 'Geeft aan dat de oorspronkelijke auteur of uitgever van het huidige document het document waarnaar wordt verwezen niet onderschrijft.',
            ],
            'noopener' => [
                'label' => 'noopener - Geen opener link',
                'description' => 'Creëert een bladercontext op het hoogste niveau die geen hulpbladercontext is als de hyperlink om te beginnen een van die contexten zou creëren (d.w.z. een geschikte doelattribuutwaarde heeft).',
            ],
            'noreferrer' => [
                'label' => 'noreferrer - Geen referrer link',
                'description' => 'De website die wordt geladen in een nieuw tabblad zal geen toegang krijgen tot informatie van de originele website waar een bezoeker vandaan komt.',
            ],
            'opener' => [
                'label' => 'opener - Opener link',
                'description' => 'Creëert een extra bladercontext als de hyperlink anders een bladercontext op het hoogste niveau zou creëren die geen extra bladercontext is (d.w.z. “_blank” als doelattribuutwaarde heeft).',
            ],
            'privacy-policy' => [
                'label' => 'privacy-policy - Privacybeleid',
                'description' => 'Geeft een link naar informatie over het verzamelen en gebruiken van gegevens die van toepassing zijn op het huidige document.',
            ],
            'terms-of-service' => [
                'label' => 'terms-of-service - Gebruiksvoorwaarden',
                'description' => 'Link naar de overeenkomst of servicevoorwaarden tussen de aanbieder van het document en gebruikers die het document willen gebruiken.',
            ],
        ],

        'target' => [
            '_self' => [
                'label' => 'Huidig venster',
                'description' => 'De link wordt geopend in hetzelfde tabblad.',
            ],
            '_blank' => [
                'label' => 'Nieuw venster',
                'description' => 'De link wordt geopend in een nieuw tabblad.',
            ],
        ],
    ],
];
