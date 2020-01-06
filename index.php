<?php
/*$request_method=$_SERVER["REQUEST_METHOD"];

switch($request_method)
	{
		case 'GET':
			echo 'Got a GET';
			break;
  case 'POST':
      echo 'Got a POST';
      break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}*/
header("Clear-Site-Data: *");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Location: site/index.php", true, 301);
exit();

?>