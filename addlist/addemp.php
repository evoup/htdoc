<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 添加人员 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT=""><link rel=stylesheet href="../css/css.css" type="text/css">
</HEAD>
<BODY>
<?php
include("../include/checkpostandget.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
include("../include/common.php");

echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo "<!--\n";
echo "function isemail(s)//验证E-MAIL格式函数\n";
echo "{\n";
echo "	if (s.length > 100)\n";
echo "	{\n";
echo "		window.alert(\"email地址长度不能超过100位!\");\n";
echo "		return false;\n";
echo "	}\n";
echo "	var regu = \"^(([0-9a-zA-Z]+)|([0-9a-zA-Z]+[_.0-9a-zA-Z-]*[0-9a-zA-Z]+))@([a-zA-Z0-9-]+[.])+([a-zA-Z]{2}|net|NET|com|COM|gov|GOV|mil|MIL|org|ORG|edu|EDU|int|INT)$\"\n";
echo "	var re = new RegExp(regu);\n";
echo "	if (s.search(re) != -1) {\n";
echo "		return true;\n";
echo "	} else {\n";
echo "		window.alert (\"请输入有效合法的E-mail地址 ！\")\n";
echo "		return false;\n";
echo "	}\n";
echo "}\n";
echo "function ck(){\n";
echo "	if(document.getElementById('logname').value=='')\n";
echo "{alert('请输入登陆帐号');return false;\n}";

echo "	if(!isemail(document.getElementById('email').value))\n";
echo "	{\n";
echo "		return false;\n";
echo "	}\n";
echo "	else\n";
echo "	{return confirm('确实要修改吗?');}\n";
echo "}\n";
echo "//-->\n";
echo "</SCRIPT>\n";


//这里注意要加好注册的正则，否则转化不匹配后将导致无法登陆
 if ($_POST["actionsflag"]=="1")
   {

 $logname=safe_convert($_POST["logname"]);
 $nickname=safe_convert($_POST["nickname"]);
 $email=trim($_POST["email"]);
 $mob=trim($_POST["mob"]);
 $dep=trim($_POST['dep']);
if (empty($logname))
{
	     echo "<script language='javascript'>alert('登陆帐号不能为空!');window.location.href='addemp.php';</script>";
		 exit;
	  }
elseif (empty($nickname))
{echo "<script language='javascript'>alert('人员姓名不能为空!');window.location.href='addemp.php';</script>";
		 exit;}
elseif (empty($email))	  
{echo "<script language='javascript'>alert('EMAIL不能为空!');window.location.href='addemp.php';</script>";
		 exit;}


	  else{
$sql1="insert into usr(nickname,department,usrimg) values('{$nickname}','{$dep}','1') ";
$rowa=$db->query($sql1);

//$sql2="select id from usr where nickname='{$rowa['nickname']}'";
//$rowb=$db->query($sql2);
$tmppwd=md5('8888');
$sql3="insert into login(logname,pwd,enable) values ('{$logname}','{$tmppwd}','1')";
$rowb=$db->query($sql3);
//默认权限为等级4
$sql4="insert into access(setting) values ('4')";
$rowb=$db->query($sql4);
//还要得到id后插入到delpartment的id里




echo "<script language='javascript'>alert('人员添加成功!');window.location.href='addemp.php';</script>";


}
}
?>
添加人员<FORM METHOD=POST ACTION=""   onsubmit="javascript :return ck();"  >
			<TABLE cellpadding=5 cellspacing=0>
			<TR>
				<TD>登陆帐号</TD><TD><INPUT TYPE="text" NAME="logname" id ='logname'></TD>
			</TR>
			<TR>
				<TD>人员姓名</TD><TD><INPUT TYPE="text" NAME="nickname" ></TD>
			</TR>
			<TR>
				<TD>电子邮件</TD><TD><INPUT TYPE="text" NAME="email" id ='email'></TD>
			</TR>
						<TR>
							<TD>移动电话</TD><TD><INPUT TYPE="text" NAME="mob"  ></TD>
						</TR>
						<TR>
							<TD>部&nbsp;&nbsp;门</TD><TD>
<?php
$result3=$db->query("select id,depname from department");
echo "<select name=dep>";		
while($row=$db->getarray($result3)){
		if ($row[depname]==$depname)
			{
			echo "<option  value=\"$row[id]\" selected>$row[depname]</option>";
			}
	else
	{echo "<option  value=".$row[id].">".$row[depname]."</option>";}
}
echo "</select>";
?>
							</TD>
						</TR>
			</TABLE><BR><BR>
<INPUT TYPE="reset" value="清除"><INPUT TYPE="submit" value="添加">
<INPUT TYPE="hidden" id="actionsflag" name="actionsflag" value="1">
</FORM>
</BODY>
</HTML>
