<?php

namespace app\controllers;

use app\core\Logger;
use app\dbhandlers\KnivesDB;
class SiteController extends Controller {

  protected Logger $logger;

  // --------------------------------------------------------------------
  public function __construct()
  {
    $this->logger = new Logger(__CLASS__);
  }
  // --------------------------------------------------------------------
  public function home() {
    return $this->render('home');
  }
}

?>