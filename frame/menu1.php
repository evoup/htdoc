<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> menu </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">

<link rel=stylesheet href="../css/css.css" type="text/css">


</HEAD>

<BODY>
<?php
//echo $_GET["action"];
if($_GET["action"]== strval( logout))
{
	echo "���Ѿ��ǳ�ϵͳ!";
session_start(); 
// ���ַ����ǽ�ԭ��ע���ĳ����������
unset($_SESSION [��name��]); 

// ���ַ������������� Session �ļ�
session_destroy(); 

//����frame
echo "<SCRIPT LANGUAGE=JAVASCRIPT>\n";
echo "<!-- \n";
echo "if (top.location !== self.location) {\n";
echo "top.location=self.location;\n";
echo "}\n";
echo "</SCRIPT>\n";

}





session_start();
if (isset($_SESSION[��name��])) 
{ 
echo "���Ѿ��ɹ���½"; 
} 
else 
{ 
// ��֤ʧ�ܣ��� $_SESSION["admin"] ��Ϊ false
$_SESSION[��name��] = false; 
die("����Ȩ���ʱ���Ŀ!"); 
}

//echo $_GET["action"];
if($_GET["action"]== strval( logout))
{
	echo "��ѡ��ǳ�!";
session_start(); 
// ���ַ����ǽ�ԭ��ע���ĳ����������
unset($_SESSION [��name��]); 

// ���ַ������������� Session �ļ�
session_destroy(); 




}

//include("../include/session_mysql.php");
?>
<span class="bold">&raquo;</span>���,
<?php 
session_start();
//echo $_SESSION[��var1��]; 
$x=$_SESSION [��name��];
echo $x ;

//echo '���ݵ�session����var1��ֵΪ��'.$_SESSION[��var1��]; 
//if(isset($_SESSION[��name��]))
//{echo '�Ѿ�ͨ����֤';
//}

?><br>
<a href=<?php echo"$PHP_SELF?action=logout";?>>�ǳ�</a>

<!-- <A HREF="../ceshi.php">����</A> --><A HREF="">����Ϣ</A><BR><BR><BR>
<!-- <TABLE border=0>
<TR>
	<TD ><A HREF="../addlist/admin.php" target=mainFrame>�������</A></TD>
</TR>
<TR>
	<TD ><A HREF="../addlist/admin.php" target=mainFrame>�칫��Ʒ����</A></TD>
</TR>


<TR>
	<TD ><A HREF="../addlist/admin.php" target=mainFrame>ͨѶ¼����</A></TD>
</TR>
<TR>
	<TD><A HREF="../addlist/addlist.php" target="mainFrame">ͨѶ¼</A></TD>
</TR>
<TR>
	<TD>֪ʶ�����</TD>
</TR>
<TR>
	<TD>֪ʶ��</TD>
</TR>
<TR>
	<TD>��ҵ����</TD>
</TR>
<TR>
	<TD>���˹���</TD>
</TR>
</TABLE> -->




<DIV id=lselect>
<H3 class=select><SPAN>ѡ��һ������:</SPAN></H3>
<UL>
<LI> <A class=c href="http://deepblue.indika.net.id/">�������</A> </LI>
<LI><A class=c href="../addlist/admin.php" target="mainFrame">�칫��Ʒ����</A> </LI>
<LI><A class=c href="../addlist/admin.php" target="mainFrame">ͨѶ¼����</A> </LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">ͨѶ¼</A> </LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">֪ʶ�����</A></LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">֪ʶ��</A></LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">��ҵ����</A></LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">���˹���</A></LI>
</UL></DIV>










</BODY>
</HTML>
