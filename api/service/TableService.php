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
        if(isset($_POST['ic']) && $_POST['ic'] == 'Yes'){
            $ic=1;
        }else{
            $ic=0;
        }

        $seats = addslashes($_POST["seats"]);



        $database = new CORE\Database();

        if(!empty($seats)) {
            $parameters = array("seats" => $seats);
            $database->executeQuery(
                "insert into tables (seats) VALUES (:seats);",
                $parameters);


            header("Location: ../../site/tables.php");

        }else{
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
        }
        break;
    case 'GET':
        //lets get the data shall we?
        $tn = addslashes($_GET["tn"]);
        $database = new CORE\Database();

        if(!empty($tn)) {
            $parameters = array("tn" => $tn);

            //delete constrains
            $reservations = $database->findAll("select r.id as rid from reservations r inner join reservations_tables rt on r.id = rt.reservations_id where rt.table_number = :tn",  $parameters);

            $database->executeQuery(
                "delete from reservations_tables where table_number = :tn",
                $parameters);

            foreach($reservations as $reservation) {

                $param=array("id"=>$reservation['id']);

                $database->executeQuery(
                    "delete from reservations where id=:id",
                    $param);
            }

            $database->executeQuery(
                "delete from tables where table_number=:tn",
                $parameters);


            header("Location: ../../site/tables.php");

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