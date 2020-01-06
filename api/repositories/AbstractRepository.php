<?php
namespace com\diakogiannis\phpresteasy\api\repositories;
use com\diakogiannis\phpresteasy\api\core as CORE;
/**
 * @author Alexius Diakogiannis [alexius.diakogiannis@gmail.com]
 * Date: 09/12/18
 * Time: 16:08
 *
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Created by PhpStorm.
 */
require_once __DIR__.'/../../Constants.php';
require_once (ROOT_PATH.'/api/core/Database.php');

/**
 * Abstract class to wrap all common functionality
 * Class AbstractRepository
 * @abstract
 */
abstract class AbstractRepository
{
    private $tableName;
    private $idKey;

    /**
     * AbstractRepository constructor.
     * @param $tableName
     */
    public function __construct($tableName,$idKey=null)
    {
        $this->tableName = $tableName;
        $this->idKey = $idKey;
    }

    public function findAll(){
        $database = new CORE\Database();
        return $database->findAll("select * from ".$this->tableName);
    }

    public function findById($idValue){
        $database = new CORE\Database();
        $params[':'.$this->idKey] = $idValue;
        return $database->findOne("select * from ".$this->tableName." where ".$this->idKey."= :".$this->idKey,$params);
    }

}