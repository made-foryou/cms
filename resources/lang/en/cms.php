<?php

use Made\Cms\Language\Models\Language;
use Made\Cms\Models;
use Made\Cms\News\Models\Post;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Models\Meta;

// translations for Made/Cms
return [
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
        Page::class => [
            'title' => 'Pages',
            'description' => 'Managing the pages within the CMS.',
        ],
        Meta::class => [
            'title' => 'Meta',
            'description' => 'Managing the meta data for the items within the CMS.',
        ],
        Language::class => [
            'title' => 'Languages',
            'description' => 'Managing the languages within the CMS.',
        ],
        Post::class => [
            'title' => 'Posts',
            'description' => 'Managing the news items within the CMS.',
        ],
    ],

    'default_data' => [
        'menu_locations' => [
            'main' => [
                'name' => 'Main menu',
                'description' => 'Basic main menu which is used at the top of the page.',
            ],
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

    'navigation_groups' => [
        'pages' => 'Pages',
        'news' => 'News',
        'website' => 'Website',
        'security' => 'Security',
        'analytics' => 'Analytics',
    ],

    'common' => [
        'yes' => 'Yes',
        'no' => 'No',
        'all' => 'All',
        'other' => 'Other',
    ],

    'resources' => [
        'common' => [
            'overview' => 'Overview',
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

        'role' => [
            'label' => 'Roles',
            'singular' => 'Role',

            'table' => [
                'name' => [
                    'label' => 'Name',
                ],
                'description' => [
                    'label' => 'Description',
                    'description' => 'A brief description that makes it clear what kind of role this is.',
                ],
                'is_default' => [
                    'label' => 'Admin role?',
                    'tooltip' => 'A role with this checked automatically gains access to all current and new permissions.',
                ],
                'users_count' => [
                    'label' => 'Users with this role',
                ],
            ],

            'form' => [
                'sections' => [
                    'main' => [
                        'heading' => 'Role',
                        'description' => 'General details of the role.',
                    ],
                    'permissions' => [
                        'heading' => 'Permissions',
                        'description' => 'Here you select the permissions the role has.',
                    ],
                ],

                'fields' => [
                    'name' => [
                        'label' => 'Name',
                    ],
                    'description' => [
                        'label' => 'Description',
                        'helperText' => 'A brief description that makes it clear what kind of role this is.',
                    ],
                    'is_default' => [
                        'label' => 'Admin role?',
                        'helperText' => 'A role with this checked automatically gains access to all current and new permissions.',
                    ],
                ],
            ],
        ],

        'user' => [
            'label' => 'Users',
            'singular' => 'User',

            'table' => [
                'heading' => 'Users',
                'description' => 'A list of all users within the system.',

                'columns' => [
                    'cms_access' => [
                        'label' => 'Has access to the CMS?',
                    ],
                    'role_name' => [
                        'label' => 'Role',
                    ],
                    'email_verified_at' => [
                        'label' => 'Email verified at',
                    ],
                ],
            ],

            'form' => [
                'sections' => [
                    'user' => [
                        'heading' => 'User',
                        'description' => 'General data of the user',
                    ],
                ],

                'fields' => [
                    'role' => [
                        'label' => 'User role',
                        'helperText' => 'The user gets his rights according to this role.',
                    ],
                    'email_verified_at' => [
                        'label' => 'Email verified at',
                    ],
                    'password' => [
                        'label' => 'Password',
                        'helperText' => 'Adjust this field only once you want to change the user\'s password.',
                    ],
                ],
            ],

            'infolist' => [
                'sections' => [
                    'user' => [
                        'heading' => 'User',
                        'description' => 'General data of the user',
                    ],
                    'management' => [
                        'heading' => 'Management',
                        'description' => 'User management data',
                    ],
                ],

                'entries' => [
                    'email_verified_at' => [
                        'label' => 'Email verified at',
                    ],
                    'role_name' => [
                        'label' => 'Role',
                    ],
                ],
            ],
        ],

        'page' => [
            'label' => 'Pages',
            'singular' => 'Page',

            'fields' => [
                'status' => [
                    'label' => 'Status',
                    'description' => 'This status of the page indicates what the page can be used for. Once the status is set to published, any visitor can view the page.',
                ],
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
                'created_by' => 'Created by',
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

                'fields' => [
                    'menu_locations' => [
                        'add_action_label' => 'Add menu location',
                        'fields' => [
                            'key' => [
                                'label' => 'ID',
                                'helperText' => 'Using this value, the contents of the menu can be retrieved.',
                            ],
                            'name' => [
                                'label' => 'Name',
                                'helperText' => 'Location name.',
                            ],
                            'description' => [
                                'label' => 'Description',
                                'helperText' => 'A brief description of the menu location and where it is used.',
                            ],
                        ],
                    ],
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
                    'menulocations' => [
                        'title' => 'Menu locations',
                        'description' => 'Manage menu locations here which are used to populate navigation menus and display them in certain places in the website.',
                    ],
                ],
            ],
            'analytics' => [
                'label' => 'Analytics settings',

                'sections' => [
                    'visits' => [
                        'heading' => 'Visit analytics settings',
                        'description' => 'Settings for tracking user visits to sections in the website.',
                    ],
                ],
                'fields' => [
                    'ip_blacklist' => [
                        'label' => 'IP Blacklist',
                        'helperText' => 'A list of IP addresses which should not be tracked. One IP address per line.',
                        'placeholder' => 'Enter the ip address',
                    ],
                    'saving_strategy' => [
                        'label' => 'Saving visiting logs',
                        'helperText' => 'For how long do you want to save the visiting logs? The logs will be deleted and backed up after the selected period and sent by mail.',
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
                'post_meta' => [
                    'title' => 'News post meta information',
                    'description' => 'Information about the news post which is being used for indexing by search engines.',
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
                'content' => 'Content',
                'meta' => 'Meta',
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
                'status' => [
                    'label' => 'Status',
                    'helperText' => 'This status of the post indicates what the post can be used for. Once the status is set to published, any visitor can view the post.',
                ],
                'locale' => [
                    'label' => 'Language',
                    'helperText' => 'The language which the post content is written in.',
                ],
                'translated_from' => [
                    'label' => 'Translated from',
                    'helperText' => 'This news item is a translation of the news item selected above. It cannot be changed.',
                ],
                'content' => [
                    'label' => 'Content strips',
                    'helperText' => 'News item content is constructed from strips. Each strip in turn has its own settings and content. These can be added, dragged and/or deleted here.',
                    'add_button' => 'Add new content strip',
                ],
                'meta' => [
                    'title' => [
                        'label' => 'News post title',
                        'helperText' => 'The post-title which will be displayed in search results and within the browser tab.',
                    ],
                    'description' => [
                        'label' => 'Description',
                        'helperText' => 'A short descriptive description about the contents of this post. This description will be displayed within the search results.',
                    ],
                    'robot' => [
                        'label' => 'Robot setting',
                        'helperText' => 'The robots meta tag lets you use a granular, page-specific approach to controlling how an individual HTML page should be indexed and served to users in Google Search results.',
                    ],
                    'canonicals' => [
                        'label' => 'Canonical links',
                        'helperText' => 'By default, the canonical link is automatically generated based on the current URL. If you want to add some extra, you can add multiple canonical links here.',
                    ],
                ],
            ],
        ],
    ],

    'enums' => [
        'visit_saving' => [
            'save_all' => [
                'label' => 'Keep everything',
            ],
            'save_half_year' => [
                'label' => 'Keep the visits for one half year.',
            ],
            'save_year' => [
                'label' => 'Keep the visits for one year.',
            ],
            'save_2_years' => [
                'label' => 'Keep the visits for two years.',
            ],
            'save_3_years' => [
                'label' => 'Keep the visits for three years.',
            ],
        ],
    ],
];
