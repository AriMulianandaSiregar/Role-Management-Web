<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true, // ubah true agar saat melakukan migrate data usernya langsung dibuat di masing-masing rolenya

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadmin' => [
            'users' => 'c,r,u,d',
            'articles' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'admin' => [
            'articles' => 'r,u',
            'profile' => 'r,u'
        ],
        'user' => [
            'articles' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        // 'role_name' => [
        //     'module_1_name' => 'c,r,u,d',
        // ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
