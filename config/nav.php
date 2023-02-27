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
        'badge' => 'bew',
        'active' => 'dashboard.categories.*'

    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.categories.create',
        'title' => 'Products',
        'active' => 'dashboard.products'
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.categories.create',
        'title' => 'Orders',
        'active' => 'dashboard.orders'
    ],

];
