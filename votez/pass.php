<?
   include("const.php");
   $username=trim($_POST["names"]);
   $password=trim($_POST["password"]);
   $codes=trim($_POST["codes"]);
   if (empty($username) || empty($password) || empty($codes))
      {
	     echo "<script language='javascript'>alert('������д������');history.go(-1);</script>";
	     exit;
	  }
   if ($codes!=$_SESSION["logincode"])
      {
	     echo "<script language='javascript'>alert('��֤�����');history.go(-1);</script>";
	     exit;
      }
   link_data();
   $sql="select * from manage where id=1";
   $result=mysql_query($sql);
   $row=mysql_fetch_array($result);
   $names=stripslashes($row["names"]);
   $pass=stripslashes($row["pass"]);
   if ($username != $names)
   {
      echo "<script language='javascript'>alert('�ʺŴ���');history.go(-1);</script>";
	  exit;
   }
   if (md5($password)!=$pass)
   {
      echo "<script language='javascript'>alert('�������');history.go(-1);</script>";
      exit;
   }
   session_register("admins");
   $admins="1";
   echo "<script language='javascript'>alert('��¼�ɹ���');window.location.href='manage.php';</script>";  
   close_data();
?>