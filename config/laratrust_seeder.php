<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d,confirm',
            'project' => 'r,u'
        ],
        'moderator' => [
            'users' => 'confirm',
            'project' => 'r,u'
        ],
        'user' => [
            'project' => 'c,u'
        ],
        'unconfirm_user' => [
            'profile' => 'r,u'
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'confirm' => 'confirm',
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',

    ]
];
