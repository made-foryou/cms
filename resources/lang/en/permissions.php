<?php

return [
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
];
