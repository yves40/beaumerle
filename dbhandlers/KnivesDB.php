<?php

namespace app\dbhandlers;

use app\Core\DbModel;
use app\Core\Logger;
use PDO;
use PDOException;

class KnivesDB extends DbModel
{
    private Logger $logger;
    // ----------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->logger = new Logger(__CLASS__);
    }
    // ----------------------------------------------------------------------------------------------
    public function getKnivesList()
    {        
        try
        {
            $this->db = DbModel::getInstance();
            $statement = $this->db->prepare('SELECT knvid, knvcollectionid, knvlabel, knvprice, knvdesc, knvimage FROM bomerle.knives');
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;  // Data array 
        }
        catch(PDOException $e)
        {
            $this->logger->console($e->getMessage());
            return array();
        }       
    }
    // --------------------------------------------------------------------
    public function getKniveByID($id) {
        try
        {
            $this->db = DbModel::getInstance();
            $statement = $this->db->prepare('SELECT knvid, knvcollectionid, knvlabel, 
                                                knvstatus, knvprice, knvdesc, 
                                                knvcomment, knvmanche, knvtotlength, 
                                                knvbladelength, knvweight, knvimage
                        FROM bomerle.knives WHERE knvid = :1' );
            $statement->bindValue(':1', $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;  // Data array 
        }
        catch(PDOException $e)
        {
            $this->logger->console($e->getMessage());
            return array();
        }       
    }
    // --------------------------------------------------------------------
    public function getKniveByLabel($label) {
        try
        {
            $this->db = DbModel::getInstance();
            $statement = $this->db->prepare('SELECT knvid, knvcollectionid, knvlabel, 
                                                knvstatus, knvprice, knvdesc, 
                                                knvcomment, knvmanche, knvtotlength, 
                                                knvbladelength, knvweight, knvimage
                        FROM bomerle.knives WHERE knvlabel = :1' );
            $statement->bindValue(':1', $label);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;  // Data array 
        }
        catch(PDOException $e)
        {
            $this->logger->console($e->getMessage());
            return array();
        }       
    }
}

?>