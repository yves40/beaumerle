<?php

  namespace app\core;
  use app\controllers\Controller;
  use app\core\DbModel;
  use Exception;

  class Application 
  {
    public static string $ROOT_DIR;

    public string $layout = 'main';
    public string $userClass;   // class name of the user object. Retrieved from a config file
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public static Application $app;
    public ?Controller $controller = null;
    public DbModel $db;
    public $copyright = COPYRIGHT;

    private $config = [
      'userClass' => UserModel::class,
      'db' => [
        'dsn' => 'mysql:localhost;port=3306;dbname=mvcfr',
        'user' => 'root',
        'password' => 'root'      
      ],
    ];

    //-----------------------------------------------------------------------------
    public function __construct($rootPath) {
      $this->userClass = $this->config['userClass'];  // What's the user class name ?
      self::$ROOT_DIR = $rootPath;
      self::$app = $this;
      $this->request = new Request(); 
      $this->response = new Response();
      $this->session = new Session();
      $this->router = new Router($this->request, $this->response);
      $this->db = new DbModel($this->config['db']);

      // Now manage the user session
      // First find what is the user class name. This must be configurable because the application 
      // class is in the core namespace and all core classes must be generic.
      // So here you cannot refer directly to the User class
      $primaryValue = $this->session->get('user');
      if ($primaryValue) {
        $primaryKey = $this->userClass::primaryKey();
        $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
      }
      else {
        $this->user = null;   // Not logged
      }
    }
    //-----------------------------------------------------------------------------
    // Called after each php request to the apache server
    // Dispatches the request to the Router loaded with a routes table by the 
    // index.php program.
    //-----------------------------------------------------------------------------
    public function run() {
      try {
        echo $this->router->resolve();
      }
      catch(Exception $e) {
        $this->response->setStatusCode($e->getCode());
        echo $this->router->renderView('_error', [ 'exception' => $e]);
      }
    }
    //-----------------------------------------------------------------------------
    public function login() {
      return $this->controller;
    }
    //-----------------------------------------------------------------------------
    public function logout() {
      return $this->controller;
    }
    //-----------------------------------------------------------------------------
    public function getController() {
      return $this->controller;
    }
    //-----------------------------------------------------------------------------
    public function setController(Controller $cont) {
      $this->controller = $cont;
    }
  }
?>