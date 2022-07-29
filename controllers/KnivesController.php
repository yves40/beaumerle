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
  // If receiving a non JSON request the an array is sent back
  // --------------------------------------------------------------------
  public function getAll() {
    $this->setRequestFormat();      // Check request and response are JSON formatted
    $knvmodel = new KnivesModel();
    $allknives = $knvmodel->getAllKnives();
    return $this->sendResponse($allknives);  // Send the response in proper format
  }
  // --------------------------------------------------------------------
  // Retrieve One knive by ID : JSON request, JSON response
  // If receiving a non JSON request the an array is sent back
  // --------------------------------------------------------------------
  public function getKniveByID() {
    $this->setRequestFormat();      // Check request and response are JSON formatted
    $rq = new Request();
    if($rq->isPost()) {
      $postdata = $this->decodePostRequest();
      $knvmodel = new KnivesModel();
      $knvmodel = $knvmodel->getKniveByID($postdata["kniveid"]);
    }
    return $this->sendResponse($knvmodel);  // Send the response in proper format
  }
  // --------------------------------------------------------------------
  // Retrieve One knive by Label : JSON request, JSON response
  // If receiving a non JSON request the an array is sent back
  // --------------------------------------------------------------------
  public function getKniveByLabel($label) 
  {
    $this->setRequestFormat();      // Check request and response are JSON formatted
    $rq = new Request();
    if($rq->isPost()) {
      $postdata = $this->decodePostRequest();
      $knvmodel = new KnivesModel();
      $knvmodel = $knvmodel->getKniveByLabel($postdata["knivelabel"]);
    }
    return $this->sendResponse($knvmodel);  // Send the response in proper format
  }
}

?>