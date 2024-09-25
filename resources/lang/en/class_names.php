<?php

use Made\Cms\Models;

return [
    Models\User::class => [
        'title' => 'Users',
        'description' => 'Managing the CMS users',
    ],
    Models\Role::class => [
        'title' => 'Roles',
        'description' => 'Managing the roles within the CMS.',
    ],
    Models\Permission::class => [
        'title' => 'Permissions',
        'description' => 'Managing the permissions that apply within the CMS.',
    ],
];
