<?php

  use app\core\Application;
  use app\controllers\SiteController;
  use app\controllers\KnivesController;
  use app\core\Logger;


  define('ROOT', dirname(__DIR__));
  define('IMAGEROOT', '/images/profile_pictures/');
  define('DEFAULTIMAGE', 'defaultuserpicture.png');
  define('COPYRIGHT', '© Beaumerle by ratoon : Jul 31 2022, 1.22');
  define('APPTITLE', 'BoMerle-MVC');


  /*
      Install https://getcomposer.org/ to use namespaces:  
      1 / composer init
        Creates the composer json file
      2 / composer update
        Creates the composer files in vendor
  */
  require_once __DIR__.'/../vendor/autoload.php';

  $logger = new Logger(__CLASS__);
  $app = new Application(dirname(__DIR__));
  
  // -----------------------------------------------------------------
  // Build the routes table.
  // Each route is associated with a controller class and a method
  // in this controller.
  // The Application run() method calls the router to process the request.
  // Application object also exposes itself as a static object to give 
  // access to other services to routers and controllers.
  // -----------------------------------------------------------------
  // Standard PHP requests
  $app->router->get('/', [SiteController::class, 'home']);
  $app->router->get('/admin', [SiteController::class, 'adminhome']);
  $app->router->get('/admin/login', [AuthController::class, 'login']);
  $app->router->post('/admin/login', [AuthController::class, 'login']);  

  // JSON request. They send back a JSON response for an SPA application.
  $app->router->get('/knives/getall', [KnivesController::class, 'getAll']);
  $app->router->post('/knives/getbyid', [KnivesController::class, 'getKniveByID']);
  $app->router->post('/knives/getbylabel', [KnivesController::class, 'getKniveByLabel']);
  
  $app->run();
?>
