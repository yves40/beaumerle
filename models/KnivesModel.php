<?php

namespace App\Models;

use app\core\DbModel;
use app\dbhandlers\KnivesDB;

class KnivesModel
{
    protected $data = [
        "knvid" => '',
        "knvcollectionid" => '',
        "knvlabel" => '',
        "knvstatus" => '',
        "knvprice" => '',
        "knvdesc" => '',
        "knvcomment" => '',
        "knvmanche" => '',
        "knvtotlength" => '',
        "knvbladelenght" => '',
        "knvweight" => '',
        "knvimage" => ''
    ];
    // --------------------------------------------------------------------
    public function __construct($knvid = null)
    {
    }
    // --------------------------------------------------------------------
    public function getAllKnives()
    {
        $kndb = new KnivesDB();
        return $kndb->getKnivesList();
    }
    // --------------------------------------------------------------------
    public function getKniveByID($id)
    {
        $kndb = new KnivesDB();
        $knive = $kndb->getKniveByID($id);
        foreach($knive as $key => $value ) {    // Fill the data array with received values
            $data[$key] = $value;
        }
        return $data;
    }
}

?>