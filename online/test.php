<?php

include('UsersOnline3.php');
//��ʼ����
$ol = new UsersOnline(false);

//get rid of the old records
$ol->refresh();

//who is at my site?

//��ֻ��Ϊ����addvisitor����-_-!
//ADDING A USER, NO REPORTING
$ol = new UsersOnline(true);
$ol->printNumber("site");
//who is at this page?
$ol->printNumber("myPage.php");
?>