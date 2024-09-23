<?php

return [
    'sections' => [
        'main' => [
            'heading' => 'Rol',
            'description' => 'Algemene gegevens van de rol.',
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
            'label' => 'Super gebruiker?',
            'helperText' => 'Een rol waarbij dit is aangevinkt krijgt automatisch toegang tot alle huidige en nieuwe permissies.',
        ],
        'created_at' => [
            'label' => __('made-cms::cms.resources.common.created_at'),
        ],
    ],
];
