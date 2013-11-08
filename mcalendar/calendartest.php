<?PHP
include 'calendar.inc.php';
//Define a new calendar
$cal = new calendar;

/*
Show links to access the previous and next months for month calendar formats, and
links to access the previous and next years for full year calendars.
*/
$cal->displayPrevNextLinks = true;
/*
This section is used when $cal->displayPrevNextLinks is set to true.  The month
section is only needed when displaying month calendars.
*/
if (!empty($_GET['mon'])) {
    $cal->calMonth = $_GET['mon'];
}
if (!empty($_GET['yr'])) {
    $cal->calYear = $_GET['yr'];
}

//Set the calendar format to large month.
$cal->calFormat = "largeMonth";
/*
Show the small calendars for the previous and next months in the header.  This is
only used for large month calendars.
*/
$cal->displayPrevNext = true;
/*
This determines weather events are displayed in the calendar.  For large month
calendars this will display a list of events in the calendar cell for the event
date.  For small month and full year calendars, the date will be highlighted and
the dates will be displayed when you hover the mouse over the day of the event.
*/
$cal->displayEvents = true;

//Tell the class that the week starts on Sunday
$cal->startingDOW = 0;

//Tell the class to show the week numbers.
$cal->showWeek = false;

/*
This will set a few events to test the display.  Any number of events can be added
for display in the calendar.
*/
$cal->addEvent(strtotime("2006-07-05 12:00:00"), "Meet Joe for lunch");
$cal->addEvent(strtotime("2006-07-28 21:00:00"), "Fireworks show in Hatley");
$cal->addEvent(strtotime("2006-07-28 10:00:00"), "Meet with Gerry to work on the server installation for the work order system");
$cal->addEvent(strtotime("2006-07-29 18:00:00"), "Work on programming and testing of the new PHP calendar class");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>calendar class test</title>
</head>

<body>

<?PHP
//Finally, call the function that will display the calendar based on the given options.
$cal->display();
?>

</body>

</html>
