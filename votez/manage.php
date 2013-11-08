<? include("const.php"); 
if (!(session_is_registered("admins")))
{
   echo "<script language='javascript'>alert('您还没有登录!');window.location.href='admin.php';</script>";
   exit;
}
top("管理中心");
top1("请在下面修改您的投票主题：" );
link_data();
$sql="select * from title order by id desc";
$result=mysql_query($sql);
if (mysql_num_rows($result)==0)
{
   echo "<br><br><br><center><font color=red>目前还没有投票内容！</red></center>";
}
else
{
?>
<table width="70%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
<? while($row = mysql_fetch_array($result))
      {
?>
<script language="javascript">
function test()
{
  if(!confirm('您真的要删除吗？')) return false;
}
</script>
  <tr>
    <td width="44%" height="21" bgcolor="#FFFFFF"><a href="edit.php?id=<?=$row["id"];?>" class="red"><?=$row["title"];?></a></td>
    <td width="12%" bgcolor="#CCCCCC"><div align="center"><a href="add_choice.php?id=<?=$row["id"];?>" class="top">添加选项</a></div></td>
    <td width="7%" bgcolor="#FFFFFF"><div align="center"><a href="del.php?id=<?=$row["id"];?>" onClick="return test()" class="top">删除</a> </div></td>
    <td width="9%" bgcolor="#CECFCE"><div align="center"><a href="vote.php?id=<?=$row["id"];?>" target="_blank" class="top">预览</a></div></td>
    <td width="28%" bgcolor="#FFFFFF"><div align="center">
        <input title="粘贴此处代码到您想要显示投票的地方" name="textfield" type="text" class="inputs" value="&lt;object type=&quot;text/x-scriptlet&quot; width=&quot;400&quot; height=&quot;600&quot; data=&quot;vote.php?id=<?=$row["id"];?>&quot;&gt;">

        </div></td>
  </tr>
<?
}
}
?>
</table>
<br><br><br><br><br><br>
<?
bottom();
?>
