<meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=gb2312">
<link rel=stylesheet href="../css/css.css" type="text/css">
<?
include ("myconst.php");
include("../include/dbclass.php");
//top("添加选项");
top1("请在下面添加主题选项:");
//link_data();
if (!isset($_SESSION['name'])||!isset($_SESSION['acc'])||$_SESSION['acc']<5)
{
   echo "<script language='javascript'>alert('您还未登录！');window.location.href='admin.php';</script>";
   exit;
}
else
{
   if ($_POST["actions"]=="1")
   {
	     $choice=trim($_POST["choice"]);
		 if (empty($choice))
		 {
		    echo "<script language='javascript'>alert('选项内容不能为空!');history.go(-1);</script>";
	     }
		 else
		 {
		    $query="insert into vote_choice(choice,extends,IsDefault) values('".$choice."',".$_POST["ids"].",'".$_POST["IsDefault"]."')";
			$result=mysql_query($query);
			echo "<meta http-equiv='refresh' content='0;url=add_choice.php?id=".$_POST["ids"]."'>";
	     }
   }
   else{
//echo "_GET['id']是".$_GET['id'];
$sql="select * from vote_title where id='{$_GET['id']}'";
$result=$db->query($sql);
$row=$db->getarray($result);
if ($row['choice']=='a')
{
   $ch="单选";
}
else
{
   $ch="多选";
}
?>
<script language="javascript">
function test()
{
  if(!confirm('您真的要删除吗？')) return false;
}
</script>
<table width="90%" height="74"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td height="20" bgcolor="#CCCCCC"><div align="center">当前主题内容</div></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><?=$row["title"];?></td>
  </tr>
  <tr>
    <td valign="middle" bgcolor="#FFFFFF"><div align="right">选择类型：<?=$ch;?> &nbsp; <a href="edit.php?id=<?=$_GET["id"];?>" class="red">修改</a>
    </div></td>
  </tr>
</table>
<form name="form2" method="post" action="">
<table width="90%" height="47"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#CCCCCC">
    <td><div align="center">选项内容</div></td>
    <td><div align="center">是否默认选中</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="53%" valign="middle"><div align="center">
        <input name="choice" type="text" class="inputs" id="choice" size="30">
    </div></td>
    <td width="25%" valign="middle"><div align="center">
        <input type="radio" name="IsDefault" value="a">
        是
        <input name="IsDefault" type="radio" value="b" checked>
      否</div></td>
    <td width="22%" valign="middle"><div align="center">
        <input name="ids" type="hidden" id="ids" value="<?=$_GET["id"];?>">
        <input name="actions" type="hidden" id="actions" value="1">
        <input type="submit" name="Submit" value="提交">
      </div></td>
    </tr>
  </table>
</form>
<div align="center">
  <p><font color=red>注意：请确保每个主题只有一个默认选项，否则将出现不可预料的结果！</font>
  </p>
  <p>    <?
$query1="select * from vote_choice where extends=".$_GET["id"]." order by id desc";
$result1=$db->query($query1);
if (@mysql_num_rows($result1)==0)
{
   echo "<center><font color=red>暂时还没有选项</font></center>";
}
else
{
   while ($row1=mysql_fetch_array($result1))
   {
?>
      
</p>
</div>
<table width="90%" height="44"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <tr bgcolor="#CCCCCC">
        <td width="53%" height="20"><div align="center">选项内容</div></td>
        <td width="25%" height="20"><div align="center">是否默认</div></td>
        <td width="22%" height="20"><div align="center">操作</div></td>
  </tr>
          <? 
    if ($row1["IsDefault"]=="a")
	   $de="是";
	else
	   $de="否";
?>
      <tr bgcolor="#FFFFFF">
          <td height="21" valign="middle"><?=$row1["choice"];?></td>
          <td valign="middle"><?=$de;?>
        </td>
        <td valign="middle"><div align="center"><a href="edit_choice.php?id=<?=$row1["id"]?>" class="red">修改</a> <a href="del_choice.php?id=<?=$row1["id"]?>" onClick="return test()" class="red">删除</a></div></td>
  </tr>
</table>
<?
}
}
?>
<br><br><br>
<?

}
}
?>
