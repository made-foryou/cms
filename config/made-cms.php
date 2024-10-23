<?php

// config for Made/Cms
return [

    'setup' => [
        'super_role' => [
            'name' => 'Administrator',
            'description' => 'Main role of the Made CMS. This is the default role which gets access to all permissions.',
        ],
    ],

    /**
     * ### Panel
     */
    'panel' => [

        /**
         * ### Panel path
         *
         * Using this setting, you can adjust the path in the URL where the CMS is available.
         *
         * @var string
         */
        'path' => env('MADE_CMS_PANEL_PATH', 'made'),

        /**
         * #### Panel domain
         *
         * This setting ensures that the CMS panel is associated with these
         * domain names.
         *
         * For instance, if you wish to make the CMS panel accessible only
         * through a subdomain, leave the path setting empty and enter
         * the subdomain here.
         *
         * @var null|string|string[]
         */
        'domain' => env('MADE_CMS_PANEL_DOMAIN'),

    ],

    /**
     * ### Database
     */
    'database' => [

        /**
         * ### Table prefix
         *
         * This value will be used with prefixing the generated database tables
         * from this plugin.
         *
         * @var string
         */
        'table_prefix' => env('MADE_CMS_DATABASE_TABLE_PREFIX', 'made_cms_'),

    ],

    /**
     * ### Content
     */
    'content' => [
        'blocks' => [
            //
        ],
    ],

];
