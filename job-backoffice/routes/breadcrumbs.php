<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('company.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('company.dashboard'));
});

Breadcrumbs::for('company.jobs', function (BreadcrumbTrail $trail) {
    $trail->parent('company.dashboard');
    $trail->push('Jobs', route('company.jobs'));
});