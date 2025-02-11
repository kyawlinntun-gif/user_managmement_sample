<?php

return [
    'GET' => [
        '/' => [
            'action' => 'App\\Controllers\\HomeController@index',
        ],
        '/login' => [
            'action' => 'App\\Controllers\\Auth\\LoginController@showLoginForm',
            'middleware' => 'RedirectIfAuthenticate'
        ],
        '/admin' => [
            'action' => 'App\Controllers\\Admin\\HomeController@index',
        ],
        '/admin/users' => [
            'action' => 'App\\Controllers\\Admin\\UserController@index',
        ],
        '/admin/users/create' => [
            'action' => 'App\\Controllers\\Admin\\UserController@create',
        ],
        '/admin/users/{id}' => [
            'action' => 'App\\Controllers\\Admin\\UserController@edit',
        ],
        '/admin/roles' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@index',
        ],
        '/admin/roles/create' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@create',
        ],
        '/admin/roles/{id}' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@edit',
        ],
        '/admin/permissions' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@index',
        ],
        '/admin/permissions/create' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@create',
        ],
        '/admin/permissions/{id}' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@edit',
        ],
        '/admin/features' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@index',
        ],
        '/admin/features/create' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@create',
        ],
        '/admin/features/{id}' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@edit',
        ],
        '/admin/products' => [
            'action' => 'App\\Controllers\\Admin\\ProductController@index',
        ],
        '/admin/products/create' => [
            'action' => 'App\\Controllers\\Admin\\ProductController@create',
        ]
    ],
    'POST' => [
        '/login' => [
            'action' => 'App\\Controllers\\Auth\\LoginController@login'
        ],
        '/logout' => [
            'action' => 'App\\Controllers\\Auth\\LoginController@logout',
            'middleware' => 'GuestMiddleware'
        ],
        '/admin/users/create' => [
            'action' => 'App\\Controllers\\Admin\\UserController@store',
        ],
        '/admin/users/{id}' => [
            'action' => 'App\\Controllers\\Admin\\UserController@update',
        ],
        '/admin/users/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\UserController@destroy',
        ],
        '/admin/roles/create' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@store',
        ],
        '/admin/roles/{id}' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@update',
        ],
        '/admin/roles/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@destroy',
        ],
        '/admin/permissions/create' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@store',
        ],
        '/admin/permissions/{id}' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@update',
        ],
        '/admin/permissions/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@destroy',
        ],
        '/admin/features/create' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@store',
        ],
        '/admin/features/{id}' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@update',
        ],
        '/admin/features/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@destroy',
        ],
        '/admin/update-all' => [
            'action' => 'App\Controllers\\Admin\\HomeController@updateAllData',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ]
    ]
];