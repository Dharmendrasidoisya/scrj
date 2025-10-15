<?php

return [
    [
        'name' => 'News',
        'flag' => 'plugins.news',
    ],
    [
        'name' => 'news',
        'flag' => 'newsposts.index',
        'parent_flag' => 'plugins.news',
    ],
    [
        'name' => 'Create',
        'flag' => 'newsposts.create',
        'parent_flag' => 'newsposts.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'newsposts.edit',
        'parent_flag' => 'newsposts.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'newsposts.destroy',
        'parent_flag' => 'newsposts.index',
    ],

    [
        'name' => 'newscategories',
        'flag' => 'newscategories.index',
        'parent_flag' => 'plugins.news',
    ],
    [
        'name' => 'Create',
        'flag' => 'newscategories.create',
        'parent_flag' => 'newscategories.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'newscategories.edit',
        'parent_flag' => 'newscategories.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'newscategories.destroy',
        'parent_flag' => 'newscategories.index',
    ],

    [
        'name' => 'newstags',
        'flag' => 'newstags.index',
        'parent_flag' => 'plugins.news',
    ],
    [
        'name' => 'Create',
        'flag' => 'newstags.create',
        'parent_flag' => 'newstags.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'newstags.edit',
        'parent_flag' => 'newstags.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'newstags.destroy',
        'parent_flag' => 'newstags.index',
    ],
    [
        'name' => 'News Settings',
        'flag' => 'news.settings',
        'parent_flag' => 'plugins.news',
    ],
];
