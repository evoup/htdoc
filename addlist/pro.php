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
//�ѳ�����proid������,ʡ��POST GET
session_start();
//mysql_query("SET NAMES 'gbk'");
//�û���ʶ
if (!isset($_SESSION['id'])) 
{$_SESSION [��id��] = $id;}
include("../include/dbclass.php");
$db=new dbClass("root","jysysadmin","jzit","localhost");
$db->connect();
mysql_query("SET NAMES 'gbk'");
$db->select();
$sql="select *  from usr  where id='$proid' ";
$result=$db->query($sql);
//ѭ����ʾ��ǰ��¼�������ֶ�ֵ 
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
    <TD  colSpan=2 class="border-a"><?php echo $name;?>�ĸ�������&gt;&gt;</TD>
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
                  target=mainFrame>[ ������Ϣ ]</A> &nbsp; &nbsp; &nbsp; <A onclick=history.go(-1); 
                  href="javascript:history.back();">[ 
                  ������һҳ ]</A> <BR>
                  <BR></TD></TR>
              <TR>
                <TD  width="100%">UID:<?php echo $uid;?></TD>
                <TD width="55%">17080</TD></TR>
              <TR>
                <TD  width="100%">ע�����ڣ�</TD>
                <TD width="55%">2005-10-23</TD></TR>
              <TR>
                <TD  width="100%">�ϴη��ʣ�</TD>
                <TD width="55%">2006-5-16 22:22</TD></TR>
              <TR>
                <TD  vAlign=top width="100%">����ʱ��:</TD>
                <TD width="55%">�ܼ�������<SPAN >27.67</SPAN> Сʱ, ��������<SPAN >5.5</SPAN> Сʱ<BR>                  </TD></TR>
              <TR>
                <TD colSpan=2>
                  <HR width="95%"  noShade SIZE=0>
                </TD></TR>
              <TR>
                <TD  width="100%">&nbsp;</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  vAlign=top width="100%">�û���:</TD>
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
                <TD  width="100%">�Ԅe:</TD>
                <TD width="55%">���� </TD></TR>
              <TR>
                <TD  width="100%">����:</TD>
                <TD width="55%">&nbsp;</TD></TR>
              <TR>
                <TD  width="100%">����:</TD>
                <TD width="55%">00-00</TD></TR>
              <TR>
                <TD  vAlign=top width="100%">���ҽ�B:</TD>
                <TD width="55%">&nbsp;</TD></TR></TABLE></TD>
          <TD width="30%" height="100%">
            <TABLE  cellSpacing=1 cellPadding=1  width="100%" class=border-a>
              
              <TR >
                <TD width="100%" colSpan=2>������Ϣ</TD>
              </TR>
              <TR >
                <TD align=center width="100%" colSpan=2><BR><BR></TD></TR>
              <TR>
                <TD  width="25%">��ҳ��</TD>
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
                <TD >�Ա�����:</TD>
                <TD  width="80%">&nbsp; </TD></TR>
              <TR>
                <TD >֧�����ʺ�:</TD>
                <TD  width="80%">&nbsp; 
  </TD></TR></TABLE></TD></TR></TABLE></TD></TR></TABLE><BR><BR></DIV>
<DIV class=maintable></DIV>












</BODY>
</HTML>
