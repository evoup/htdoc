<SCRIPT type="text/javascript" src="winpop.js"></SCRIPT>
<link rel=stylesheet href="../css/css.css" type="text/css">
<?php
include("myconst.php"); 
include("../include/dbclass.php");

if (!isset($_SESSION ['name'])) 
{
die("��û��Ȩ�޽��뱾��Ŀ!");
}
if (!isset($_SESSION['acc'])||$_SESSION['acc']<5) 


{
   echo "<script language='javascript'>alert('��û��Ȩ��!');window.location.href='../index.php';</script>";
   exit;
}
//top("��������");
top1("���������޸�����ͶƱ���⣺" );
//link_data();
$sql="select * from vote_title order by id desc";
$result=$db->query($sql);
if (mysql_num_rows($result)==0)
	{echo "<br><br><br><center><font color=red>Ŀǰ��û��ͶƱ���ݣ�����������⣡</red></center>";die;}
?>
<table width="90%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
<? while($row = mysql_fetch_array($result))
{
?>
<script language="javascript">
function test()
{
  if(!confirm('�����Ҫɾ����')) {return false};
}
</script>
  <tr>
    <td width="44%" height="21" bgcolor="#FFFFFF"><a href="edit.php?id=<?=$row["id"];?>" class="red"><?=$row["title"];?></a></td>
    <td width="12%" bgcolor="#CCCCCC"><div align="center"><a href="add_choice.php?id=<?=$row["id"];?>" class="top">����ѡ��</a></div></td>
    <td width="7%" bgcolor="#FFFFFF"><div align="center"><a href="del.php?id=<?=$row["id"];?>" onClick="return test()" class="top">ɾ��</a> </div></td>
    <td width="9%" bgcolor="#CECFCE"><div align="center"><!-- <a href="vote.php?id=<?=$row["id"];?>"  class="top" onclick="winPopup('350','320',1)">Ԥ��</a> --><input type="image" src="../image/button_view.gif" width="57" height="19" border="0" onclick="winPopup('350','320',<?=$row["id"];?>)"></div></td>
    <td width="28%" bgcolor="#FFFFFF"><div align="center">
        <input title="ճ���˴����뵽����Ҫ��ʾͶƱ�ĵط�" name="textfield" type="text" class="inputs" value="&lt;object type=&quot;text/x-scriptlet&quot; width=&quot;400&quot; height=&quot;600&quot; data=&quot;vote.php?id=<?=$row["id"];?>&quot;&gt;">
<?}?>
        </div></td>
  </tr>
</table>