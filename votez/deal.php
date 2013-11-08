<?
include ("const.php");
if (!session_is_registered($_SESSION("votes")))
{
   echo "<script language='javascript'>alert('您已经投过票了！');window.close();</script>";
   exit;
}
else
{
   link_data();
   $query1="select choice from title where id=".$_GET["id"]."";
   $result1=mysql_query($query1);
   $row1=mysql_fetch_array($result1);
   $my=$_POST["choice"];
   if ($row1["choice"]=="a")
   {
      $query="update choice set num=num+1 where id=".$my;
      $result=mysql_query($query);
      session_register("votes");
	  echo "<script language='javascript'>alert('投票成功！');window.close();</script>";
   }
   elseif ($row1["choice"]=="b")
   {
      for ($i=0;$i<count($my);$i++)
      {
         $query="update choice set num=num+1 where id=".$my[$i];
	     $result=mysql_query($query);
	     session_register("votes");
      }
	  echo "<script language='javascript'>alert('投票成功！');history.go(-1);</script>";
   }
}
?>