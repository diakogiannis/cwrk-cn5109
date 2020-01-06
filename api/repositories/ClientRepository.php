<?php
namespace com\diakogiannis\phpresteasy\api\repositories;
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
 * Class ClientRepository
 */
class ClientRepository extends AbstractRepository {
    /**
     * ClientRepository constructor.
     */
    public function __construct(){
        parent::__construct("clients","clientid");
    }

}