<?php

return [
    'status' => [
        'draft' => 'Concept',
        'published' => 'Gepubliceerd',
    ],

    'tabs' => [
        'page' => 'Pagina',
        'content' => 'Inhoud',
    ],

    'sections' => [
        'status' => 'Status',
    ],

    'fields' => [
        'name' => [
            'label' => 'Naam',
            'description' => 'De naam van de pagina die wordt gebruikt in het menu en de standaard url.',
        ],
        'slug' => [
            'label' => 'Slug',
            'description' => 'Naam van de pagina die gebruikt wordt in de url. Deze waarde moet voldoen aan de url-standaarden en dit zijn kleine letters en geen spaties of speciale tekens.',
        ],
        'status' => [
            'label' => 'Status',
            'description' => 'Deze status van de pagina geeft aan waarvoor de pagina gebruikt kan worden. Zodra de status is ingesteld op gepubliceerd, kan elke bezoeker de pagina bekijken.',
        ],
        'content' => [
            'label' => 'Inhoudsstroken',
            'description' => 'Pagina-inhoud wordt opgebouwd uit stroken. Elke strook heeft zijn eigen instellingen en inhoud. Deze kunnen hier worden toegevoegd, versleept en/of verwijderd.',
            'add_button' => 'Nieuwe inhoudsstrook toevoegen',
        ],
    ],
];
