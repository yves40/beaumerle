<?php

namespace app\controllers;

use app\core\Logger;
use app\core\Request;
use app\core\Response;
use app\models\KnivesModel;

class KnivesController extends Controller {

  protected Logger $logger;
  protected KnivesModel $knvmodel;

  // --------------------------------------------------------------------
  public function __construct()
  {
    $this->logger = new Logger(__CLASS__);
    parent::__construct();
  }
  // --------------------------------------------------------------------
  // Retrieve all knives : JSON request, JSON response
  // --------------------------------------------------------------------
  public function getAll() {
    $an = new Response(); $an->setJsonFormat();
    $knvmodel = new KnivesModel();
    $allknives = $knvmodel->getAllKnives();
    // Build the JSON response
    if($response = json_encode($allknives, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE)) {
      return $response;
    }
    else {
      return json_encode(array());
    }
  }
  // --------------------------------------------------------------------
  // Retrieve One knive by ID : JSON request, JSON response
  // --------------------------------------------------------------------
  public function getKniveByID() {
    $an = new Response(); $an->setJsonFormat();
    $rq = new Request();
    if($rq->isPost()) {
      $json = file_get_contents('php://input');
      $postdata = json_decode($json, true, 16, JSON_OBJECT_AS_ARRAY | JSON_UNESCAPED_UNICODE);
      $knvmodel = new KnivesModel();
      $knvmodel = $knvmodel->getKniveByID($postdata["kniveid"]);
      if($response = json_encode($knvmodel, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE)) {
        return $response;
      }
      else {
        return json_encode(array());
      }
      }
  }
  // --------------------------------------------------------------------
  // Retrieve One knive by Label : JSON request, JSON response
  // --------------------------------------------------------------------
  public function getKniveByLabel($label) 
  {
    $rq = new Request();
    $an = new Response(); $an->setJsonFormat();
    if($rq->isPost()) {
      $json = file_get_contents('php://input');
      $postdata = json_decode($json, true, 16, JSON_OBJECT_AS_ARRAY | JSON_UNESCAPED_UNICODE);
      $knvmodel = new KnivesModel();
      $knvmodel = $knvmodel->getKniveByLabel($postdata["knivelabel"]);
    }
    if($response = json_encode($knvmodel, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE)) {
      return $response;
    }
    else {
      return json_encode(array());
    }
  }
}

?>