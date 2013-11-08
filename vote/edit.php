
<link rel=stylesheet href="../css/css.css" type="text/css">
<?
include ("myconst.php");
include("../include/dbclass.php");
if (!isset($_SESSION['name'])||!isset($_SESSION['acc'])||$_SESSION['acc']<5)
{
   echo "<script language='javascript'>alert('你没有权限!');window.location.href='../index.php';</script>";
   exit;
}
else
{
   if ($_POST["actions"]=="1")
   {
      $titles=trim($_POST["topic"]);
	  if (empty($titles))
	  {
	     echo "<script language='javascript'>alert('主题不能为空!');history.go(-1);</script>";
		 exit;
	  }
	  else
	  {
		 $result=$db->query("update vote_title set title='".$titles."',choice='".$_POST["choice"]."' where id='".$_POST["ids"]."'");
		 echo "<script language='javascript'>alert('主题更新成功');history.go(-1);</script>";
	  }
   }	
   else	 
   {

top1("请在下面修改您选择的主题!");

$query="select * from vote_title where id=".$_GET["id"];
$result=mysql_query($query);
$row = mysql_fetch_array($result);
?>
<form name="form1" method="post" action="">
  <table width="90%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="24%" height="45" bgcolor="#CCCCCC"><div align="center">主题内容</div></td>
      <td width="76%" valign="bottom" bgcolor="#FFFFFF">
	  <textarea name="topic" cols="40" rows="4" id="topic"><?=$row["title"];?></textarea>
      小于 200字</td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#CCCCCC"><div align="center">多选/单选</div></td>
      <td valign="bottom" bgcolor="#FFFFFF">
        <? if ($row["choice"]=="a")
		{
           echo "<input name='choice' type='radio' value='a' checked>单选";
           echo "<input type='radio' name='choice' value='b'>多选";
		}
		else
		{
           echo "<input name='choice' type='radio' value='a'>单选";
           echo "<input type='radio' name='choice' value='b' checked>多选";
		} 
		?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" valign="bottom"><div align="center">
          <input type="submit" name="Submit" value="提交">
&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="重置">
          <input name="actions" type="hidden" id="actions" value="1">
          <input name="ids" type="hidden" id="ids" value="<?=$_GET["id"];?>">
</div></td>
    </tr>
  </table>
</form>
<br><br><br>
<?

}
}
?>
