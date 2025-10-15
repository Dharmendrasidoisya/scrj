<?php

return [
    [
        'name' => 'Industry',
        'flag' => 'plugins.industry',
    ],
    [
        'name' => 'industry',
        'flag' => 'industryposts.index',
        'parent_flag' => 'plugins.industry',
    ],
    [
        'name' => 'Create',
        'flag' => 'industryposts.create',
        'parent_flag' => 'industryposts.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'industryposts.edit',
        'parent_flag' => 'industryposts.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'industryposts.destroy',
        'parent_flag' => 'industryposts.index',
    ],

    [
        'name' => 'industrycategories',
        'flag' => 'industrycategories.index',
        'parent_flag' => 'plugins.industry',
    ],
    [
        'name' => 'Create',
        'flag' => 'industrycategories.create',
        'parent_flag' => 'industrycategories.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'industrycategories.edit',
        'parent_flag' => 'industrycategories.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'industrycategories.destroy',
        'parent_flag' => 'industrycategories.index',
    ],

    [
        'name' => 'industrytags',
        'flag' => 'industrytags.index',
        'parent_flag' => 'plugins.industry',
    ],
    [
        'name' => 'Create',
        'flag' => 'industrytags.create',
        'parent_flag' => 'industrytags.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'industrytags.edit',
        'parent_flag' => 'industrytags.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'industrytags.destroy',
        'parent_flag' => 'industrytags.index',
    ],
    [
        'name' => 'Industry Settings',
        'flag' => 'industry.settings',
        'parent_flag' => 'plugins.industry',
    ],
];
