<?php

use Made\Cms\Models;

// translations for Made/Cms
return [
    'groups' => [
        'user' => 'User Management',
        'administration' => 'Administration',
        'website_management' => 'Website management',
    ],

    'class_names' => [
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
        Models\Page::class => [
            'title' => 'Pages',
            'description' => 'Managing the pages within the CMS.',
        ],
        Models\Meta::class => [
            'title' => 'Meta',
            'description' => 'Managing the meta data for the items within the CMS.',
        ],
        \Made\Cms\Language\Models\Language::class => [
            'title' => 'Languages',
            'description' => 'Managing the languages within the CMS.',
        ],
    ],

    'permissions' => [
        'fields' => [
            'subject' => [
                'label' => 'Subject',
            ],
        ],

        'user' => [
            'view_any' => [
                'name' => 'See overview of users',
                'description' => 'Allows the user to view the overview of all users.',
            ],
            'view' => [
                'name' => 'Viewing a user',
                'description' => 'Allows the user to view a user\'s detail data.',
            ],
            'create' => [
                'name' => 'Creating a user',
                'description' => 'Allows the user to add a new user.',
            ],
            'update' => [
                'name' => 'Changing a user',
                'description' => 'Allows the user to modify an existing user.',
            ],
            'delete' => [
                'name' => 'Deleting a user',
                'description' => 'Allows the user to delete an existing user.',
            ],
            'restore' => [
                'name' => 'Restore a user',
                'description' => 'Allows the user to restore a deleted user.',
            ],
            'force_delete' => [
                'name' => 'Forcibly delete a user',
                'description' => 'Allows the user to forcibly delete a user.',
            ],
            'access_panel' => [
                'name' => 'Access to the cms panel',
                'description' => 'Allows the user to log into the Made CMS.',
            ],
        ],

        'role' => [
            'view_any' => [
                'name' => 'See overview of all roles',
                'description' => 'Allows the user to view the overview of all roles.',
            ],
            'view' => [
                'name' => 'Viewing a role',
                'description' => 'Allows the user to view the details of a role and its permissions.',
            ],
            'create' => [
                'name' => 'Creating a role',
                'description' => 'Allows the user to add a new role.',
            ],
            'update' => [
                'name' => 'Changing a role',
                'description' => 'Allows the user to modify an existing role.',
            ],
            'delete' => [
                'name' => 'Removing a roll',
                'description' => 'Allows the user to delete an existing role.',
            ],
            'restore' => [
                'name' => 'Restoring a role',
                'description' => 'Allows the user to restore a deleted role.',
            ],
            'force_delete' => [
                'name' => 'Forcibly removing a roll',
                'description' => 'Allows the user to forcibly delete a role.',
            ],
        ],

        'permission' => [
            'view_any' => [
                'name' => 'See overview of all permissions',
                'description' => 'Allows the user to view the overview of all permissions.',
            ],
            'view' => [
                'name' => 'Viewing a permission',
                'description' => 'Allows the user to view the details of a permission.',
            ],
            'create' => [
                'name' => 'Creating a permission',
                'description' => 'Allows the user to add a new permission.',
            ],
            'update' => [
                'name' => 'Changing a permission',
                'description' => 'Allows the user to modify an existing permission.',
            ],
            'delete' => [
                'name' => 'Removing a permission',
                'description' => 'Allows the user to delete an existing permission.',
            ],
            'restore' => [
                'name' => 'Restoring a permission',
                'description' => 'Allows the user to restore a deleted permission.',
            ],
            'force_delete' => [
                'name' => 'Forcibly removing a permission',
                'description' => 'Allows the user to forcibly delete a permission.',
            ],
        ],

        'page' => [
            'view_any' => [
                'name' => 'See overview of all pages',
                'description' => 'Allows the user to view the overview of all pages.',
            ],
            'view' => [
                'name' => 'Viewing a page',
                'description' => 'Allows the user to view the details of a page.',
            ],
            'create' => [
                'name' => 'Creating a page',
                'description' => 'Allows the user to add a new page.',
            ],
            'update' => [
                'name' => 'Changing a page',
                'description' => 'Allows the user to modify an existing page.',
            ],
            'delete' => [
                'name' => 'Removing a page',
                'description' => 'Allows the user to delete an existing page.',
            ],
            'restore' => [
                'name' => 'Restoring a page',
                'description' => 'Allows the user to restore a deleted page.',
            ],
            'force_delete' => [
                'name' => 'Forcibly removing a page',
                'description' => 'Allows the user to forcibly delete a page.',
            ],
        ],

        'meta' => [
            'view_any' => [
                'name' => 'See all meta information',
                'description' => 'Allows the user to view all the meta information.',
            ],
            'view' => [
                'name' => 'Viewing meta information',
                'description' => 'Allows the user to view the meta information of items within the cms.',
            ],
            'create' => [
                'name' => 'Creating meta information',
                'description' => 'Allows the user to add new meta information.',
            ],
            'update' => [
                'name' => 'Changing meta information',
                'description' => 'Allows the user to modify meta information.',
            ],
            'delete' => [
                'name' => 'Removing meta information',
                'description' => 'Allows the user to delete meta information.',
            ],
            'restore' => [
                'name' => 'Restoring meta information',
                'description' => 'Allows the user to restore meta information.',
            ],
            'force_delete' => [
                'name' => 'Forcibly removing meta information',
                'description' => 'Allows the user to forcibly delete meta information.',
            ],
        ],

        'language' => [
            'view_any' => [
                'name' => 'See overview of all languages',
                'description' => 'Allows the user to view the overview of all languages.',
            ],
            'view' => [
                'name' => 'Viewing a language',
                'description' => 'Allows the user to view the details of a language.',
            ],
            'create' => [
                'name' => 'Creating a language',
                'description' => 'Allows the user to add a new language.',
            ],
            'update' => [
                'name' => 'Changing a language',
                'description' => 'Allows the user to modify an existing language.',
            ],
            'delete' => [
                'name' => 'Removing a language',
                'description' => 'Allows the user to delete an existing language.',
            ],
            'restore' => [
                'name' => 'Restoring a language',
                'description' => 'Allows the user to restore a deleted language.',
            ],
            'force_delete' => [
                'name' => 'Forcibly removing a language',
                'description' => 'Allows the user to forcibly delete a language.',
            ],
        ],
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

            'actions' => [
                'translate' => [
                    'label' => 'Make a translation',
                    'heading' => 'Creating page translation',
                    'description' => 'A copy of the page is prepared for the selected language. In this you can then continue translating the content.',
                    'fields' => [
                        'language' => [
                            'label' => 'Language',
                            'helperText' => 'For which language do you want to prepare a translation?',
                        ],
                    ],
                    'failure' => [
                        'title' => 'A translation of page :name already exists for the selected language.',
                    ],
                    'success' => [
                        'title' => 'The translation has been created from page :name and is ready for further translation.',
                    ],
                ],
            ],
        ],

        'language' => [
            'label' => 'Languages',
            'singular' => 'Language',

            'fields' => [
                'country' => [
                    'label' => 'Country',
                ],

                'locale' => [
                    'label' => 'Locale',
                    'description' => 'The locale of the language is used for selecting the translations.',
                ],

                'abbreviation' => [
                    'label' => 'Abbreviation',
                    'description' => 'This abbreviation will be added to the url which selects this language.',
                ],

                'is_default' => [
                    'label' => 'Default language',
                    'description' => 'Is this language the default language to be loaded from the website when there is none selected?',
                ],

                'is_enabled' => [
                    'label' => 'Language enabled?',
                    'description' => 'Can this language be used within the website?',
                ],

                'image' => [
                    'label' => 'Image',
                    'description' => 'This image can be used within any language switch to represent the language.',
                ],
            ],

            'actions' => [
                'default' => [
                    'label' => 'Use as default',
                    'heading' => 'Make the :name language standard?',
                    'description' => 'Are you sure you want to use :name as your default language?',
                    'successTitle' => ':name is now used as the standard.',
                ],
            ],
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
        'post' => [
            'label' => 'Posts',
            'singular' => 'Post',
            'tabs' => [
                'post' => 'Post',
            ],
            'fields' => [
                'name' => [
                    'label' => 'Title',
                    'helperText' => 'The title of the post which will be used to present the post and can be used for the url.',
                ],
                'slug' => [
                    'label' => 'Slug',
                    'helperText' => 'Title of the post which can be used in the url. This value must conform to the url standards and these are lowercase and no spaces or special characters.',
                ],
            ],
        ],
    ],

    'clusters' => [
        'news' => [
            'label' => 'News',
            'resources' => [
                'posts' => [
                    'label' => 'Posts',
                    'pluralLabel' => 'Posts',
                    'modelLabel' => 'Post',
                ],
            ],
        ],
    ],
];
