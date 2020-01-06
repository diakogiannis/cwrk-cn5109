<?php
namespace com\diakogiannis\phpresteasy\api\repositories;
include ('../../site/auth.php');
use com\diakogiannis\phpresteasy\api\core as CORE;

/**
 * @author Alexius Diakogiannis [alexius.diakogiannis@gmail.com]
 * Date: 09/12/18
 * Time: 16:02
 *
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Created by PhpStorm.
 */
require_once __DIR__.'/../../Constants.php';
require_once (ROOT_PATH.'/api/repositories/AbstractRepository.php');

/**
 * Class TableRepository
 */
class TableRepository extends AbstractRepository {

    private $tableName = "tables";
    private $tableId = "table_number";

    /**
     * TableRepository constructor.
     */
    public function __construct(){
        parent::__construct($this->tableName,$this->tableId);
    }

    /**
     * @return mixed
     */
    public function findAllTablesBySeatsDesc(){
        $database = new CORE\Database();
        return $database->findAll("select * from tables order by seats desc");
    }

    /**
     * @return mixed
     */
    public function findAllAvailableTablesBySeatsDesc($resdate){
        $database = new CORE\Database();
        return $database->findAll("select t.table_number, t.seats from tables t left join reservations_tables rt  on t.table_number = rt.table_number left join reservations r on rt.reservations_id = r.id where  (reservation_date  > DATE_ADD('".addslashes($resdate)."', INTERVAL -2 HOUR) AND reservation_date < DATE_ADD('".addslashes($resdate)."', INTERVAL 2 HOUR)) or (reservation_date is null) order by t.seats desc");
    }


}