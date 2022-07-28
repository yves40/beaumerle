<?php

namespace App\Models;

use app\core\DbModel;
use app\dbhandlers\KnivesDB;

class KnivesModel
{
    protected $knvid;
    protected $knvcollectionid;
    protected $knvlabel;
    protected $knvprice;
    protected $knvdesc;
    protected $knvcomment;
    protected $knvmanche;
    protected $knvtotlength;
    protected $knvbladelenght;
    protected $knvweight;
    protected $knvimage;

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
 
}

?>