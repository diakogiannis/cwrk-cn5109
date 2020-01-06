<?php
namespace com\diakogiannis\phpresteasy\api\web;
use com\diakogiannis\phpresteasy\api\services as SERVICE;
/**
 * @author Alexius Diakogiannis [alexius.diakogiannis@gmail.com]
 * Date: 09/12/18
 * Time: 16:40
 *
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Created by PhpStorm.
 */

require_once ('AbstractRestController.php');
require_once (ROOT_PATH.'/api/service/ClientsService.php');
/**
 * REST controller for Clients
 * Class Clients
 */
class Clients extends AbstractRestController {

    /**
     * @param null $id
     * @return array|mixed|null
     */
    public static function get($id=null){
        $cs =  new SERVICE\ClientsService();
        if ($id!=null){
            return $cs->getClients();
        }else{
            return $cs->getClients($id);
        }
    }

}

$request_method=$_SERVER["REQUEST_METHOD"];

switch($request_method)
{
    case 'GET':
        Clients::flushJSONContent(Clients::get());
        break;
    case 'POST':
        echo 'Got a POST';
        break;
    default:
        // Invalid Request Method
        header(HEADER_405);
        break;
}
