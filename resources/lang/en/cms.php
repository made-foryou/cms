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

            'tabs' => [
                'meta' => 'Meta',
            ],
        ],

        'meta' => [
            'title' => [
                'label' => 'Page title',
                'description' => 'The page-title which will be displayed in search results and within the browser tab.',
            ],
            'description' => [
                'label' => 'Description',
                'description' => 'A short descriptive description about the contents of the page. This description will be displayed within the search results.',
            ],
            'robot' => [
                'label' => 'Robot setting',
                'description' => 'The robots meta tag lets you use a granular, page-specific approach to controlling how an individual HTML page should be indexed and served to users in Google Search results.',
            ],
        ],
    ],
];
