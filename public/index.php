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
  use app\models\UserModel;
  use app\core\Logger;


  define('ROOT', dirname(__DIR__));
  define('IMAGEROOT', '/images/profile_pictures/');
  define('DEFAULTIMAGE', 'defaultuserpicture.png');
  define('COPYRIGHT', '© Beaumerle by ratoon : Jul 27 2022, 1.17');
  define('APPTITLE', 'BoMerle-MVC');

  require_once __DIR__.'/../vendor/autoload.php';

  $logger = new Logger(__CLASS__);
  $logger->console('Get there');
  $app = new Application(dirname(__DIR__));
  
  // Register a class and a method for the controller to call it
  $app->router->get('/', [siteController::class, 'home']);

  $app->run();
?>
