<?php
include("include/session_mysql.php");
session_start();
$_SESSION['name']='yinjia';
echo $_SESSION['name'];

?>