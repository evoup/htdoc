
<link rel=stylesheet href="../css/css.css" type="text/css">
<?
include ("myconst.php");
include("../include/dbclass.php");
if (!isset($_SESSION['name'])||!isset($_SESSION['acc'])||$_SESSION['acc']<5)
{
   echo "<script language='javascript'>alert('��û��Ȩ��!');window.location.href='../index.php';</script>";
   exit;
}
else
{
   if ($_POST["actions"]=="1")
   {
      $titles=trim($_POST["topic"]);
	  if (empty($titles))
	  {
	     echo "<script language='javascript'>alert('���ⲻ��Ϊ��!');history.go(-1);</script>";
		 exit;
	  }
	  else
	  {
		 $result=$db->query("update vote_title set title='".$titles."',choice='".$_POST["choice"]."' where id='".$_POST["ids"]."'");
		 echo "<script language='javascript'>alert('������³ɹ�');history.go(-1);</script>";
	  }
   }	
   else	 
   {

top1("���������޸���ѡ�������!");

$query="select * from vote_title where id=".$_GET["id"];
$result=mysql_query($query);
$row = mysql_fetch_array($result);
?>
<form name="form1" method="post" action="">
  <table width="90%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="24%" height="45" bgcolor="#CCCCCC"><div align="center">��������</div></td>
      <td width="76%" valign="bottom" bgcolor="#FFFFFF">
	  <textarea name="topic" cols="40" rows="4" id="topic"><?=$row["title"];?></textarea>
      С�� 200��</td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#CCCCCC"><div align="center">��ѡ/��ѡ</div></td>
      <td valign="bottom" bgcolor="#FFFFFF">
        <? if ($row["choice"]=="a")
		{
           echo "<input name='choice' type='radio' value='a' checked>��ѡ";
           echo "<input type='radio' name='choice' value='b'>��ѡ";
		}
		else
		{
           echo "<input name='choice' type='radio' value='a'>��ѡ";
           echo "<input type='radio' name='choice' value='b' checked>��ѡ";
		} 
		?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" valign="bottom"><div align="center">
          <input type="submit" name="Submit" value="�ύ">
&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="����">
          <input name="actions" type="hidden" id="actions" value="1">
          <input name="ids" type="hidden" id="ids" value="<?=$_GET["id"];?>">
</div></td>
    </tr>
  </table>
</form>
<br><br><br>
<?

}
}
?>
