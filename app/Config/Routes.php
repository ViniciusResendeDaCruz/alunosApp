<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AlunosController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/',                                       'Home::index');
$routes->group('alunos',function($routes){
    $routes->get('/',                                   'Alunos\AlunosController::alunos');
    $routes->get('alunos-tabela',                       'Alunos\AlunosController::alunosTabela');
    $routes->get('editar-aluno-modal/(:num)',           'Alunos\AlunosController::editarAlunoModal/$1');
    $routes->post('editar-aluno/(:num)',                'Alunos\AlunosController::editarAluno/$1');
    $routes->post('cadastrar-aluno',                    'Alunos\AlunosController::cadastrarAluno');
    $routes->post('remover-aluno/(:num)',               'Alunos\AlunosController::removerAluno/$1');
    $routes->get('visualizar-aluno-modal/(:num)',       'Alunos\AlunosController::visualizarAlunoModal/$1');
    $routes->post('remover-foto-de-perfil-aluno/(:num)',       'Alunos\AlunosController::removerFotoDePerfilAluno/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
