<?php
session_start();
require_once("../vendor/autoload.php");
require_once '../config/config.php';

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\dashboardcontroller;
use App\Controllers\CandidatController;
use App\Controllers\emploitcontroller;
use App\Controllers\loadjobs;



$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Instantiate the controller based on the route
switch ($route) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
        // case 'fetchMoreUsers':
        //     $controller = new HomeController();
        //     $controller->fetchMoreUsers();
        //     break;
    case 'login':
        $logincontroller = new LoginController();
        $logincontroller->login();
        break;
    case 'signup':
        $logincontroller = new LoginController();
        $logincontroller->signup();
        break;
    case 'logout':
        $logincontroller = new LoginController();
        $logincontroller->logout();
        break;
    case 'loadjobs':
        $logincontroller = new loadjobs();
        $logincontroller->loadjobs();
        break;
    case 'dashboard':
        $logincontroller = new dashboardcontroller();
        $logincontroller->dashboard();
        break;
    case 'candidat':
        $logincontroller = new CandidatController();
        $logincontroller->candidat();
        break;
    case 'acceptcandidat':
        $logincontroller = new CandidatController();
        $logincontroller->accept();
        break;
    case 'refusecandidat':
        $logincontroller = new CandidatController();
        $logincontroller->refuse();
        break;
    case 'emploit':
        $logincontroller = new emploitcontroller();
        $logincontroller->emploit();
        break;
    case 'deletejob':
        $logincontroller = new emploitcontroller();
        $logincontroller->delete();
        break;
    case 'modifyjob':
        $logincontroller = new emploitcontroller();
        $logincontroller->modify();
        break;
    case 'createjob':
        $logincontroller = new emploitcontroller();
        $logincontroller->create();
        break;
    case 'apply':
        $logincontroller = new emploitcontroller();
        $logincontroller->apply();
        break;
        // Add more cases for other routes as needed
    default:
        // Handle 404 or redirect to the default route
        header('HTTP/1.0 404 Not Found');
        exit('Page not found');
}

// Execute the controller action
