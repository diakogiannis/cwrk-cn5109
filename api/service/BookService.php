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
require_once (ROOT_PATH.'/api/core/Utils.php');
require_once (ROOT_PATH.'/api/core/Properties.php');
require_once (ROOT_PATH.'/api/repositories/UserRepository.php');
require_once (ROOT_PATH.'/api/repositories/TableRepository.php');
require_once (ROOT_PATH.'/api/repositories/ReservationRepository.php');

$request_method=$_SERVER["REQUEST_METHOD"];

$error_occured = FALSE;
switch($request_method)
{
    case 'POST':
        //lets get the data shall we?
        $email = addslashes($_POST["email"]);
        $fname = addslashes($_POST["fname"]);
        $lname = addslashes($_POST["lname"]);
        $address = addslashes($_POST["address"]);
        $phone = addslashes($_POST["phone"]);
        $city = addslashes($_POST["city"]);
        $resdatetime = addslashes($_POST["resdatetime"]);
        $persons = addslashes($_POST["persons"]);

        if(empty($email) ||empty($fname) ||empty($lname) ||empty($address) ||empty($city) ||empty($phone)||empty($city)||empty($persons)||empty($resdatetime)){
            header("Location: ../../site/book.php?error=fieldsmissing");
        }else{

            $utils = new CORE\Utils();
            $userRepo = new REPOS\UserRepository();
            $tablesRepo = new REPOS\TableRepository();
            $reservationsRepo = new REPOS\ReservationRepository();

            $date_time_obj = new DateTime($resdatetime);

            $hours = $date_time_obj->format('H:m');

            $date = $date_time_obj->format('Y-m-d');



            if(!$utils->checkWithinHolidays($date) && $utils->checkIfWithinHours($hours)){
                $database = new CORE\Database();


                $user = $userRepo->findById($email);
                $tableList = $tablesRepo->findAllAvailableTablesBySeatsDesc($resdatetime);



                $tablesToOccupy = array();

                $sumOfSeats = 0;

                foreach ($tableList as $table){
                    if($sumOfSeats < $persons){
                        $sumOfSeats = $sumOfSeats + $table["seats"];
                        array_push($tablesToOccupy,$table);
                    }else{
                        break;
                    }
                }

                if($sumOfSeats >= $persons){
                    //KAVATZWSE TA!
                    $reservationsRepo->performReservation($resdatetime,$tablesToOccupy,$persons,$email,$lname,$fname,$phone);
                    header("Location: ../../site/book.php?error=allok");

                }else{
                    //Go back Madam Merkel
                    header("Location: ../../site/book.php?error=notable");
                }


            }else{
                header("Location: ../../site/book.php?error=notworking");
            }



              //  $parameters = array("email"=>$email, "fname"=>$fname, "lname"=>$lname, "address"=>$address, "city"=>$city, "passwordinput"=>$passwordinput);
                //$database->executeQuery(
                  //  "insert into users (email, fname, lname, address, city, password) VALUES (:email,:fname,:lname,:address,:city,:passwordinput)",
                   // $parameters);


        }

        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

?>