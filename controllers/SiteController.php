<?php

namespace app\controllers;

use app\core\Logger;
use app\dbhandlers\KnivesDB;
class SiteController extends Controller {

  # --------------------------------------------------------------------
  public function home() {
    return $this->render('home');
  }
  # --------------------------------------------------------------------
  public function phptest() {
    $logger = new Logger(__CLASS__);
    $logger->console('Get all knives');
    $knvdb = new KnivesDB();
    $allknives = $knvdb->getKnivesList();
    if(!empty($allknives)) {
      foreach($allknives as $record) {
        $logger->console('Knife label '.$record['knvlabel'].' € '.$record['knvprice'].' : '.$record['knvdesc']);
      }
    }
    // Some HTTP directives
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    // Build the JSON response
    if($response = json_encode($allknives, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE)) {
      return $response;
    }
    else {
      return json_encode([]);
    }
  }
}

?>