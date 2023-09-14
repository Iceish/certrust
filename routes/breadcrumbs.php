<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Certificate;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//============
// HOME
//============

// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('home'));
});

//============
// AUTHORITIES
//============

// Authorities
Breadcrumbs::for('authorities.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Authorities', route('dashboard.authorities.index'));
});

// Authorities > create
Breadcrumbs::for('authorities.create', function (BreadcrumbTrail $trail) {
    $trail->parent('authorities.index');
    $trail->push('Create', route('dashboard.authorities.create'));
});

// Authorities > [Photo Name]
Breadcrumbs::for('authorities.show', function (BreadcrumbTrail $trail, Certificate $authority) {
    $trail->parent('authorities.index');
    $trail->push($authority->common_name, route('dashboard.authorities.show', $authority));
});

//============
// MANAGEMENT
//============

Breadcrumbs::for('management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Management', route('dashboard.management.index'));
});

//============
// SETTINGS
//============

Breadcrumbs::for('settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Settings', route('dashboard.settings.index'));
});
