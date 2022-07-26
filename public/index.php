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
  use app\controllers\AuthController;
  use app\models\UserModel;
  use app\core\Logger;


  define('ROOT', dirname(__DIR__));
  define('IMAGEROOT', '/images/profile_pictures/');
  define('DEFAULTIMAGE', 'defaultuserpicture.png');

  require_once __DIR__.'/../vendor/autoload.php';

  $config = [
    'userClass' => UserModel::class,
    'db' => [
      'dsn' => 'mysql:localhost;port=3306;dbname=mvcfr',
      'user' => 'root',
      'password' => 'root'      
    ],
    'copyright' => '© Beaumerle by ratoon : Jul 26 2022, 1.16'
  ];

  $logger = new Logger(__CLASS__);
  $logger->console('Get there');
  $app = new Application(dirname(__DIR__), $config);
  
  // Register a class and a method for the controller to call it
  $app->router->get('/', [siteController::class, 'home']);
  $app->router->get('/contact', [SiteController::class, 'contact']);
  $app->router->get('/basic', [SiteController::class, 'basic']);
  $app->router->post('/contact', [SiteController::class, 'handleContact']); 

  $app->router->get('/login', [AuthController::class, 'login']);
  $app->router->post('/login', [AuthController::class, 'login']);
  $app->router->get('/register', [AuthController::class, 'register']);
  $app->router->post('/register', [AuthController::class, 'register']);
  $app->router->get('/logout', [AuthController::class, 'logout']);
  $app->router->get('/profile', [AuthController::class, 'profile']);

  $app->run();
?>
