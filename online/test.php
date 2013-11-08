<?php

include('UsersOnline3.php');
//初始化类
$ol = new UsersOnline(false);

//get rid of the old records
$ol->refresh();

//who is at my site?

//这只是为了用addvisitor方法-_-!
//ADDING A USER, NO REPORTING
$ol = new UsersOnline(true);
$ol->printNumber("site");
//who is at this page?
$ol->printNumber("myPage.php");
?>