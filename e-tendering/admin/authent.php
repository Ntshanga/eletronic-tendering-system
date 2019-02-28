<?php
if(!isset($_SESSION['userSession'])){
header("Location: index.php");
exit(); }
$query = $DBcon->query("SELECT * FROM admin WHERE adminID=".$_SESSION['userSession']);
$userRow=$query->fetch_array();



?>