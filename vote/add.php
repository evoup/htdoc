<link rel=stylesheet href="../css/css.css" type="text/css">
<?
include("myconst.php");
include("../include/dbclass.php");
if (!isset($_SESSION['name'])||!isset($_SESSION['acc'])||$_SESSION['acc']<5)
{
   echo "<script language='javascript'>alert('你没有权限!');window.location.href='../index.php';</script>";
   exit;
}
else
{
  // top("添加投票主题");
   top1("请在下面添加投票主题:");
   if ($_POST["actions"]=="1")
   {
      $titles=trim($_POST["titles"]);
	  $choice=trim($_POST["choice"]);
	  if (empty($titles))
	  {
	     echo "<script language='javascript'>alert('主题不能为空!');window.location.href='../index.php';</script>";
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
		 echo "<script language='javascript'>alert('主题添加成功!');window.location.href='add.php';</script>";
	  }
	}

?>
<form name="form1" method="post" action="">
  <table width="90%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="26%" height="14" bgcolor="#CCCCCC"><div align="center">标题内容</div></td>
      <td width="74%" bgcolor="#FFFFFF"><textarea name="titles" cols="30" rows="4" id="titles"></textarea>
      小于200字符</td>
    </tr>
    <tr>
      <td width="26%" height="7" bgcolor="#CCCCCC"><div align="center">单选/多选</div></td>
      <td bgcolor="#FFFFFF"><input name="choice" type="radio" value="1" checked>
        单选
          <input type="radio" name="choice" value="2">
      多选</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2"><div align="center">
          <input name="actions" type="hidden" id="actions" value="1">
          <input type="submit" name="Submit" value="提交">
&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="重置">
      </div></td>
    </tr>
  </table>
</form>
<br><br><br><br><br>
<?
}
?>