<!--处理发送消息脚本，注意发送人只记录第一时间的发送人的姓名，以后不更新，而接受人提供更新-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
	<title>得到表单数据</title>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<meta name="robots" content="noindex, nofollow">
		<link href="../css/css.css" rel="stylesheet" type="text/css" />
	</head>
<?php
define('IN_EVP', true);
//include("../include/checkpostandget.php");
include("../include/session_mysql.php");
include("../include/classdate.php");
session_start();
if (!isset($_SESSION ['name']))
{
	die("你没有权限进入本栏目!");
}
session_start();
$name=$_SESSION ['name'];

?>
<body>
<?php
include("../include/dbclass.php");

//加上自定义的

$Recipient=$_POST['Recipient'];
$lv=$_POST['lv'];
$bt=$_POST['bt'];
//此hidden用来做sql的uid参数
$rd=$_POST['uid'];
$postedValue=$_POST['FCKeditor1'];
//$postedValue='<IMG SRC="../../../../../../Documents and Settings/Administrator/My Documents/My Pictures/u=693032703,3221587769&gp=2.jpg" WIDTH="140" HEIGHT="140" BORDER="0" ALT="">';echo $postedValue;


//$postedValue=preg_replace("/\<IMG\s*src\=[\\\\\"]*(.+?)[\\\\\"]*\s*(border=0)?\>/is","[img]",$postedValue);




//echo $postedValue;

//die;

//

$postedValue=htmlspecialchars(stripslashes($postedValue));
//echo $postedValue;

if(!get_magic_quotes_gpc()){
	$postedValue= addslashes($postedValue);
	//$postedValue = str_replace('&amp;', '&', $postedValue);
	//$postedValue = str_replace('&lt;br /&gt;', '<br>', $postedValue);

}



//echo $postedValue;



$sqlx="select *  from usr  where id='{$rd}';";
$totlerows=$db->getcount($sqlx);
if($totlerows==0){
	echo "没有那个员工！";

}

$d = date("Y-m-d H:i");
$ary = explode(",",$rd);




for ($i=0;$i<sizeof($ary);$i++) { echo $tmp=$ary[$i];
$sql="INSERT INTO msg(sender,inceptid,important,title,content,sendtime) VALUES('{$name}','{$tmp}','{$lv}','{$bt}','{$postedValue}','{$d}');";


echo '<FONT SIZE=\"\" COLOR=\"#33FF66\">121212</FONT>';

if($result=$db->query($sql))
{
	echo "消息已经成功发送到了$Recipient";}
}





?><!-- <script>
//leftFrame指左边框架的名字
parent.leftFrame.location.reload();
</script> -->
<?php echo "<script language='javascript'>alert('消息发送成功！');window.close();</script>";
?>
		</table>
	</body>
</html>