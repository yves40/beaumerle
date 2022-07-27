<?php

namespace App\Core;

// On "immporte" PDO
use PDO;
use PDOException;

class Db extends PDO
{
    // Instance unique de la classe ( singleton ? )
    private static $instance;
    // Informations de connexion
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = 'root';
    private const DBNAME = 'bomerle';
    // ----------------------------------------------------------------------------------------------
    public function __construct()
    {
        $_dsn = 'mysql:dbname='.self::DBNAME.';host='.self::DBHOST.';charset=utf8';
        try
        {
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) 
        {
            die($e->getMessage());
        }
    }
    // ----------------------------------------------------------------------------------------------
    public static function getInstance():self
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

?>