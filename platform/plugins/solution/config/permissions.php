<?php

return [
    [
        'name' => 'Solution',
        'flag' => 'plugins.solution',
    ],
    [
        'name' => 'sposts',
        'flag' => 'sposts.index',
        'parent_flag' => 'plugins.solution',
    ],
    [
        'name' => 'Create',
        'flag' => 'sposts.create',
        'parent_flag' => 'sposts.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'sposts.edit',
        'parent_flag' => 'sposts.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'sposts.destroy',
        'parent_flag' => 'sposts.index',
    ],

    [
        'name' => 'scategories',
        'flag' => 'scategories.index',
        'parent_flag' => 'plugins.solution',
    ],
    [
        'name' => 'Create',
        'flag' => 'scategories.create',
        'parent_flag' => 'scategories.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'scategories.edit',
        'parent_flag' => 'scategories.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'scategories.destroy',
        'parent_flag' => 'scategories.index',
    ],

    [
        'name' => 'stags',
        'flag' => 'stags.index',
        'parent_flag' => 'plugins.solution',
    ],
    [
        'name' => 'Create',
        'flag' => 'stags.create',
        'parent_flag' => 'stags.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'stags.edit',
        'parent_flag' => 'stags.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'stags.destroy',
        'parent_flag' => 'stags.index',
    ],
    [
        'name' => 'Solution Settings',
        'flag' => 'solution.settings',
        'parent_flag' => 'plugins.solution',
    ],
];
