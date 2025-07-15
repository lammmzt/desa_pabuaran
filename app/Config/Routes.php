<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingPage::index');
$routes->get('Panduan', 'LandingPage::Panduan');
$routes->get('Kontak', 'LandingPage::Kontak');
$routes->get('Data_keluarga', 'LandingPage::Data_keluarga');
$routes->get('Ajuan', 'LandingPage::Ajuan');
$routes->setAutoRoute(true);