<!--��������Ϣ�ű���ע�ⷢ����ֻ��¼��һʱ��ķ����˵��������Ժ󲻸��£����������ṩ����-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
	<title>�õ�������</title>
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
	die("��û��Ȩ�޽��뱾��Ŀ!");
}
session_start();
$name=$_SESSION ['name'];

?>
<body>
<?php
include("../include/dbclass.php");

//�����Զ����

$Recipient=$_POST['Recipient'];
$lv=$_POST['lv'];
$bt=$_POST['bt'];
//��hidden������sql��uid����
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
	echo "û���Ǹ�Ա����";

}

$d = date("Y-m-d H:i");
$ary = explode(",",$rd);




for ($i=0;$i<sizeof($ary);$i++) { echo $tmp=$ary[$i];
$sql="INSERT INTO msg(sender,inceptid,important,title,content,sendtime) VALUES('{$name}','{$tmp}','{$lv}','{$bt}','{$postedValue}','{$d}');";


echo '<FONT SIZE=\"\" COLOR=\"#33FF66\">121212</FONT>';

if($result=$db->query($sql))
{
	echo "��Ϣ�Ѿ��ɹ����͵���$Recipient";}
}





?><!-- <script>
//leftFrameָ��߿�ܵ�����
parent.leftFrame.location.reload();
</script> -->
<?php echo "<script language='javascript'>alert('��Ϣ���ͳɹ���');window.close();</script>";
?>
		</table>
	</body>
</html>