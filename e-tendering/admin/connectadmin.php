<?php
session_start();

  $DBhost = "localhost";
  $DBuser = "root";
  $DBpass = "0705814794";
  $DBname = "e_tendering";

  define('DIR','http://127.0.0.1/e-tendering/');
define('E-Tender','noreply@domain.com');
  
  $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
     if ($DBcon->connect_errno) {
         die("ERROR : -> ".$DBcon->connect_error);

     }

include('../core/phpmailer/mail.php');
include('AfricasTalkingGateway.php');

?>
