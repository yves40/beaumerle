<?php

namespace App\Models;

use App\Core\Model;
use App\dbhandlers\UsersDB;

class KnivesCollectionsModel extends Model
{
    protected $knvmodelid;
    protected $knvcollection;
    // --------------------------------------------------------------------
    public function __construct($knvid = null)
    {
            parent::__construct();
    }
    
}

?>