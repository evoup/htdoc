<?
session_start();
function top($title)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><? echo $title; ?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: ����;
	font-size: 12px;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
}
function top1($topic)
{
?>
<table width="70%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td height="18" bgcolor="#FFFFFF"><div align="center"><a href="manage.php" class="top">������ҳ</a></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><a href="edit_manage.php" class="top">�ʺŸ���</a></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><a href="add.php" class="top">�������</a></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><a href="http://www.it-zero.com/leave_word" target="_blank" class="top">��������</a></div></td>
    <td bgcolor="#FFFFFF"><div align="center"></div>
    <div align="center"><a href="logout.php" class="top">�˳�����</a></div></td>
  </tr>
</table>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="129">
      <div align="center"><?=$topic;?></div></td>
  </tr>
</table>
<?
}
function link_data()
{
   $db=mysql_connect("localhost","root","getter");              //�ڴ˴��޸����ݿ�����
mysql_query("SET NAMES 'gbk'");

   if(!$db)
   {
      echo "���ݿ�����ʧ��!";
   }
   mysql_select_db("vote");
}
function close_data()
{
   mysql_close($db);
}
function bottom()
{
?>
<table width="68%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="23" bgcolor="#FFFFFF"><div align="center">2004 CopyRight Reserve IT�����</div></td>
  </tr>
  <tr>
    <td height="20" bgcolor="#FFFFFF"><div align="center">����֧�֣�<a href="mailto:admin@it-zero.com" class="red">��֪</a> ��ӭ�������ǵ�վ�㣺<a href="http://www.it-zero.com" class="red">http://www.it-zero.com</a> CountZ  PHP V1.0</div></td>
  </tr>
</table>
</body>
</html>
<?
}
?>
