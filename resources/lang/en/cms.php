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
            'default' => 'Default',
            'not_default' => 'Not default',
            'enabled' => 'Enabled',
            'not_enabled' => 'Not enabled',
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

            'fields' => [
                'locale' => [
                    'label' => 'Language',
                    'description' => 'The language which the page content is written in.',
                ],
            ],

            'table' => [
                'name' => 'Name',
                'locale' => 'Language',
                'status' => 'Status',
                'slug' => 'Slug',
                'author' => 'Author',
                'updated_at' => 'Updated at',
            ],

            'tabs' => [
                'meta' => 'Meta',
            ],

            'filters' => [
                'locale' => [
                    'label' => 'Language',
                ],
            ],
        ],

        'language' => [
            'label' => 'Languages',
            'singular' => 'Language',
        ],

        'settings' => [
            'website' => [
                'title' => 'Website settings',
                'label' => 'Settings',
                'online' => [
                    'label' => 'Website accessible?',
                    'description' => 'The website is accessible only when this is on.',
                ],
                'sections' => [
                    'general' => [
                        'title' => 'Website',
                        'description' => 'Website settings that set up operation and initial functionality.',
                    ],
                    'languages' => [
                        'title' => 'Languages',
                        'description' => 'The languages in which the website will provide content. The languages here can still be activated and/or deactivated so they can be filled in before being made active.',
                    ],
                ],
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
            'canonicals' => [
                'label' => 'Canonical links',
                'description' => 'By default, the canonical link is automatically generated based on the current URL. If you want to add some extra, you can add multiple canonical links here.',
            ],
            'sections' => [
                'page_meta' => [
                    'title' => 'Page meta information',
                    'description' => 'Information about the page which is being used for indexing by search engines.',
                ],
                'meta' => [
                    'title' => 'Search engine settings',
                    'description' => 'Settings which will be used to control how this page is indexed and served to search engines.',
                ],
            ],
        ],
    ],
];
