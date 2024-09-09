<?php

// translations for Made/Cms
return [
    'role' => [
        'default' => [
            'name' => 'Administrator',
            'description' => 'Main role of the Made CMS. This is the default role which gets access to all permissions.',
        ],
    ],

    'permissions' => [
        'accessPanel' => [
            'name' => 'Access to the cms panel.',
            'description' => 'This permission gives you access to the cms panel. You need this permission to log into the panel.',
        ],
    ],

    'groups' => [
        'user' => 'User Management',
        'administration' => 'Administration',
    ],

    'resources' => [
        'common' => [
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
            'deleted_at' => 'Deleted at',
        ],

        'user' => [
            'label' => 'Users',
            'singular' => 'User',
            'fields' => [
                'role' => 'Role',
                'email_verified_at' => 'Email verified at',
                'password' => 'Password',
                'remember_token' => 'Remember me token',
            ],
            'helpers' => [
                'password' => 'Adjust this field only once you want to change the user\'s password.',
            ],
            'sections' => [
                'user' => [
                    'label' => 'User',
                    'description' => 'User details.',
                ],
                'management' => [
                    'label' => 'Management',
                    'description' => 'Data for managing this user.',
                ],
            ],
        ],
    ],
];
