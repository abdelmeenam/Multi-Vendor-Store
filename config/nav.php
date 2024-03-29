<?php
return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard.dashboard'
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'Categories',
        'active' => 'dashboard.categories.*',
        'ability' => 'categories.view'
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
        'ability' => 'products.view'
    ],

    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.roles.index',
        'title' => 'Roles',
        'active' => 'dashboard.roles.*',
        'ability' => 'roles.view'
    ],

    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'dashboard.users.index',
        'title' => 'Users',
        'active' => 'dashboard.users.*',
        'ability' => 'users.view'
    ],

    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'dashboard.admins.index',
        'title' => 'admins',
        'active' => 'dashboard.admins.*',
        'ability' => 'admins.view'
    ],
];
