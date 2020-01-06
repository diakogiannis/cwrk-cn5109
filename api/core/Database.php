<?php
namespace com\diakogiannis\phpresteasy\api\core;

/**
 * @package com.diakogiannis.phpresteasy.api.core
 * @author Alexius Diakogiannis [alexius.diakogiannis@gmail.com]
 * Date: 02/12/18
 * Time: 22:55
 *
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Created by PhpStorm.
 */
/**
 * 
 * Create a Mysql connection
 * Class Database
 */
class Database {
    
    private $connection;
    private $stmt;
    private static $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    

    /**
     * Database constructor.
     */
    public function __construct() {
        Properties::getInstance();

        try {
            $this->connection = new \PDO('mysql:host='.Properties::getProperty('db.host').
                ';dbname='.Properties::getProperty('db.name').';charset='.Properties::getProperty('db.charset'),
            Properties::getProperty('db.username'),
            Properties::getProperty('db.password'),
            self::$options);
            $this->connection->exec('set names '.Properties::getProperty('db.charset'));
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
	}

    /**
     * @return PDO
     */
	private function getConnection() {
		return $this->connection;
	}

    public function execute(){
        return $this->stmt->execute();
    }



    /**
     * Brings back all rows of the table
     * @param $sql
     * @param null $params
     * @return array|null
     */
    public function findAll($sql, $params = null){
        $this->stmt = $this->getConnection()->prepare($sql);
        if($params != null) {
            foreach ($params as $key => $value){
                $this->bind($key,$value);
            }
        }
        if($this->execute()) {
            return $this->stmt->fetchAll();
        }else{
            return null;
        }
    }

    /**
     * Brings back first row of the table
     * @param $sql
     * @param null $params
     * @return mixed|null
     */
    public function findOne($sql, $params = null){
        $this->stmt = $this->getConnection()->prepare($sql);
        if($params != null) {
            foreach ($params as $key => $value){
                $this->bind($key,$value);
            }
        }
        if($this->execute()) {
            return $this->stmt->fetch();
        }else{
            return null;
        }
    }

    /**
     * Executes transactionaly a query to the database
     * @param $sql
     * @param null $params
     * @return bool
     */
    public function executeQuery($sql, $params = null){
        $this->stmt = $this->getConnection()->prepare($sql);
        if($params != null) {
            foreach ($params as $key => $value){
                $this->bind($key,$value);
            }
        }
        $this->getConnection()->beginTransaction();
        if($this->execute()) {
            $this->getConnection()->commit();
        }else{
            $this->getConnection()->rollBack();
            return -1;
        }
    }


    /**
     * @param $param
     * @param $value
     * @param null $type
     */
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * object cleanup
     */
    public function __destruct()
    {
        //cleanup
        $this->stmt=null;
        $this->connection=null;
    }

}
?>