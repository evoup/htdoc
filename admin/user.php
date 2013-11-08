<?php
define('IN_EVP', true);


/*# 让它在过去就“失效”
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

# 永远是改动过的
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

# HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

# HTTP/1.0
header("Pragma: no-cache");*/
ob_start();

//test

//include("../include/checkpostandget.php");管理员部分就用不到了
include('../include/dbclass.php');
include('../include/session_mysql.php');
require_once('.././include/ext_page.class.php');

session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id']!=1 ){
die('没有权限');
}
//检查超时开始
	$timeout=1200;      //超时时间,单位:秒,这里设为20分钟. 
	$now=time(); 
	if(($now-$_SESSION[ "session_time"]) > $timeout) 
	{ 
	     //超时了. 
	     foreach ($_SESSION as $key=>$value){
	     unset($_SESSION[$key]);
	     @session_destroy();
	     }
	     //session_regenerate_id();//如果超时就再设置一个新的ID
	     die(" <script>alert( \"超时了. \");location.href='admin.php'; </script>"); 
	}else{ 
	     //还没超时. 
	     $_SESSION[ "session_time"]=time(); 
	}	
	//检查超时结束	
include("../include/common.php");
require "../inc/template.inc";
require("./makejs/function.php");
$tpl = new Template("../template/admin");
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[[["; //修改左边界符为[##
$tpl->right_delimiter = "]]]"; //修改右边界符##]
if (empty($_REQUEST['action']) || !isset($_REQUEST['action'])) $_REQUEST['action']='list'; 


if ($_REQUEST['op']=='updateUser'){//如果是提交了修改的账号
foreach ($_POST as $key=>$value){
$$key=safe_convert($value);
}
$SQL="update users_profile set `homepage`='$url' where `users_id`=$uid";
$db->query($SQL);

}


if ($_REQUEST['action']=='edit'){
	if ($_POST['op']=='modifyUser'){//如果是修改用户信息
$_POST[uid]=safe_convert($_POST[uid]);
$sql="select t1.*,t2.login,t2.real_name,t2.email from users_profile as t1,users as t2 where t1.users_id=$_POST[uid] and t2.id=$_POST[uid]";
//die($sql);
$result=$db->query($sql);
	while($row=$db->getarray($result)){
	$tpl->set_var("username",$row[login]);
	$tpl->set_var("real_name",$row[real_name]);
	$tpl->set_var("email",$row[email]);
	$tpl->set_var("homepage",$row[homepage]);
	$tpl->set_var("usersign",$row[notes]);//签名
	$tpl->set_var("uid",$_POST[uid]);
	}
}




if ($_POST['op']=='delUser'){//如果是删除用户信息

$sql="delete from users where id = $_POST[uid]";
$db->query($sql);
$sql="delete from users_profile where users_id =$_POST[uid]";
$db->query($sql);


echo "<script>alert(\"删除成功！\");location.href=\"user.php?action=list\"</script>";
}



$tpl->set_var("name",$name);
$tpl->set_file("main", "_user_edit.html");//
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
exit(0);
}


if ($_REQUEST['action']=='list'){//如果是进入

$tpl->set_var("username",$username);
$tpl->set_var("name",$name);
$tpl->set_file("main", "_user_list.html");//

$tpl->set_block("main", "list", "nlist"); 
$sql='select id,login from users';
$result=$db->query($sql);
while($row=$db->getarray($result)){
$outoptstr.="<option value=$row[id]>$row[login]</option>";
}
$tpl->set_var("optlist",$outoptstr);
$tpl->parse("nlist", "list", true);



$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
exit(0);
}


if ($_REQUEST['action']=='add'){//如果是添加新账号

//die('add');
//id  login  pw  real_name  extra_info  email  tmp_mail  access_level  active 
if (isset($_POST['password']) && $_POST['password']!==''){
$passwd=md5($_POST['password']);
}
else{
$passwd='cf79ae6addba60ad018347359bd144d2';//8888 md5 value
}
foreach ($_POST as $key=>$value){
$$key=safe_convert($value);
}
//To do add rollback!!
$sql="insert into users(login,pw,real_name,email,access_level,active) values ('$username','$passwd','$name','$email',1,1)";
if($db->query($sql)){
$insertid=$db->getid();
$sql="insert into users_profile(users_id,homepage) values($insertid,'$url')";
$db->query($sql);
}
else{
die('error');
}
echo "<script>alert(\"添加完成！\")</script>";
echo "<script>location.href='user.php?action=list'</script>";//注意这里大量使用了JS跳转，这是为了加速开发，前台绝对不能这样，要用evp-header或者header跳转！！


$tpl->set_var("username",$username);
$tpl->set_var("name",$name);
$tpl->set_file("main", "_user_list.html");//
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
exit(0);
}
?>