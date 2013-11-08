<?
include("../include/session_mysql.php");
session_start();
function top1($topic)
{
?>
<table width="90%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td height="18" bgcolor="#FFFFFF"><div align="center"><a href="mymanage.php" class="top">管理首页</a></div></td>
    <!-- <td bgcolor="#CCCCCC"><div align="center"><a href="edit_manage.php" class="top">帐号更改</a></div></td> -->
    <td bgcolor="#FFFFFF"><div align="center"><a href="add.php" class="top">添加主题</a></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><a href="vote.php" target="_blank" class="top">选择当前活动投票</a></div></td>
    <td bgcolor="#FFFFFF"><div align="center"></div>
    <div align="center"><a href="logout.php" class="top">退出管理</a></div></td>
  </tr>
</table>

      <div align="center"><?=$topic;?></div>

<?
}
?>
