<?php

return [
    'GET' => [
        '/' => [
            'action' => 'App\\Controllers\\HomeController@index',
            'middleware' => 'AuthMiddleware'
        ],
        '/login' => [
            'action' => 'App\\Controllers\\Auth\\LoginController@showLoginForm',
            'middleware' => 'RedirectIfAuthenticate'
        ],
        '/admin' => [
            'action' => 'App\Controllers\\Admin\\HomeController@index',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/users' => [
            'action' => 'App\\Controllers\\Admin\\UserController@index',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/users/create' => [
            'action' => 'App\\Controllers\\Admin\\UserController@create',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/users/{id}' => [
            'action' => 'App\\Controllers\\Admin\\UserController@edit',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/roles' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@index',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/roles/create' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@create',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/roles/{id}' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@edit',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/permissions' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@index',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/permissions/create' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@create',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/permissions/{id}' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@edit',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/features' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@index',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/features/create' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@create',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/features/{id}' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@edit',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/products' => [
            'action' => 'App\\Controllers\\Admin\\ProductController@index',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/products/create' => [
            'action' => 'App\\Controllers\\Admin\\ProductController@create',
            'middleware' => 'AuthMiddleware'
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
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/users/{id}' => [
            'action' => 'App\\Controllers\\Admin\\UserController@update',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/users/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\UserController@destroy',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/roles/create' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@store',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/roles/{id}' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@update',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/roles/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@destroy',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/permissions/create' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@store',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/permissions/{id}' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@update',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/permissions/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@destroy',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/features/create' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@store',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/features/{id}' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@update',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/features/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@destroy',
            'middleware' => 'AuthMiddleware'
        ],
        '/admin/update-all' => [
            'action' => 'App\Controllers\\Admin\\HomeController@updateAllData',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ]
    ]
];