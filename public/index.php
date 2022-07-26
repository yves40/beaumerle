<?php

  use app\core\Application;
  use app\controllers\SiteController;
  use app\controllers\AuthController;
  use app\models\UserModel;

  require_once __DIR__.'/../vendor/autoload.php';

  // See https://github.com/vlucas/phpdotenv for explanations
  
  $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
  $dotenv->load();

  $config = [
    'userClass' => UserModel::class,
    'db' => [
      'dsn' => $_ENV['DB_DSN'],
      'user' => $_ENV['DB_USER'],
      'password' => $_ENV['DB_PASSWORD']      
    ],
    'copyright' => '© MVCFR by tono : Jul 14 2022, 1.15'
  ];
  
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

  $app->router->get('/tonologin', [AuthController::class, 'tonologin']);
  $app->router->post('/tonologin', [AuthController::class, 'tonologin']);
  $app->router->get('/tonoregister', [AuthController::class, 'tonoregister']);
  $app->router->post('/tonoregister', [AuthController::class, 'tonoregister']);

  $app->run();
?>
