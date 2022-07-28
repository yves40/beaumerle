<?php

namespace app\dbhandlers;

use app\Core\DbModel;
use app\Core\Logger;
use PDO;
use PDOException;

class KnivesDB extends DbModel
{
    private const STATUS_VENDU = ['numcode' => 10, 'numlabel' => 'Vendu'] ;
    private const STATUS_DISPOINTERNET = ['numcode' => 20, 'numlabel' => 'Disponible internet'] ;
    private const STATUS_DISPOSHOP = ['numcode' => 20, 'numlabel' => 'Disponible boutique'] ;
    private const STATUS_ONORDER = ['numcode' => 40, 'numlabel' => 'Sur commande'] ;

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
            $statement = $this->db->prepare('SELECT knvlabel, knvprice, knvdesc FROM bomerle.knives');
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
}

?>