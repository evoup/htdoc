<?php
$bd="test";
$user="root";
$pass="jysysadmin";
$host="127.0.0.1";

 $link = mysql_connect($host, $user, $pass )
   or die ("Could not connect to MySQL");
 mysql_select_db ($bd)
   or die ("Could not select database");
   php?>
