<?php
namespace com\diakogiannis\phpresteasy\api\services;
use com\diakogiannis\phpresteasy\api\repositories as REPOS;
/**
 * @author Alexius Diakogiannis [alexius.diakogiannis@gmail.com]
 * Date: 09/12/18
 * Time: 16:58
 *
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Created by PhpStorm.
 */
require_once __DIR__.'/../../Constants.php';
require_once (ROOT_PATH.'/api/repositories/ClientRepository.php');

/**
 * Class ClientsService
 */
class ClientsService
{
    /**
     * retrieves clients
     * @param null $id
     * @return array|mixed|null
     */
    public function getClients($id=null){
        $cr = new REPOS\ClientRepository();
        if($id != null){
            return $cr->findById($id);
        }else {
            return $cr->findAll();
        }
    }
}