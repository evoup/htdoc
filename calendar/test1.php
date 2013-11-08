<?PHP
include 'calendar.inc.php';
//Define a new calendar
$cal = new calendar;
/*
Show links to access the previous and next months for month calendar formats, and
links to access the previous and next years for full year calendars.
*/
$cal->displayPrevNextLinks = true;
$cal->outputFormat = 'return';
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
$cal->calFormat = "smallMonth";
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
$cal->addEvent(strtotime("2007-01-01 00:00:00"), "元旦放假第二日");
$cal->addEvent(strtotime("2007-01-02 00:00:00"), "元旦放假第三日");
$cal->addEvent(strtotime("2007-01-08 10:34:00"), "【信息化建设】完成了首页的日程表,真是忙啊，昨天4点睡的-_-!");
$cal->addEvent(strtotime("2007-01-12 8:30:00"), "【信息化建设】准时交出内网和报告!");
$cal->addEvent(strtotime("2007-03-26 16:18:00"), "【信息化建设】设计解决配料的实际问题的方案。");
$cal->addEvent(strtotime("2007-03-27 8:45:00"), "今日无线路由器的方案拿来试验");
$cal->addEvent(strtotime("2008-01-12 1:30:00"), "快点做出来了，好给介绍人交差！");
//Finally, call the function that will display the calendar based on the given options.
$calins=$cal->display();
//echo $calins;
?>


