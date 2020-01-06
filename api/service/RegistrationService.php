<?php
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
require_once (ROOT_PATH.'/api/repositories/UserRepository.php');

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
        $passwordinput = addslashes($_POST["passwordinput"]);

        if(empty($email) ||empty($fname) ||empty($lname) ||empty($address) ||empty($city) ||empty($passwordinput)||empty($phone)){
            header("Location: ../../site/registration.php?error=fieldsmissing");
        }else{
            $database = new CORE\Database();

            $ur = new REPOS\UserRepository();

            $user = $ur->findById($email);

            if(empty($user)){
                $parameters = array("email"=>$email, "fname"=>$fname, "lname"=>$lname, "address"=>$address, "city"=>$city, "passwordinput"=>$passwordinput);
                $database->executeQuery(
                    "insert into users (email, fname, lname, address, city, password) VALUES (:email,:fname,:lname,:address,:city,:passwordinput)",
                    $parameters);

                //insert contact details
                $parameters = array("email"=>$email, "type"=>"PHONE", "value"=>$phone);
                $database->executeQuery(
                "insert into user_contact_details (email, type, value) VALUES (:email,:type,:value)",
                    $parameters);

                //insert roles
                $parameters = array("email"=>$email, "role_id"=>"CLIENT");
                $database->executeQuery(
                    "insert into user_roles (email, role_id) VALUES (:email,:role_id)",
                    $parameters);
                if(!isset($_SESSION))
                {
                    session_start();
                }

                $_SESSION['login_user']= $email;
                $_SESSION['loggedin']= 'yep';
                $_SESSION['role']= 'CLIENT';
                header("Location: ../../site/index.php");
            }else{
                header("Location: ../../site/registration.php?error=userexists");
            }


        }

        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

?>