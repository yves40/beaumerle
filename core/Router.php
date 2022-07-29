<?php

  namespace app\core;
  
  use app\controllers\ErrorController;
  use app\core\exception\NotFoundException;


  class Router {

    protected array $routes = [];
    public Request $request;
    public Response $response;

    # --------------------------------------------------------------------
    public function __construct(Request $request, Response $response) {
      $this->request = $request;
      $this->response = $response;
    }

    # --------------------------------------------------------------------
    public function get($path, $callback) {
      $this->routes['get'][$path] = $callback;
    }
    # --------------------------------------------------------------------
    public function post($path, $callback) {
      $this->routes['post'][$path] = $callback;
    }
    # --------------------------------------------------------------------
    public function resolve() {
      $path = $this->request->getPath();
      $method = $this->request->method();
      $callback = $this->routes[$method][$path] ?? false;
      if ( $callback === false) {       // Page does not exists
        throw new NotFoundException();
      }
      if (is_string($callback)) {       // Do we have a simple view name ? If so render it
        return $this->renderView($callback);
      }
      if (is_array($callback)) {
        // Remember the array contains a class name and a method name
        // Here we instantiate the requested class and put it in the 1st array position
        // It gives call_user_func the possibility to call the specified method
        $controller = new $callback[0]();
        Application::$app->controller = $controller;
        $controller->action  = $callback[1];  // Set the action in the controller for later use 
                                                                // by middleware layers.
        $callback[0] = $controller;
        // Now check access policy for this action
        foreach($controller->getMiddlewares() as $middleware) {
          $middleware->execute();       
        }
      }
      // Check if we received an array. This should never happen.
      // But in case a rest api call is made without specifying the proper "content-type: application/json"
      // the result would just be an array. Check the getALL() getKniveByID() and getKniveByLabel()
      // methods in the KnivesController class to understand.
      $theresponse = call_user_func($callback, $this->request, $this->response);
      if(is_array($theresponse)) {
        var_dump($theresponse);
        return 'Received an array !!!';
      }
      else {
        return $theresponse;
      }
    }
    # --------------------------------------------------------------------
    public function renderView($view, $params = [], $filetype = 'php') {
      $layoutContent = $this->layoutContent();
      $viewContent = $this->renderOnlyView($view, $params, $filetype);
      return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    # --------------------------------------------------------------------
    protected function layoutContent() {
      $layout = Application::$app->layout;
      if(Application::$app->controller) {   // Controller exists ? 
        $layout = Application::$app->controller->layout;
      }
      ob_start();
      include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
      return ob_get_clean();
    }
    # --------------------------------------------------------------------
    protected function renderOnlyView($view, $params, $filetype) {
      foreach($params as $key => $value) {
        $$key = $value;
      }
      // include is nice because it sees the variables created in the loop !!!
      ob_start();
      include_once Application::$ROOT_DIR."/views/$view.$filetype";
      return ob_get_clean();      
    }
  }
?>