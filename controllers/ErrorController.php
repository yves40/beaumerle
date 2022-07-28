<?php

namespace app\controllers;
use app\core\Request;

class ErrorController extends Controller {

  public function __construct() {
    $this->setLayout('error');
    parent::__construct();
  }  
}