<?php
define('IN_EVP', true);
ob_start();
//error_reporting(E_CORE_ERROR);

//require_once('datatoxml/fungsi.dwt.php');

include("include/checkpostandget.php");
//var $username;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>处理登陆页面</title>
<link rel=stylesheet href="css/css.css" type="text/css">
<style type="text/css">
<!--
#cplusplus{
margin-top:170px;
text-align:center;
}
#red{
color:#FF0000;
}
-->
</style>
</head>
<BODY>
<?php
include("include/session_mysql.php");
include("include/common.php");
//require("include/depclass.php");

//还不能说安全此套convert要配合注册的用户名密码正则才安全！！
$logname=safe_convert($_POST['logname']);
$password=safe_convert($_POST['password']);
$password=md5($password);
//服务端验证


if (empty($logname)||empty($password)) 
{
echo "detect error!!<br>";
echo "用户名或密码为空！";
echo "	将于3秒跳返回<br><A HREF=../index.html>如果要重新登陆，请单击这里</A>\n";
header("refresh:3;url=../index.php");
exit;
}
else
{
include("include/dbclass.php");
include("include/check_if_iskick.php");
//测试是否支持这样调用类文件
//$testclass1=new TESTCLASS;
//$mystatus=$testclass1->testobj("3");
//echo $mystatus;
//error_reporting(E_ALL);

//下点可能有注入攻击
if($user=$db->getfirst("select t1.*,t2.depname from login AS t1,department AS t2,usr AS t3 where t1.logname='$logname' and t1.pwd='$password' and t1.id=t3.id and t2.id=t3.department and t1.enable=1" ))
{$id=$user[2];
//echo "id是".$id;
$sql="select t1.nickname,t3.setting,t1.sex from usr AS t1,login AS t2,access AS t3 where t1.id=t2.id and t1.id='{$user['id']}' and t1.id=t3.id;";
$rest=$db->query($sql);
while($row=$db->getarray($rest)){
$usrname=$row[0];$acc=$row[1];
$sex=$row[2];
}
$staff=$user['depname'];//echo "sessionname是".$usrname;
//多少时间不登出
session_start();
$lifeTime = 24 * 3600*10000000;//this code is a garbage,^_^
setcookie(session_name(), session_id(), time() + $lifeTime, "/");

//用户标识
if (isset($_SESSION['id']) )
	{ unset($_SESSION['id']);}
if (isset($_SESSION['name']) )
    {unset($_SESSION['name']);}
if (isset($_SESSION['sex']) )
    {unset($_SESSION['sex']);}
if (isset($_SESSION['staff']) )
    {unset($_SESSION['staff']);}
if (isset($_SESSION['acc']) )
    {unset($_SESSION['acc']);}
if (!isset($_SESSION['id'])) 
{$_SESSION ['id'] = $id;}
//echo $_SESSION [’id’];
//登陆账户
if (!isset($_SESSION['logname'])) 
{$_SESSION ['logname'] = $logname;}

//用户名
if (!isset($_SESSION['name'])) 
{$_SESSION ['name'] = $usrname;}
//性别
if (!isset($_SESSION['sex'])) 
{$_SESSION ['sex'] = $sex;}
//用户所担任职务
if (!isset($_SESSION['staff']))
{$_SESSION ['staff'] = $staff;}
//用户权限
if (!isset($_SESSION['acc']))
{$_SESSION ['acc'] = $acc;}
//kill未得权限者

if (!isset($_SESSION['name']))
	{
		die('你无权访问11！');
	}
$result=$db->query("select * from sessions");
while($row=$db->getarray($result)){
//echo "$row[0]| $row[1]|$row[2]|$row[3]";
}
//echo "<br>";

//evoup1.2加入防止用户重复登陆代码,改原来的sessionmysql的数据库加了个`is_kicked` tinyint(4) NOT NULL default ‘0′,
//并且修改了login表,加了session

$sql_session = "select session_id from login where logname='".strval($logname)."'";
$result_session = $db->query($sql_session); 
// 如果该用户已经登陆了，我们断开先前的。
$session_idp=session_id();
if( @mysql_num_rows($result_session) > 0)
//if (1==1)
{
$row_session = @mysql_fetch_array($result_session);

if( $session_idp!= $row_session['session_id'])
{
	//echo "<font color=blue size=4>row_session['session_id']是".$row_session['session_id']."</font><br>";
	//echo "<font color=blue size=4>session_id是".$session_idp."</font>";
$sql_se = "update sessions set is_kicked='1' where sesskey='".$row_session['session_id']."'";
$db->query($sql_se);
//echo '<b>我踢前面的人!</b>';
//我想是不是应该TNND写入当前
}
}
$sql = "update login set session_id='".$session_idp."' where logname='".strval($logname)."'";
$db->query($sql);



//evoup1.0分两种情况
$sn=session_id();

if(!$result0=$db->getfirst("select sesskey from sessions where sesskey='{$sn}'"))
	{//echo "应该insert了";//evoupV1.1此时在session_mysql包含是插入,中加入插入当前用户的查询
}

else
	{
	$sql2="UPDATE sessions SET user='112'";
if($db->query($sql2)){
	//echo "sql执行了";
	};}

$result=$db->query("select * from sessions");
while($row=$db->getarray($result)){
//echo "$row[0]| $row[1]|$row[2]|$row[3]<br>";
}
$sn = session_id ();
//echo $sn;
//echo $id;

//echo "<div id=cplusplus><h3>你的登陆用户名 $logname ，您好，$usrname ！所属部门是[$staff]。</h3>\n";
echo "<div id=cplusplus><IMG SRC=\"image/jy_flag.png\" BORDER=\"0\" ><p><h3>登陆成功。</h3>\n";
echo "将于3秒后进入系统 <A HREF=../index.php>如果不想自动跳转，请单击这里</A>\n";
header("refresh:3;url=../index.php");

}
else
{
echo "<div id=cplusplus><h3 id=red>用户名或密码错误！</h3>";
echo "将于3秒跳返回<br><A HREF=../index.php>如果要重新登陆，请单击这里</A>\n";
header("refresh:3;url=../index.php");
}
}



?>
</BODY>
</HTML>