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
// Certificate
//============

// Certificates
Breadcrumbs::for('certificates.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Certificates', route('dashboard.certificates.index'));
});

// Certificates > create
Breadcrumbs::for('certificates.create', function (BreadcrumbTrail $trail) {
    $trail->parent('certificates.index');
    $trail->push('Create', route('dashboard.certificates.create'));
});

// Certificates > [Photo Name]
Breadcrumbs::for('certificates.show', function (BreadcrumbTrail $trail, Certificate $authority) {
    $trail->parent('certificates.index');
    $trail->push($authority->common_name, route('dashboard.certificates.show', $authority));
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
