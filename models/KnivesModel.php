<?php

namespace App\Models;

use app\core\DbModel;
use app\dbhandlers\KnivesDB;

class KnivesModel
{
    public const STATUS_ARRAY = [
        ['numcode' => 10, 'numlabel' => 'Vendu'],
        ['numcode' => 20, 'numlabel' => 'Disponible internet'],
        ['numcode' => 30, 'numlabel' => 'Disponible boutique'],
        ['numcode' => 40, 'numlabel' => 'Sur commande']
    ];
    public const KNIVE_STATUS_VENDU = 10;
    public const KNIVE_STATUS_DISPONET = 20;
    public const KNIVE_STATUS_DISPOSHOP = 30;
    public const KNIVE_STATUS_ONORDER = 40;

    protected $data = [
        "knvid" => '',
        "knvcollectionid" => '',
        "knvlabel" => '',
        "knvstatus" => '',
        "knvstatustext" => '',
        "knvprice" => '',
        "knvdesc" => '',
        "knvcomment" => '',
        "knvmanche" => '',
        "knvtotlength" => '',
        "knvbladelenght" => '',
        "knvweight" => '',
        "knvimage" => '',
        "knvcollection" => ''
    ];
    // --------------------------------------------------------------------
    public function __construct($knvid = null)
    {
    }
    // --------------------------------------------------------------------
    public function getAllKnives() : array
    {
        $kndb = new KnivesDB();
        return $kndb->getKnivesList();
    }
    // --------------------------------------------------------------------
    public function getKniveByID($id) : array
    {
        $kndb = new KnivesDB();
        $knive = $kndb->getKniveByID($id);
        foreach($knive as $key => $value ) {    // Fill the data array with received values
            $data[$key] = $value;
        }
        $data["knvstatustext"] = $this->getTextStatus(intval($data["knvstatus"]));
        return $data;
    }
    // --------------------------------------------------------------------
    public function getKniveByLabel($label) :array
    {
        $kndb = new KnivesDB();
        $knive = $kndb->getKniveByLabel($label);
        foreach($knive as $key => $value ) {    // Fill the data array with received values
            $data[$key] = $value;
        }
        $data["knvstatustext"] = $this->getTextStatus(intval($data["knvstatus"]));
        return $data;
    }
    // --------------------------------------------------------------------
    public function getTextStatus($statuscode) : string
    {
        foreach(self::STATUS_ARRAY as $key => $value) {
            if($value["numcode"] === $statuscode) {
                return $value["numlabel"];
            }
        }
        return '';
    }
}

?>