<?php

namespace Config;

use App\Controllers\TeacherController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

//Course Routes For Projects
$routes->post('/add','CourseController::course_add',['filter'=>'auth']);
$routes->get('/find/(:num)','CourseController::course_view_single/$1');
$routes->get('/findall','CourseController::view_all_data');
$routes->put('/updated/(:num)','CourseController::course_update/$1');
$routes->delete('/delete/(:num)','CourseController::Delete/$1');

// Teacher Routes For Projects..
$routes->post('/register','TeacherController::Teacher_Register');
$routes->post('/login','TeacherController::Teacher_Login');
$routes->get('/logout','TeacherController::Teacher_logout');
// $routes->get('/login','TeacherController::loginForm');


// Students Routes For Projects..
$routes->post('/std_register','StudentController::student_register');
$routes->post('/std_login','StudentController::student_login');
$routes->get('/view_all','StudentController::std_viewall',['filter'=>'student']);
$routes->get('/view/(:num)','StudentController::std_view/$1');
$routes->delete('/unregister/(:num)','StudentController::un_register/$1');
$routes->get('/std_logout','StudentController::Student_logout');

/*students
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
