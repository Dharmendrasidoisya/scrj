<?php

return [
    [
        'name' => 'Projects',
        'flag' => 'plugins.projects',
    ],
    [
        'name' => 'projects',
        'flag' => 'projectsposts.index',
        'parent_flag' => 'plugins.projects',
    ],
    [
        'name' => 'Create',
        'flag' => 'projectsposts.create',
        'parent_flag' => 'projectsposts.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'projectsposts.edit',
        'parent_flag' => 'projectsposts.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'projectsposts.destroy',
        'parent_flag' => 'projectsposts.index',
    ],

    [
        'name' => 'projectscategories',
        'flag' => 'projectscategories.index',
        'parent_flag' => 'plugins.projects',
    ],
    [
        'name' => 'Create',
        'flag' => 'projectscategories.create',
        'parent_flag' => 'projectscategories.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'projectscategories.edit',
        'parent_flag' => 'projectscategories.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'projectscategories.destroy',
        'parent_flag' => 'projectscategories.index',
    ],

    [
        'name' => 'projectstags',
        'flag' => 'projectstags.index',
        'parent_flag' => 'plugins.projects',
    ],
    [
        'name' => 'Create',
        'flag' => 'projectstags.create',
        'parent_flag' => 'projectstags.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'projectstags.edit',
        'parent_flag' => 'projectstags.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'projectstags.destroy',
        'parent_flag' => 'projectstags.index',
    ],
    [
        'name' => 'Projects Settings',
        'flag' => 'projects.settings',
        'parent_flag' => 'plugins.projects',
    ],
];
