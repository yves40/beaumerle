<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\core\middlewares\BaseMiddleware;

class Controller {

  public string $layout = 'main';
  public string $action = '';
  protected array $middlewares = [];
  protected bool $isjsonrequest = false;

  // ------------------------------------------------------------------------
  public function __construct()
  {
    $rq = new Request();
    $this->isjsonrequest = $rq->isJSON();  // Check if the request is made in JSON format
  }
  // ------------------------------------------------------------------------
  public function setLayout($layout) {
    $this->layout = $layout;
  }
  // ------------------------------------------------------------------------
  public function redirect($path) {
    Application::$app->response->redirect($path);
  }
  // ------------------------------------------------------------------------
  // All PHP pages served by Apache are using this method, which calls the 
  // instanciated router object renderView() method publicly accessible in the 
  // application object.
  // ------------------------------------------------------------------------
  public function render($view, $params = [], $filetype = 'php') {
    return Application::$app->router->renderView($view, $params, $filetype);
  }
  // ------------------------------------------------------------------------
  // The authorization method
  // ------------------------------------------------------------------------
  public function registerMiddleware(BaseMiddleware $middleware) {
    $this->middlewares[] = $middleware;
  }
  // ------------------------------------------------------------------------
  // Queries the available middlewares ( security check )
  // ------------------------------------------------------------------------
  public function getMiddlewares(): array {
    return $this->middlewares;
  }
  // ------------------------------------------------------------------------
  // Check if the request is made in JSON format to inform the child controller
  // ------------------------------------------------------------------------
  public function setRequestFormat() {
    if($this->isjsonrequest) {
      $resp = new Response(); 
      $resp->setJsonFormat();
    }
  }
  // ------------------------------------------------------------------------
  // Get the payload from the JSON formatted post request
  // ------------------------------------------------------------------------
  public function decodePostRequest() : array {
    $json = file_get_contents('php://input');
    return json_decode($json, true, 16, JSON_OBJECT_AS_ARRAY | JSON_UNESCAPED_UNICODE);
  }
  // ------------------------------------------------------------------------
  // Send a response back, either in JSON format or just as an array
  // ------------------------------------------------------------------------
  public function sendResponse($payload) {
    if($this->isjsonrequest) { // Build the JSON response ?
      if($response = json_encode($payload, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE)) {
        return $response;
      }
        return json_encode(array());
    }
    else { // Standard response array format
      if(!empty($payload)) {
        return $payload;
      }
      return array();
    }
  }
}

?>