<?php

namespace app\controllers;

use app\core\Logger;
use app\core\Request;
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
  // --------------------------------------------------------------------
  public function getKniveByID() {
    $rq = new Request();
    if($rq->isPost()) {
      $json = file_get_contents('php://input');
      $postdata = json_decode($json, true, 16, JSON_OBJECT_AS_ARRAY | JSON_UNESCAPED_UNICODE);
      $knvmodel = new KnivesModel();
      $knvmodel = $knvmodel->getKniveByID($postdata["kniveid"]);
      var_dump($knvmodel);
    }
  }
  // --------------------------------------------------------------------
  public function getKniveByLabel($label) {
    
  }
}

?>