<?php
define('IN_EVP', true);
ob_start();
//error_reporting(E_CORE_ERROR);
error_reporting(E_ALL   ^   E_NOTICE);//否则会出现Use of undefined constant HTTP_X_FORWARDED_FOR ,优雅的报错-_-!
//require_once('datatoxml/fungsi.dwt.php');

include("include/checkpostandget.php");
include("include/cookie.class.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>处理登陆页面</title>
<link rel=stylesheet href="css/css.css" type="text/css">
</head>
<BODY>
<?php

//以下是生成xml的方?
//$myData = new dataToXML("myXML1.xml");
//		$myData->setQueryString("select * from usr");
//		if($myData->createXML()) // generate XML from Mysql Data Records
//		{echo "XML被生成了!";
//		}

include("include/session_mysql.php");
include("include/common.php");
//require("include/depclass.php");

//还不能说安全此套convert要配合注册的用户名密码正则才安全！！
//$logname = safe_convert($_POST['logname']);
$logid = safe_convert($_POST['logname']);
$password = safe_convert($_POST['password']);
$password = md5($password);
//服务端验证

if (empty($logid) || empty($password))
{
  echo"detect error!!<br>";
  echo"用户名或密码为空";
  echo("将于3秒跳返回<br><A HREF='./index.html'>如果要重新登陆，请单击这里/A>\n");
  header("refresh:3;url='./index.html'");
  exit;
}

else
{
  include("include/dbclass.php");
  include("include/check_if_iskick.php");
  //测试是否支持这样调用类文
  //$testclass1=new TESTCLASS;
  //$mystatus=$testclass1->testobj("3");
  //echo $mystatus;
error_reporting(E_ALL   ^   E_NOTICE);//否则会出现Use of undefined constant HTTP_X_FORWARDED_FOR ,优雅的报错-_-!

  //下点可能有注入攻击
  if ($user = $db->getfirst(
    "select t1.*,t2.depname from login AS t1,department AS t2,usr AS t3 where t1.id='$logid' and t1.pwd='$password' and t1.id=t3.id and t2.id=t3.department and t1.enable=1"))
  {
    $id = $user[2];
    //echo "id是".$id;
    $sql =
      "select t1.nickname,t3.setting from usr AS t1,login AS t2,access AS t3 where t1.id=t2.id and t1.id='{$user['id']}' and t1.id=t3.id;";
    $rest = $db->query($sql);
    while ($row = $db->getarray($rest))
    {
      $usrname = $row[0];
      $acc = $row[1];
    }
    $staff = $user['depname'];
    //echo "sessionname是".$usrname;


$co=new cookieClass("erpoa",200000000);

//echo $array[1];
$array[1]=$id;
$co->WriteCookie($array);
//var $username;


session_start();
//echo $_POST['authnumbox'];
if (isset($_POST['authnumbox'])){//判断是那个版本的登陆页，index.html就跳过了，index2.html就是加了验证码了的则执行下面
$ax=safe_convert($_POST['authnumbox']);
echo $ax;
echo $_SESSION['authnum'];
if ($ax!=$_SESSION['authnum']) 
	  {echo "<SCRIPT LANGUAGE=\"JavaScript\">alert (\"验证码错误！\");<!--//--></SCRIPT>";die;}
//echo $_SESSION['authnum'];
}
    //用户标识
    if (isset($_SESSION['id']))
    {
      unset($_SESSION['id']);
    }
    if (isset($_SESSION['name']))
    {
      unset($_SESSION['name']);
    }
    if (isset($_SESSION['staff']))
    {
      unset($_SESSION['staff']);
    }
    if (isset($_SESSION['acc']))
    {
      unset($_SESSION['acc']);
    }
    if (!isset($_SESSION['id']))
    {
      $_SESSION['id'] = $id;
    }
    //echo $_SESSION [’id’];
    //用户
    if (!isset($_SESSION['name']))
    {
      $_SESSION['name'] = $usrname;
    }
    //用户所担任职务
    if (!isset($_SESSION['staff']))
    {
      $_SESSION['staff'] = $staff;
    }
    //用户权限
    if (!isset($_SESSION['acc']))
    {
      $_SESSION['acc'] = $acc;
    }
    //kill未得权限

    if (!isset($_SESSION['name']))
    {
      die('你无权访问');
    }
    $result = $db->query("select * from sessions");
    while ($row = $db->getarray($result))
    {
      //echo "$row[0]| $row[1]|$row[2]|$row[3]";
    }
    //echo "<br>";

    //evoup1.2加入防止用户重复登陆代码,改原来的sessionmysql的数据库加了个`is_kicked` tinyint(4) NOT NULL default ??
    //并且修改了login加了session
$sql_session = "select session_id from login where logname='".strval($logid)."'";
$result_session = $db->query($sql_session);
    // 如果该用户已经登陆了，我们断开先前的
    $session_idp = session_id();
    if (@mysql_num_rows($result_session) > 0)
    //if (1==1)
    {
      $row_session = @mysql_fetch_array($result_session);

      if ($session_idp != $row_session['session_id'])
      {
        //echo "<font color=blue size=4>row_session['session_id']".$row_session['session_id']."</font><br>";
        //echo "<font color=blue size=4>session_id".$session_idp."</font>";
        $sql_se = "update sessions set is_kicked='1' where sesskey
          ='".$row_session['session_id']."'";
        $db->query($sql_se);
        echo'<b>我踢前面的人!</b>';
        //我想是不是应该TNND写入当前
      }
    }
    $sql = "update login set session_id='".$session_idp."' where logname
      ='".strval($logid)."'";
    $db->query($sql);

    //evoup1.0分两种情况
    $sn = session_id();

    if (!$result0 = $db->getfirst(
      "select sesskey from sessions where sesskey='{$sn}'"))
    {
      echo"应该insert";
        //evoupV1.1此时在session_mysql包含是插?中加入插入当前用户的查询
    }

    else
    {
      $sql2 = "UPDATE sessions SET user='112'";
      if ($db->query($sql2))
      {
        //echo "sql执行";
      };
    }

    $result = $db->query("select * from sessions");
    while ($row = $db->getarray($result))
    {
      //echo "$row[0]| $row[1]|$row[2]|$row[3]<br>";
    }
    $sn = session_id();
    //echo $sn;
    //echo $id;

    echo"你的登陆用户是$logid ，用户名是$logid 。部门是[$staff]。\n";
    echo
      "将于3秒后进入系统 <A HREF='./main4.php'>如果不想自动跳转，请单击这里</A>\n";
    //echo "将于3秒后进入系统 <A HREF=../frame/menu.php>如果不想自动跳转，请单击这里</A>\n";
    header("refresh:3;url='./main4.php'");

  }
  else
  {
    echo"用户名或密码错误";
    echo
      "将于3秒跳返回<br><A HREF='./index.html'>如果要重新登陆，请单击这里/A>\n";
    header("refresh:3;url='./index.html'");
  }
}

?>
</BODY>
</HTML>