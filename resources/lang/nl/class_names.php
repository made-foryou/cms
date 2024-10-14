<?php

use Made\Cms\Models;

return [
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
];
