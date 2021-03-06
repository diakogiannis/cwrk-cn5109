<?php
include ('../../site/auth.php');
use com\diakogiannis\phpresteasy\api\core as CORE;
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

require_once (ROOT_PATH.'/api/core/Database.php');
require_once (ROOT_PATH.'/api/core/Properties.php');

$request_method=$_SERVER["REQUEST_METHOD"];

$error_occured = FALSE;
switch($request_method)
{
    case 'POST':
        //lets get the data shall we?
        $reshrs = addslashes($_POST["reshrs"]);


        $database = new CORE\Database();

        if(!empty($reshrs)) {
            $parameters = array("reshrs" => $reshrs);
            $database->executeQuery(
                "update config set config_values = :reshrs where config_key = 'reshrs'",
                $parameters);


            header("Location: ../../site/settings.php");

        }else{
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

?>