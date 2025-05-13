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
         * ____
         * Using this setting, you can adjust the path in the URL where the CMS is available.
         *
         * @var string
         */
        'path' => env('MADE_CMS_PANEL_PATH', 'made'),

        /**
         * #### Panel domain
         * ____
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

        /**
         * ### Panel default
         * _____
         *
         * Makes the Made panel the default one which makes sure that the
         * created resources from the project will be automatically
         * added to this panel.
         *
         * @var bool
         */
        'default' => true,

        'resources' => [],

        'pages' => [],

        /**
         * ### Custom link types
         * _____
         *
         * These custom link types make it possible to add link types to the url selection within
         * the CMS. So when you add custom resources and models you can add them to the link
         * selection this way.
         *
         * @var array<string, class-string<RouteableContract>>
         */
        'custom_link_types' => [],

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

    'routing' => [

        /**
         * Route Controllers
         *
         * You can specify per Routeable model which controller to use. These controllers will be
         * used when the matching route is of the routeable model type and will be used to
         * render the page of the route.
         *
         * For creating the controllers take a closer look at the documentation about
         *
         * @var array<class-string<\Illuminate\Database\Eloquent\Model>, class-string<\Made\Cms\App\Http\Controllers\CmsRoutingContract>>,
         */
        'controllers' => [],
    ],

    /**
     * ### Content
     */
    'content' => [
        'blocks' => [
            /**
             * List of default content stip blocks.
             *
             * These blocks be added to every content strip field.
             *
             * @var class-string<\Made\Cms\Filament\Builder\ContentStrip>[]
             */
            'default' => [
                //
            ],

            /**
             * Page content strip blocks.
             *
             * These blocks will only be added to the content strip field for the
             * Page model.
             *
             * @var class-string<\Made\Cms\Filament\Builder\ContentStrip>[]
             */
            \Made\Cms\Page\Models\Page::class => [
                //
            ],

            /**
             * News content strip blocks.
             *
             * These blocks will only be added to the content strip field for the
             * Post model.
             *
             * @var class-string<\Made\Cms\Filament\Builder\ContentStrip>[]
             */
            \Made\Cms\News\Models\Post::class => [
                //
            ],
        ],
    ],

    'settings' => [

        /**
         * ### Website Model
         * ____
         * This is the model which will be used for the website settings. This model will be used
         * to store the settings for the website part of the CMS.
         *
         * When creating a custom model for adding custom settings, make sure to extend the
         * WebsiteSetting model from the Made CMS package.
         *
         * @var class-string<\Illuminate\Database\Eloquent\Model>
         */
        'website_model' => \Made\Cms\Website\Models\Settings\WebsiteSetting::class,

        /**
         * ### Website Settings
         * ____
         * Custom settings for the website. These settings will be added to the Website settings
         * page in the CMS panel. Every item can be an invokable class which returns an array of
         * fields or an array of fields.
         *
         * @var array<int, class-string|array<int, Field>>
         */
        'web' => [],

        /**
         * ### News Model
         * ____
         * This is the model which will be used for the news settings. This model will be used
         * to store the settings for the news part of the CMS.
         *
         * When creating a custom model for adding custom settings, make sure to extend the
         * NewsSettings model from the Made CMS package.
         *
         * @var class-string<\Illuminate\Database\Eloquent\Model>
         */
        'news_model' => \Made\Cms\News\Models\Settings\NewsSettings::class,

        /**
         * ### News Settings
         * ____
         * Custom settings for the news part. These settings will be added to the News settings
         * page in the CMS panel. Every item can be an invokable class which returns an array of
         * fields or an array of fields.
         *
         * @var array<int, class-string|array<int, Field>>
         */
        'news' => [],

    ],

];
