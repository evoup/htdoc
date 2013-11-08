<!--处理发送消息脚本，注意发送人只记录第一时间的发送人的姓名，以后不更新，而接受人提供更新-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
	<title>得到表单数据</title>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<meta name="robots" content="noindex, nofollow">
		<link href="../css/css.css" rel="stylesheet" type="text/css" />
<script language="javascript">
<!--
window.moveTo(0,0);
window.resizeTo(screen.availWidth,screen.availHeight);
//-->
</script>
</head>
<?php
//include("../include/checkpostandget.php");
include("../include/session_mysql.php");
include("../include/classdate.php");
include("../include/common.php");
session_start();
if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
$name=$_SESSION ['name'];
?>
<body>
<?php
include("../include/dbclass.php");
//加上自定义的
$Recipient=safe_convert($_POST['Recipient']);
$lv=safe_convert($_POST['lv']);
$bt=safe_convert($_POST['bt']);
if (ltrim(trim($bt))=='')
{echo "<script language='javascript'>alert('主题空！');window.close();</script>";}
else
{
//此hidden用来做sql的uid参数
$rd=safe_convert($_POST['uid']);
$postedValue=safe_convert($_POST['content'],1);
$sqlx="select *  from usr  where id='{$rd}';";
$totlerows=$db->getcount($sqlx);
if($totlerows==0){
echo "没有那个员工！";
}
$d = safe_convert(date("Y-m-d H:i"));
$ary = explode(",",$rd); 


for ($i=0;$i<sizeof($ary);$i++) {  $tmp=$ary[$i];
$sql="INSERT INTO msg(sender,inceptid,important,title,content,sendtime) VALUES('{$name}','{$tmp}','{$lv}','{$bt}','{$postedValue}','{$d}');";
//echo '<FONT SIZE=\"\" COLOR=\"#33FF66\">121212</FONT>';
if($result=$db->query($sql))
	{//echo "消息已经成功发送到了$Recipient";
}
}

echo "<script language='javascript'>alert('消息发送成功！');window.close();</script>";
}
?><!-- <script>
//leftFrame指左边框架的名字
parent.leftFrame.location.reload();
</script> -->

		</table>
	</body>
</html>