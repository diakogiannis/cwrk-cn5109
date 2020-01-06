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
        $vacstart = addslashes($_POST["vacstart"]);
        $vacend = addslashes($_POST["vacend"]);

        $datestart=date("Y-m-d",strtotime($vacstart));
        $dateend=date("Y-m-d",strtotime($vacend));

        $database = new CORE\Database();

        if(!empty($datestart) && !empty($dateend)) {
            $parameters = array("datestart" => $datestart, "dateend" => $dateend);
            $database->executeQuery(
                "insert into holidays (h_start, h_finish) VALUES (:datestart,:dateend)",
                $parameters);


            header("Location: ../../site/settings.php");

        }else{
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
        }
        break;
    case 'GET':
        //lets get the data shall we?
        $hid = addslashes($_GET["hid"]);
        $database = new CORE\Database();

        if(!empty($hid)) {
            $parameters = array("hid" => $hid);
            $database->executeQuery(
                "delete from holidays where hid=:hid",
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