<?
include("../include/session_mysql.php");
session_start();
function top1($topic)
{
?>
<table width="90%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td height="18" bgcolor="#FFFFFF"><div align="center"><a href="mymanage.php" class="top">������ҳ</a></div></td>
    <!-- <td bgcolor="#CCCCCC"><div align="center"><a href="edit_manage.php" class="top">�ʺŸ���</a></div></td> -->
    <td bgcolor="#FFFFFF"><div align="center"><a href="add.php" class="top">�������</a></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><a href="vote.php" target="_blank" class="top">ѡ��ǰ�ͶƱ</a></div></td>
    <td bgcolor="#FFFFFF"><div align="center"></div>
    <div align="center"><a href="logout.php" class="top">�˳�����</a></div></td>
  </tr>
</table>

      <div align="center"><?=$topic;?></div>

<?
}
?>
