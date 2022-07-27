<?php

namespace app\controllers;

use app\core\Logger;
class SiteController extends Controller {

  # --------------------------------------------------------------------
  public function home() {
    return $this->render('home');
  }
  # --------------------------------------------------------------------
  public function phptest() {
    $logger = new Logger(__CLASS__);
    return 'Hello Mr PHP';
    //return $this->render('home');
  }
}

?>