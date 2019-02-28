<?php
ob_start();
session_start();

//set timezone


//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','0705814794');
define('DBNAME','e_tendering');

//application address
define('DIR','http://127.0.0.1/e-tendering/');
define('E-Tender','noreply@domain.com');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('core/user.php');
include('core/phpmailer/mail.php');
$user = new User($db);
?>
