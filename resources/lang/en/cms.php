<?php

// translations for Made/Cms
return [
    'groups' => [
        'user' => 'User Management',
        'administration' => 'Administration',
        'website_management' => 'Website management',
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

        'page' => [
            'label' => 'Pages',
            'singular' => 'Page',
        ],
    ],
];
