<?php

  /*
      Install https://getcomposer.org/
    
      To use namespaces:
    
      1 / composer init
        Creates the composer json file
      2 / composer update
        Creates the composer files in vendor

  */

  use app\core\Application;
  use app\controllers\SiteController;
  use app\controllers\KnivesController;
  use app\core\Logger;


  define('ROOT', dirname(__DIR__));
  define('IMAGEROOT', '/images/profile_pictures/');
  define('DEFAULTIMAGE', 'defaultuserpicture.png');
  define('COPYRIGHT', '© Beaumerle by ratoon : Jul 28 2022, 1.19');
  define('APPTITLE', 'BoMerle-MVC');

  require_once __DIR__.'/../vendor/autoload.php';

  $logger = new Logger(__CLASS__);
  $app = new Application(dirname(__DIR__));
  
  // Register a class and a method for the controller to call it
  
  $app->router->get('/', [SiteController::class, 'home']);

  $app->router->get('/knives/getall', [KnivesController::class, 'getAll']);
  $app->router->post('/knives/getbyid', [KnivesController::class, 'getKniveByID']);
  $app->router->post('/knives/getbylabel', [KnivesController::class, 'getKniveByLabel']);

  $app->router->get('/admin/login', [AuthController::class, 'login']);
  $app->router->post('/admin/login', [AuthController::class, 'login']);
  
  

  $app->run();
?>
