<link rel=stylesheet href="../css/css.css" type="text/css">
<?
include("myconst.php");
include("../include/dbclass.php");
if (!isset($_SESSION['name'])||!isset($_SESSION['acc'])||$_SESSION['acc']<5)
{
   echo "<script language='javascript'>alert('��û��Ȩ��!');window.location.href='../index.php';</script>";
   exit;
}
else
{
  // top("���ͶƱ����");
   top1("�����������ͶƱ����:");
   if ($_POST["actions"]=="1")
   {
      $titles=trim($_POST["titles"]);
	  $choice=trim($_POST["choice"]);
	  if (empty($titles))
	  {
	     echo "<script language='javascript'>alert('���ⲻ��Ϊ��!');window.location.href='../index.php';</script>";
		 exit;
	  }
	  else
	  {
	     if ($choice=="1")
		    $ch="a";
		 else
		    $ch="b";

		 $query="insert into vote_title(title,choice) values('".$titles."','".$ch."')";
		 $result=mysql_query($query);
		 echo "<script language='javascript'>alert('������ӳɹ�!');window.location.href='add.php';</script>";
	  }
	}

?>
<form name="form1" method="post" action="">
  <table width="90%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="26%" height="14" bgcolor="#CCCCCC"><div align="center">��������</div></td>
      <td width="74%" bgcolor="#FFFFFF"><textarea name="titles" cols="30" rows="4" id="titles"></textarea>
      С��200�ַ�</td>
    </tr>
    <tr>
      <td width="26%" height="7" bgcolor="#CCCCCC"><div align="center">��ѡ/��ѡ</div></td>
      <td bgcolor="#FFFFFF"><input name="choice" type="radio" value="1" checked>
        ��ѡ
          <input type="radio" name="choice" value="2">
      ��ѡ</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2"><div align="center">
          <input name="actions" type="hidden" id="actions" value="1">
          <input type="submit" name="Submit" value="�ύ">
&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="����">
      </div></td>
    </tr>
  </table>
</form>
<br><br><br><br><br>
<?
}
?>