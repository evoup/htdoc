<?php
	
	//You can use mysql and sqlite database. For it is easy to use database wrapper classes
	//Please get IT FROM http://www.phpclasses.org/browse/package/2021.html
	//And uncommnet the db statements from the CALEVENT class

	include("calevents.inc.php");

	$host="localhost";
	$user='root';
	$password="getter";
	$database='jzoa';

	$cal=new CALEVENTS();
	$cal->setInfo($host,$user,$password,$database);
	// OR $cal=new CALEVENTS($host,$user,$password,$database);
	
	//Add event
	$event="This is fourth event";
	$cal->addEvent($event,'2005-03-27');

	//Update event
	//$event="This is updated fourth event";
	//$cal->updateEvent(10,$event);

	//Delete Event
	//$cal->delEvent(1);
	// OR $cal->delEvent("1,4,6");

	$cal->drawCalendar();

?>