<!--��������Ϣ�ű���ע�ⷢ����ֻ��¼��һʱ��ķ����˵��������Ժ󲻸��£����������ṩ����-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
	<title>�õ�������</title>
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
die("��û��Ȩ�޽��뱾��Ŀ!");
}
$name=$_SESSION ['name'];
?>
<body>
<?php
include("../include/dbclass.php");
//�����Զ����
$Recipient=safe_convert($_POST['Recipient']);
$lv=safe_convert($_POST['lv']);
$bt=safe_convert($_POST['bt']);
if (ltrim(trim($bt))=='')
{echo "<script language='javascript'>alert('����գ�');window.close();</script>";}
else
{
//��hidden������sql��uid����
$rd=safe_convert($_POST['uid']);
$postedValue=safe_convert($_POST['content'],1);
$sqlx="select *  from usr  where id='{$rd}';";
$totlerows=$db->getcount($sqlx);
if($totlerows==0){
echo "û���Ǹ�Ա����";
}
$d = safe_convert(date("Y-m-d H:i"));
$ary = explode(",",$rd); 


for ($i=0;$i<sizeof($ary);$i++) {  $tmp=$ary[$i];
$sql="INSERT INTO msg(sender,inceptid,important,title,content,sendtime) VALUES('{$name}','{$tmp}','{$lv}','{$bt}','{$postedValue}','{$d}');";
//echo '<FONT SIZE=\"\" COLOR=\"#33FF66\">121212</FONT>';
if($result=$db->query($sql))
	{//echo "��Ϣ�Ѿ��ɹ����͵���$Recipient";
}
}

echo "<script language='javascript'>alert('��Ϣ���ͳɹ���');window.close();</script>";
}
?><!-- <script>
//leftFrameָ��߿�ܵ�����
parent.leftFrame.location.reload();
</script> -->

		</table>
	</body>
</html>