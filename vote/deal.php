<link rel=stylesheet href="../css/css.css" type="text/css">
<?
include ("myconst.php");
include("../include/dbclass.php");
//echo "n\a";
if (!isset($_SESSION['voted'])&&($_SESSION['voted']=="yes"))
{
   echo "<script language='javascript'>alert('���Ѿ�Ͷ��Ʊ�ˣ�');window.close();</script>";
   exit;
}
else
{
   $query1="select choice from vote_title where id=".$_GET["id"]."";
   $result1=$db->query($query1);
   $row1=mysql_fetch_array($result1);
   //����������֤������������δ��
if(empty($_POST['choice'])||$_POST['choice']=="")
	{echo "dectect error!û��ѡ��ѡ��ɣ�";
echo "<a href=\"javascript:window.close()\" class=\"red\">�رմ���</a>";
die;}
   $my=$_POST['choice'];
   if ($row1["choice"]=="a")
   {
      $query="update vote_choice set num=num+1 where id=".$my;
      $result=$db->query($query);

	  $_SESSION['voted']="yes";
	  echo "<script language='javascript'>alert('ͶƱ�ɹ���');window.close();</script>";
   }
   elseif ($row1["choice"]=="b")
   {	
	       for ($i=0;$i<count($my);$i++)
      {
         $query="update vote_choice set num=num+1 where id=".$my[$i];
	     $result=$db->query($query);

		$_SESSION['voted']="yes";
      }
	  echo "<script language='javascript'>alert('ͶƱ�ɹ���');window.close();</script>";
   }
}
?>