<?php

return [
    'admins' => [
        'Maruweb dev' => 'dev@maruweb.vn',
        'Maruweb admin' => 'admin@maruweb.vn',
        'Maruweb content admin' => 'contentadmin@maruweb.vn',
        'Maruweb user admin' => 'useradmin@maruweb.vn'
    ],

    'password' => 'Qwe123!@#',

    'admin_guard_name' => 'admin',

    'roles' => ['dev', 'super admin', 'content admin', 'user admin'],

    'permissions_assign_roles' => [
        'manage dashboard' => ['dev', 'super admin', 'user admin'],
        'manage users' => ['dev', 'super admin', 'user admin'],
        'manage admins' => ['dev', 'super admin'],
        'manage common settings' => ['dev', 'super admin']
    ],

    'assign_roles_to_admins' => [
        'dev@maruweb.vn' => 'dev',
        'admin@maruweb.vn' => 'super admin',
        'contentadmin@maruweb.vn' => 'content admin',
        'useradmin@maruweb.vn' => 'user admin'
    ]
];