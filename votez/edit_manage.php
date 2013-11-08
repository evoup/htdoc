<?
include ("const.php");
if (!(session_is_registered("admins")))
{
   echo "<script language='javascript'>alert('您还没有登录!');window.location.href='admin.php';</script>";
   exit;
}
else
{ 
   if ($_POST["edit_name"]=="1")
   {
      if (empty($_POST["users"]))
	  {
	     echo "<script language='javascript'>alert('帐号不能为空!');history.go(-1);</script>";
		 exit;
	  }
	  else
	  {
	     link_data();
		 $query="update manage set names='".$_POST["users"]."' where id=1";
		 $result=mysql_query($query);
		    echo "<script language='javascript'>alert('帐号更新成功!');history.go(-1);</script>";

	  }
    }
   elseif( $_POST["edit_pass"]=="1" )
   {
      $pass1=trim($_POST["pass1"]);
	  $pass2=trim($_POST["pass2"]);
	  $pass3=trim($_POST["pass3"]);
	  link_data();
	  $query="select * from manage where id=1";
	  $result=mysql_query($query);
	  $row=mysql_fetch_array($result);
	  if (empty($pass1) || empty($pass2) || empty($pass3))
	  {
	      echo "<script language='javascript'>alert('数据填写不完整!');history.go(-1);</script>";
		  exit;
	  }
	  elseif ($pass2!=$pass3)
	  {
	     echo "<script language='javascript'>alert('两次输入的密码不一致!');history.go(-1);</script>";
		 exit;
	  }
	  elseif (md5($pass1)!=$row["pass"])
	  {
	      echo "<script language='javascript'>alert('原始密码错误!".md5($pass1)."');history.go(-1);</script>";
		  exit;
	  }
	  else
	  {
	     $sql="update manage set pass='".md5($pass2)."' where id=1";
		 $UpResult=mysql_query($sql);
		 if (!($UpResult))
		 {
		    echo "无法更新";
			exit;
         }
		 else
		 {
		    echo "<script language='javascript'>alert('密码更新成功!');window.location.href='edit_manage.php';</script>";
			exit;
	     }
	  }
	}
  else
  {	        
     top("帐号管理");
     top1("请在下面修改您的登录信息：");
     link_data();
     $query="select * from manage where id=1";
     $result=mysql_query($query);
     $row=mysql_fetch_array($result);
?>
<form name="form1" method="post" action="">
  <table width="298"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr bgcolor="#FFFFFF">
      <td colspan="2"><div align="center">登录帐号更改</div></td>
    </tr>
    <tr>
      <td width="76" height="23" bgcolor="#CCCCCC"><div align="right">更改帐号</div></td>
      <td width="211" bgcolor="#FFFFFF"><input type="text" name="users" class="inputs" value="<?=$row["names"];?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" colspan="2">
        <div align="center">
          <input type="submit" name="Submit" value="修改">
&nbsp;&nbsp;
          <input type="reset" name="Submit4" value="重写">
          <input name="edit_name" type="hidden" id="edit_name" value="1">
      </div></td>
    </tr>
  </table>
  
</form>
<p>&nbsp;</p>
<form action="" method="post">
<table width="298"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#FFFFFF">
    <td colspan="2"><div align="center">密码更改</div></td>
  </tr>
  <tr>
    <td width="76" height="5" bgcolor="#CECFCE"><div align="right">原始密码</div></td>
    <td width="211" bgcolor="#FFFFFF"><input name="pass1" type="password" class="inputs" id="pass1"></td>
  </tr>
  <tr>
    <td width="76" height="5" bgcolor="#CECFCE"><div align="right">新密码</div></td>
    <td bgcolor="#FFFFFF"><input name="pass2" type="password" class="inputs" id="pass2"></td>
  </tr>
  <tr>
    <td width="76" height="11" bgcolor="#CECFCE"><div align="right">重复新密码</div></td>
    <td bgcolor="#FFFFFF"><input name="pass3" type="password" class="inputs" id="pass3"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25" colspan="2">
      <div align="center">
        <input type="submit" name="Submit2" value="修改">
&nbsp;&nbsp;
        <input type="reset" name="Submit3" value="重写">
        <input name="edit_pass" type="hidden" id="edit_pass" value="1">
    </div></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>

<?
bottom();
}
}
?>