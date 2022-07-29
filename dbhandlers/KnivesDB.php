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
    public function getKnivesList() : array
    {        
        try
        {
            $this->db = DbModel::getInstance();
            $statement = $this->db->prepare('SELECT knvid, knvcollectionid, knvlabel, knvprice, 
                                                    knvdesc, knvimage, knvcollection
                                FROM bomerle.knives AA, bomerle.knivescollections BB
                                WHERE AA.knvcollectionid = BB.knvmodelid
                                ORDER BY AA.knvid');
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
    public function getKniveByID($id) : array
    {
        try
        {
            $this->db = DbModel::getInstance();
            $statement = $this->db->prepare('SELECT knvid, knvcollectionid, knvlabel, 
                                                knvstatus, knvprice, knvdesc, 
                                                knvcomment, knvmanche, knvtotlength, 
                                                knvbladelength, knvweight, knvimage, knvcollection
                                FROM bomerle.knives AA, bomerle.knivescollections BB 
                                WHERE knvid = :1 AND AA.knvcollectionid = BB.knvmodelid' );
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
    public function getKniveByLabel($label) : array
    {
        try
        {
            $this->db = DbModel::getInstance();
            $statement = $this->db->prepare('SELECT knvid, knvcollectionid, knvlabel, 
                                                knvstatus, knvprice, knvdesc, 
                                                knvcomment, knvmanche, knvtotlength, 
                                                knvbladelength, knvweight, knvimage, knvcollection
                        FROM bomerle.knives AA, bomerle.knivescollections BB 
                        WHERE knvlabel = :1 AND AA.knvcollectionid = BB.knvmodelid' );
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