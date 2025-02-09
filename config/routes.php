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
        '/logout' => [
            'action' => 'App\\Controllers\\Auth\\LoginController@logout',
            'middleware' => 'GuestMiddleware'
        ],
        '/register' => [
            'action' => 'App\\Controllers\\Auth\\RegisterController@showRegisterForm',
            'middleware' => 'RedirectIfAuthenticate'
        ],
        '/admin' => [
            'action' => 'App\Controllers\\Admin\\HomeController@index',
            'middleware' => [
                'RoleMiddleware' => ['admin', 'editor']
            ]
        ],
        '/admin/profile' => [
            'action' => 'App\\Controllers\\Admin\\HomeController@profile',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/users' => [
            'action' => 'App\\Controllers\\Admin\\UserController@index',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/users/{id}' => [
            'action' => 'App\\Controllers\\Admin\\UserController@edit',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/roles' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@index',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/roles/create' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@create',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/roles/{id}' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@edit',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/roles/{id}/manage' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@manageRolePermission',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/permissions' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@index',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/permissions/create' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@create',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/permissions/{id}' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@edit',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/features' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@index',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/features/create' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@create',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/features/{id}' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@edit',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/features/{id}/manage' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@manageFeaturePermission',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/posts' => [
            'action' => 'App\\Controllers\\Admin\\PostController@index',
            'middleware' => [
                'RoleMiddleware' => ['admin', 'editor']
            ]
        ],
        '/admin/posts/create' => [
            'action' => 'App\\Controllers\\Admin\\PostController@create',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/posts/{id}' => [
            'action' => 'App\\Controllers\\Admin\\PostController@edit',
            'middleware' => [
                'RoleMiddleware' => ['admin', 'editor']
            ]
        ],
    ],
    'POST' => [
        '/login' => [
            'action' => 'App\\Controllers\\Auth\\LoginController@login'
        ],
        '/register' => [
            'action' => 'App\\Controllers\\Auth\\RegisterController@register'
        ],
        '/admin/users/{id}' => [
            'action' => 'App\\Controllers\\Admin\\UserController@update',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/users/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\UserController@destroy',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/roles/create' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@store',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/roles/{id}' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@update',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/roles/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@destroy',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/roles/{id}/manage' => [
            'action' => 'App\\Controllers\\Admin\\RoleController@updateRolePermission',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/permissions/create' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@store',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/permissions/{id}' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@update',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/permissions/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\PermissionController@destroy',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/features/create' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@store',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/features/{id}' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@update',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/features/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@destroy',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/features/{id}/manage' => [
            'action' => 'App\\Controllers\\Admin\\FeatureController@updateFeaturePermission',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/posts/create' => [
            'action' => 'App\\Controllers\\Admin\\PostController@store',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
        '/admin/posts/{id}' => [
            'action' => 'App\\Controllers\\Admin\\PostController@update',
            'middleware' => [
                'RoleMiddleware' => ['admin', 'editor']
            ]
        ],
        '/admin/posts/{id}/delete' => [
            'action' => 'App\\Controllers\\Admin\\PostController@destroy',
            'middleware' => [
                'RoleMiddleware' => ['admin']
            ]
        ],
    ]
];