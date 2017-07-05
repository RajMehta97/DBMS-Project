<?php 


   // delete cookies, if any
    setcookie("booking_id", "", time() - 7200);
    setcookie("customer_id", "", time() - 7200);
	
	echo "I HAD COME HERE IN EXIT TO MAIN PHP" ;
	 $host = $_SERVER["HTTP_HOST"];
     $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
     header("Location: http://$host$path/index.php");
     exit;
	 
	 setcookie(session_name(), "", time() - 3600);
	
    session_destroy();
	 
?>
	 
	 