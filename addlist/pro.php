<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<link rel=stylesheet href="../css/css.css" type="text/css">
</HEAD>
<BODY>
<?php
include("../include/checkpostandget.php");
include("../include/session_mysql.php");
$proid=$_GET["proid"];
echo $proid;
//把常用是proid存下来,省得POST GET
session_start();
//mysql_query("SET NAMES 'gbk'");
//用户标识
if (!isset($_SESSION['id'])) 
{$_SESSION [’id’] = $id;}
include("../include/dbclass.php");
$db=new dbClass("root","jysysadmin","jzit","localhost");
$db->connect();
mysql_query("SET NAMES 'gbk'");
$db->select();
$sql="select *  from usr  where id='$proid' ";
$result=$db->query($sql);
//循环显示当前纪录的所有字段值 
$row= mysql_fetch_row($result); 
	if($row){
for($j = 0;$j <count($row);$j++) 
{ 
echo $row[$j]; 
} 
	}

$name=$row[1];
$uid=$row[0];

?>


  <DIV ><BR>
<TABLE  cellSpacing=1 cellPadding=1 width="98%" align=center>
  
  <TR>
    <TD  colSpan=2 class="border-a"><?php echo $name;?>的个人资料&gt;&gt;</TD>
  </TR>
  <TR>
    <TD class="border-a" >
      <TABLE cellSpacing=0 cellPadding=6 width="98%" border=0>
        
        <TR>
          <TD width="70%">
            <TABLE 
            width="98%" border=0 cellPadding=1 cellSpacing=0 class="border-a" style="TABLE-LAYOUT: fixed">
              
              <TR>
                <TD class=smalltxt align=center colSpan=2><A 
                  href="../messenge/msgpost.php?Recipient=<?php echo $proid;?>" 
                  target=mainFrame>[ 发短消息 ]</A> &nbsp; &nbsp; &nbsp; <A onclick=history.go(-1); 
                  href="javascript:history.back();">[ 
                  返回上一页 ]</A> <BR>
                  <BR></TD></TR>
              <TR>
                <TD  width="100%">UID:<?php echo $uid;?></TD>
                <TD width="55%">17080</TD></TR>
              <TR>
                <TD  width="100%">注册日期：</TD>
                <TD width="55%">2005-10-23</TD></TR>
              <TR>
                <TD  width="100%">上次访问：</TD>
                <TD width="55%">2006-5-16 22:22</TD></TR>
              <TR>
                <TD  vAlign=top width="100%">在线时间:</TD>
                <TD width="55%">总计算在线<SPAN >27.67</SPAN> 小时, 本周在线<SPAN >5.5</SPAN> 小时<BR>                  </TD></TR>
              <TR>
                <TD colSpan=2>
                  <HR width="95%"  noShade SIZE=0>
                </TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  vAlign=top width="100%">用户组:</TD>
                <TD width="55%">&nbsp;</TD>
              </TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD>
              </TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD>
              </TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD>
              </TR>
              <TR>
                <TD width="100%" colSpan=2>&nbsp;
                </TD></TR>
              <TR>
                <TD  width="100%">性別:</TD>
                <TD width="55%">保密 </TD></TR>
              <TR>
                <TD  width="100%">來自:</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">生日:</TD>
                <TD width="55%">00-00</TD></TR>
              <TR>
                <TD  vAlign=top width="100%">自我介紹:</TD>
                <TD width="55%">&nbsp;</TD></TR></TABLE></TD>
          <TD width="30%" height="100%">
            <TABLE  cellSpacing=1 cellPadding=1  width="100%" class=border-a>
              
              <TR >
                <TD width="100%" colSpan=2>个人信息</TD>
              </TR>
              <TR >
                <TD align=center width="100%" colSpan=2><BR><BR></TD></TR>
              <TR>
                <TD  width="25%">主页：</TD>
                <TD  width="80%">
                  <TABLE style="TABLE-LAYOUT: fixed" cellSpacing=0 cellPadding=0 
                  width="100%" border=0>
                    
                    <TR>
                      <TD>&nbsp;</TD>
                    </TR></TABLE></TD></TR>
              <TR>
                <TD >Email:</TD>
                <TD  width="80%">&nbsp;</TD>
              </TR>
              <TR>
                <TD >QQ:</TD>
                <TD  width="80%"></TD></TR>
              <TR>
                <TD >ICQ:</TD>
                <TD  width="80%">&nbsp;</TD></TR>
              <TR>
                <TD >Yahoo:</TD>
                <TD  width="80%">&nbsp;</TD></TR>
              <TR>
                <TD >MSN:</TD>
                <TD  width="80%">&nbsp;</TD></TR>
              <TR>
                <TD >淘宝旺旺:</TD>
                <TD  width="80%">&nbsp; </TD></TR>
              <TR>
                <TD >支付宝帐号:</TD>
                <TD  width="80%">&nbsp; 
  </TD></TR></TABLE></TD></TR></TABLE></TD></TR></TABLE><BR><BR></DIV>
<DIV class=maintable></DIV>












</BODY>
</HTML>
