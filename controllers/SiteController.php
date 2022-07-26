<?php

namespace app\controllers;
use app\core\Request;

class SiteController extends Controller {

  # --------------------------------------------------------------------
  public function home() {
    return $this->render('home');
  }
  # --------------------------------------------------------------------
  public function contact() {
    return $this->render('contact');
  }
  # --------------------------------------------------------------------
  public function basic() {
    $this->setLayout('auth');
    return $this->render('basicpage', [], 'html');
  }
  # --------------------------------------------------------------------
  public function handleContact(Request $request) {
    $body = $request->getBody();
    return 'handle contact form submission';
  }

}

?>