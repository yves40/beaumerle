<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\models\UsersModel;
use app\models\loginModel;
use app\core\middlewares\AuthMiddleware;

class AuthController extends Controller {

  // ------------------------------------------------------------------------
  public function __construct() {
    $this->registerMiddleware(new AuthMiddleware(['profile']));     // A middleware is a class mediating access to any controller
  }

  // ------------------------------------------------------------------------
  public function login(Request $request, Response $response) {
    $this->setLayout('auth');
    $loginModel = new loginModel();
    if($request->isPost() ) {
      $loginModel->loadData($request->getBody());
      if($loginModel->validate() && $loginModel->login()) {
        $response->redirect('/');
        return;
      }
    }
    return $this->render('login', [ 'model' => $loginModel ]);
  }

  // ------------------------------------------------------------------------
  public function register( Request $request) {

    $this->setLayout('auth');
    $usermodel = new UsersModel();
    if($request->isPost() ) {
      /*
      $usermodel->loadData($request->getBody());
      if($usermodel->validate() && $usermodel->save()) {
        // Before redirecting, put a message in a session store
        // Message life will be 1 request
        Application::$app->session->setFlash('success', 'Successfully register');
        Application::$app->response->redirect('/');
      }
      */
      return $this->render('register', [ 'model' => $usermodel]);
    }
    return $this->render('register', [ 'model' => $usermodel]);
  }
  // ------------------------------------------------------------------------
  public function JregisterUser( ) {

  }
  // ------------------------------------------------------------------------
  public function logout(Request $request, Response $response) {
    Application::$app->logout();
    $response->redirect('/');
  }
  // ------------------------------------------------------------------------
  public function profile() {
    return $this->render('profile');
  }  // ------------------------------------------------------------------------
  public function edit( Request $request) {
  }
}