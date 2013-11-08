<?php
//evoup1.2检测是不是被踢出了
// put this file after session_db.php
$sess_id1 = session_id();
//$sql = "select * from sessions where sesskey='$sess_id' and is_kicked=1";
$sql = "select * from sessions where sesskey='$sess_id1' and is_kicked=1";
$result = $db->query($sql);
//if(@mysql_num_rows($result) > 0 && $_SESSION[’login’] == ‘member’)
if(@mysql_num_rows($result) > 0)
{
echo "<script>";
echo "alert(\"此帐号已在其他地方登陆，您被迫下线。如果发现有可疑盗用，请联系系统管理员！\");";
echo "</script>";


//$_SESSION[’login’] = ‘’;
//$_SESSION[’member_id’] = ‘’;
//$_SESSION[’member_username’] = ‘’;
//$_SESSION[’member_name’] = ‘’;

session_destroy();
die("您无权访问本栏目!"); 
}
else
{
	//echo "\$sess_id1是".$sess_id1;
//echo "不对啊,怎么没有destroy";
}
?>