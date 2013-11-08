<?PHP
define('IN_EVP', true);
ob_start();
include 'calendar.inc.php';
include("../include/dbclass.php");
include("../include/session_mysql.php");
include("../include/common.php");
session_start();
include("../include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index(1);
die("");
//die("你没有权限进入本栏目!");
}






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
$cal->displayPrevNext = false;
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
$cal->showWeek = true;

/*
This will set a few events to test the display.  Any number of events can be added
for display in the calendar.
*/
$cal->addEvent(strtotime("2007-01-08 23:00:00"), "【信息组】完成了日程表");
$cal->addEvent(strtotime("2007-01-08 11:03:00"), "【信息组】本周解决内网一期，下周着手配料");
$cal->addEvent(strtotime("2007-01-09 11:03:00"), "【信息组】本周解决内网一期，下周着手配料");
$cal->addEvent(strtotime("2007-03-22 11:03:00"), "再加任务，看完要写计划，然后接待网站制作外包的人员,领导给了几天时间准备<br>&nbsp;&nbsp;许忠宝的机器设置了下交他使用IP192.168.0.160无上网权限；去给销售厂长装杀毒，10分钟；13：05帮周徐的机器看了看，花了5分种<br>&nbsp;&nbsp;料宽表先这样，等等改，明日就去整理全套思路");
$cal->addEvent(strtotime("2007-03-26 16:22:00"), "【信息组】黄宏江的台式机掉给徐春花，徐春花的老机器封存,冯工的机器系统坏了，给他看看能不能装个Xp,给董峰的机器安排了下，ip:192.168.0.161,用户名：董峰，密码：878685,隶属于：销售三部；今天顺便把采购部那里的网线上标记了一下<br>&nbsp;&nbsp;下午弄线的时候发生了次部分网线接在采购部交换机的机器无法访问文件服务器的事情，樊老师是可能因为是交线网线记忆的关系，给交换器重新启动下，果然可以了，证明是因为路由器的问题。");
$cal->addEvent(strtotime("2007-03-27 10:44:00"), "领导问电脑公司弄了个无线路由器先在单位试验，我这里就直接将无线路由器当一个带DHCP功能的交换机用，接法和交换器一样，下面找时间设置安全参数和看看代理是否工作正常就可以了，等领导机器空了再搞吧");
$cal->addEvent(strtotime("2008-01-13 22:30:00"), "快点做出来了，好给介绍人交差！");
$cal->addEvent(strtotime("2008-01-14 23:30:00"), "快点做出来了，好给介绍人交差！");
$cal->addEvent(strtotime("2008-01-14 23:30:00"), "快点做出来了，好给介绍人交差！");
$cal->addEvent(strtotime("2008-01-14 23:30:00"), "快点做出来了，好给介绍人交差！");
$cal->addEvent(strtotime("2008-01-14 23:30:00"), "快点做出来了，好给介绍人交差！");
$cal->addEvent(strtotime("2008-01-14 23:30:00"), "快点做出来了，好给介绍人交差！");
$cal->addEvent(strtotime("2008-01-14 23:30:00"), "快点做出来了，好给介绍人交差！");
$cal->addEvent(strtotime("2008-03-11 23:32:00"), "一定更多的赞美，更多的激励，一定了以搞定，没有问题！");
$strc='学习draupal还是xoops，还是ecshop，我想认准了一个就不要放弃，否则就是失败！';
$cal->addEvent(strtotime("2008-03-14 9:17:00"), $strc);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<style type="text/css">
<!--
.divpain{margin:5px 1px 0px 1px;padding:10px 5px 10px 5px;background-color: white;border:1px solid #3366CC;font-size: 12px;}
-->
</style>
  <title>日历</title>
</head>

<body bgcolor=#E3EEF4>
<p style='margin-top:10px;'><div class='divpain'>位置：日程管理 -> 公司行事历<span class="action-span"><a href="goods.php?act=add">新增日程安排</a></span></div></p> 
<?PHP
//Finally, call the function that will display the calendar based on the given options.
$cal->display();
?>

</body>

</html>
