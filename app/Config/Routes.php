<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingPage::index');
$routes->get('Panduan', 'LandingPage::Panduan');
$routes->setAutoRoute(true);