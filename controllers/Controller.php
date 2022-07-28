<?php

namespace app\controllers;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;

class Controller {

  public string $layout = 'main';
  public string $action = '';
  protected array $middlewares = [];

  // ------------------------------------------------------------------------
  public function __construct()
  {
    
  }
  // ------------------------------------------------------------------------
  public function setLayout($layout) {
    $this->layout = $layout;
  }
  // ------------------------------------------------------------------------
  public function render($view, $params = [], $filetype = 'php') {
    return Application::$app->router->renderView($view, $params, $filetype);
  }
  // ------------------------------------------------------------------------
  public function registerMiddleware(BaseMiddleware $middleware) {
    $this->middlewares[] = $middleware;
  }
  // ------------------------------------------------------------------------
  public function getMiddlewares(): array {
    return $this->middlewares;
  }

}

?>