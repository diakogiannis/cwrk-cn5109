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
var_dump($request_method);
switch($request_method)
{
    case 'POST':
        //lets get the data shall we?
        $email = addslashes($_POST["email"]);
        $passwordinput = addslashes($_POST["passwordinput"]);

        if(empty($email)||empty($passwordinput)){
            // something went bad, hacker? Anyway die!
            http_response_code(403);
            die('Forbidden');
        }else{
            $database = new CORE\Database();

            $ur = new REPOS\UserRepository();

            $parameters = array("email"=>$email, "passwordinput"=>$passwordinput);
            $user = $database->findAll("select count(*) as cnt from users where email = :email and password = :passwordinput",$parameters);

           if($user[0]['cnt'] == 1){
               if(!isset($_SESSION))
               {
                   session_start();
               }

               $_SESSION['login_user']= $email;
               $_SESSION['loggedin']= 'yep';

               $parameters = array("email"=>$email);
               $role = $database->findAll("select role_id from user_roles ur inner join users u on ur.email = u.email where u.email = :email",$parameters);
               $_SESSION['role']= $role[0]['role_id'];


               header("Location: ../../site/index.php");
           }else{
               header("Location: ../../site/login.php?error=loginerror");
           }

        }

        break;
    default:
        // Invalid Request Method
        header(
            "HTTP/1.0 405 Method Not Allowed");
        break;
}

?>