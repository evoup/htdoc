<?
include ("const.php");
top("���ѡ��");
top1("���������������ѡ��:");
link_data();
if (!(session_is_registered("admins")))
{
   echo "<script language='javascript'>alert('����δ��¼��');window.location.href='admin.php';</script>";
   exit;
}
else
{
   if ($_POST["actions"]=="1")
   {
	     $choice=trim($_POST["choice"]);
		 if (empty($choice))
		 {
		    echo "<script language='javascript'>alert('ѡ�����ݲ���Ϊ��!');history.go(-1);</script>";
	     }
		 else
		 {
		    $query="insert into choice(choice,extends,IsDefault) values('".$choice."',".$_POST["ids"].",'".$_POST["IsDefault"]."')";
			$result=mysql_query($query);
			echo "<meta http-equiv='refresh' content='0;url=add_choice.php?id=".$_POST["ids"]."'>";
	     }
   }
   else{
$query="select * from title where id=".$_GET["id"];
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if ($row["choice"]=="a")
{
   $ch="��ѡ";
}
else
{
   $ch="��ѡ";
}
?>
<script language="javascript">
function test()
{
  if(!confirm('�����Ҫɾ����')) return false;
}
</script>
<table width="70%" height="74"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td height="20" bgcolor="#CCCCCC"><div align="center">��ǰ��������</div></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><?=$row["title"];?></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><div align="right">ѡ�����ͣ�<?=$ch;?> &nbsp; <a href="edit.php?id=<?=$_GET["id"];?>" class="red">�޸�</a>
    </div></td>
  </tr>
</table>
<form name="form2" method="post" action="">
<table width="70%" height="47"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#CCCCCC">
    <td><div align="center">ѡ������</div></td>
    <td><div align="center">�Ƿ�Ĭ��ѡ��</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="53%" valign="middle"><div align="center">
        <input name="choice" type="text" class="inputs" id="choice" size="30">
    </div></td>
    <td width="25%" valign="middle"><div align="center">
        <input type="radio" name="IsDefault" value="a">
        ��
        <input name="IsDefault" type="radio" value="b" checked>
      ��</div></td>
    <td width="22%" valign="middle"><div align="center">
        <input name="ids" type="hidden" id="ids" value="<?=$_GET["id"];?>">
        <input name="actions" type="hidden" id="actions" value="1">
        <input type="submit" name="Submit" value="�ύ">
      </div></td>
    </tr>
  </table>
</form>
<div align="center">
  <p><font color=red>ע�⣺��ȷ��ÿ������ֻ��һ��Ĭ��ѡ����򽫳��ֲ���Ԥ�ϵĽ����</font>
  </p>
  <p>    <?
$query1="select * from choice where extends=".$_GET["id"]." order by id desc";
$result1=mysql_query($query1);
if (@mysql_num_rows($result1)==0)
{
   echo "<center><font color=red>��ʱ��û��ѡ��</font></center>";
}
else
{
   while ($row1=mysql_fetch_array($result1))
   {
?>
      
</p>
</div>
<table width="70%" height="44"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <tr bgcolor="#CCCCCC">
        <td width="53%" height="20"><div align="center">ѡ������</div></td>
        <td width="25%" height="20"><div align="center">�Ƿ�Ĭ��</div></td>
        <td width="22%" height="20"><div align="center">����</div></td>
  </tr>
          <? 
    if ($row1["IsDefault"]=="a")
	   $de="��";
	else
	   $de="��";
?>
      <tr bgcolor="#FFFFFF">
          <td height="21" valign="middle"><?=$row1["choice"];?></td>
          <td valign="middle"><?=$de;?>
        </td>
        <td valign="middle"><div align="center"><a href="edit_choice.php?id=<?=$row1["id"]?>" class="red">�޸�</a> <a href="del_choice.php?id=<?=$row1["id"]?>" onClick="return test()" class="red">ɾ��</a></div></td>
  </tr>
</table>
<?
}
}
?>
<br><br><br>
<?
bottom();
}
}
?>
