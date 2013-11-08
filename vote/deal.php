<link rel=stylesheet href="../css/css.css" type="text/css">
<?
include ("myconst.php");
include("../include/dbclass.php");
//echo "n\a";
if (!isset($_SESSION['voted'])&&($_SESSION['voted']=="yes"))
{
   echo "<script language='javascript'>alert('您已经投过票了！');window.close();</script>";
   exit;
}
else
{
   $query1="select choice from vote_title where id=".$_GET["id"]."";
   $result1=$db->query($query1);
   $row1=mysql_fetch_array($result1);
   //加入服务端验证，防攻击函数未加
if(empty($_POST['choice'])||$_POST['choice']=="")
	{echo "dectect error!没有选择选项吧！";
echo "<a href=\"javascript:window.close()\" class=\"red\">关闭窗口</a>";
die;}
   $my=$_POST['choice'];
   if ($row1["choice"]=="a")
   {
      $query="update vote_choice set num=num+1 where id=".$my;
      $result=$db->query($query);

	  $_SESSION['voted']="yes";
	  echo "<script language='javascript'>alert('投票成功！');window.close();</script>";
   }
   elseif ($row1["choice"]=="b")
   {	
	       for ($i=0;$i<count($my);$i++)
      {
         $query="update vote_choice set num=num+1 where id=".$my[$i];
	     $result=$db->query($query);

		$_SESSION['voted']="yes";
      }
	  echo "<script language='javascript'>alert('投票成功！');window.close();</script>";
   }
}
?>