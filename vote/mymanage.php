<SCRIPT type="text/javascript" src="winpop.js"></SCRIPT>
<link rel=stylesheet href="../css/css.css" type="text/css">
<?php
include("myconst.php"); 
include("../include/dbclass.php");

if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
if (!isset($_SESSION['acc'])||$_SESSION['acc']<5) 


{
   echo "<script language='javascript'>alert('你没有权限!');window.location.href='../index.php';</script>";
   exit;
}
//top("管理中心");
top1("请在下面修改您的投票主题：" );
//link_data();
$sql="select * from vote_title order by id desc";
$result=$db->query($sql);
if (mysql_num_rows($result)==0)
	{echo "<br><br><br><center><font color=red>目前还没有投票内容！请先添加主题！</red></center>";die;}
?>
<table width="90%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
<? while($row = mysql_fetch_array($result))
{
?>
<script language="javascript">
function test()
{
  if(!confirm('您真的要删除吗？')) {return false};
}
</script>
  <tr>
    <td width="44%" height="21" bgcolor="#FFFFFF"><a href="edit.php?id=<?=$row["id"];?>" class="red"><?=$row["title"];?></a></td>
    <td width="12%" bgcolor="#CCCCCC"><div align="center"><a href="add_choice.php?id=<?=$row["id"];?>" class="top">管理选项</a></div></td>
    <td width="7%" bgcolor="#FFFFFF"><div align="center"><a href="del.php?id=<?=$row["id"];?>" onClick="return test()" class="top">删除</a> </div></td>
    <td width="9%" bgcolor="#CECFCE"><div align="center"><!-- <a href="vote.php?id=<?=$row["id"];?>"  class="top" onclick="winPopup('350','320',1)">预览</a> --><input type="image" src="../image/button_view.gif" width="57" height="19" border="0" onclick="winPopup('350','320',<?=$row["id"];?>)"></div></td>
    <td width="28%" bgcolor="#FFFFFF"><div align="center">
        <input title="粘贴此处代码到您想要显示投票的地方" name="textfield" type="text" class="inputs" value="&lt;object type=&quot;text/x-scriptlet&quot; width=&quot;400&quot; height=&quot;600&quot; data=&quot;vote.php?id=<?=$row["id"];?>&quot;&gt;">
<?}?>
        </div></td>
  </tr>
</table>