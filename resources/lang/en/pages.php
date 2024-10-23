<?php

return [
    'status' => [
        'draft' => 'Draft',
        'published' => 'Published',
    ],

    'tabs' => [
        'page' => 'Page',
        'content' => 'Content',
    ],

    'sections' => [
        'status' => 'Status',
    ],

    'fields' => [
        'name' => [
            'label' => 'Name',
            'description' => 'The name of the page which is used in the menu and default url.',
        ],
        'slug' => [
            'label' => 'Slug',
            'description' => 'Name of the page used in the url. This value must conform to the url standards and these are lowercase and no spaces or special characters.',
        ],
        'status' => [
            'label' => 'Status',
            'description' => 'This status of the page indicates what the page can be used for. Once the status is set to published, any visitor can view the page.',
        ],
        'content' => [
            'label' => 'Content strips',
            'description' => 'Page content is constructed from strips. Each strip in turn has its own settings and content. These can be added, dragged and/or deleted here.',
            'add_button' => 'Add new content strip',
        ],
    ],
];
