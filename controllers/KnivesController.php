<?php

namespace app\controllers;

use app\core\Logger;
use app\models\KnivesModel;

class KnivesController extends Controller {

  protected Logger $logger;
  protected KnivesModel $knvmodel;

  // --------------------------------------------------------------------
  public function __construct()
  {
    $this->logger = new Logger(__CLASS__);
  }
  // --------------------------------------------------------------------
  public function getAll() {

    $knvmodel = new KnivesModel();
    $allknives = $knvmodel->getAllKnives();
    // Some HTTP directives
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    // Build the JSON response
    if($response = json_encode($allknives, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE)) {
      return $response;
    }
    else {
      return json_encode(array());
    }
  }
}

?>