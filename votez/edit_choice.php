<?
include ("const.php");
if (!(session_is_registered("admins")))
{
   echo "<script language='javascript'>alert('����δ��¼��');window.location.href='admin.php';</script>";
   exit;
}
else
{
   if($_POST["actions"]=="1")
   {
      $choice=trim($_POST["choice"]);
	  if (empty($choice))
	  {
	     echo "<script language='javascript'>alert('ѡ�����ݲ���Ϊ��!');history.go(-1);</script>";
	  }
	  else
	  {
	     link_data();
		 $query1="update choice set choice='".$choice."',IsDefault='".$_POST["currents"]."' where id=".$_POST["ids"];
		 $result1=mysql_query($query1);
		 echo "<script language='javascript'>alert('�޸ĳɹ���');history.go(-1);</script>";
	  }
   }
   else
   {
      top("�޸�ѡ������");
      top1("���������޸ĵ�ǰѡ������");
      link_data();
      $query="select * from choice where id=".$_GET["id"];
      $result=mysql_query($query);
      $row=mysql_fetch_array($result);
?>
<form name="form1" method="post" action="">
  <table width="70%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="34%" bgcolor="#CCCCCC"><div align="center">ѡ������
      </div></td>
      <td width="66%" bgcolor="#FFFFFF"><input name="choice" type="text" class="inputs" id="choice" value="<?=$row["choice"];?>" size="30"></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><div align="center">�Ƿ�Ĭ��</div></td>
      <td bgcolor="#FFFFFF">
	  <?
	  if ($row["IsDefault"]=="a")
	  {
	  ?>
        <input type="radio" name="currents" value="a" checked>
��
<input type="radio" name="currents" value="b">
��
<?
}
else
{
?>
<input type="radio" name="currents" value="a">
��
<input type="radio" name="currents" value="b" checked>
��
<?
}
?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2"><div align="center">
        <input type="submit" name="Submit" value="�ύ">&nbsp;&nbsp;
        <input type="reset" name="Submit2" value="����">
        <input name="actions" type="hidden" id="actions" value="1">
        <input type="hidden" name="ids" value="<?=$_GET["id"];?>">
</div></td>
    </tr>
  </table>
</form>
<?
}
}
?>