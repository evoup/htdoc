<HTML>
<HEAD>
<TITLE> ��ӭ </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=gb2312">

<META   HTTP-EQUIV="pragma"   CONTENT="no-cache">   
<META   HTTP-EQUIV="Cache-Control"   CONTENT="no-cache,   must-revalidate">   
<META   HTTP-EQUIV="expires"   CONTENT="Wed,   26   Feb   1997   08:21:57   GMT"> 



</HEAD>
<link rel=stylesheet href="../css/css.css" type="text/css">
<BODY topmargin="0" leftmargin ="0" bgcolor=>
<?php
include("../include/session_mysql.php");
include('../include/UsersOnline3.php');
session_start(); 
if($_GET["action"]== strval( logout))
{
echo "���Ѿ��ǳ�ϵͳ!";
// ���ַ����ǽ�ԭ��ע���ĳ����������
unset($_SESSION ['name']); 
unset($_SESSION ['staff']);
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
if (isset($_SESSION['name'])) 
{ 
//echo "���Ѿ��ɹ���½<br>"; 
} 
else 
{ 
// ��֤ʧ�ܣ��� $_SESSION["admin"] ��Ϊ false
//$_SESSION[��name��] = false; 
die("����Ȩ���ʱ���Ŀ!"); 
}
?>
<table cellspacing="0" border="0" cellpadding="0">
    <tbody><tr id="header">
      <td id="headerlogo"><A HREF="../vote/vote1.php" target="mainFrame"  onfocus="blur()"><IMG SRC="../image/logo.png"  title="EVOUP Intranet OA System  --powered by evoup"  BORDER="0"></A><!-- <img src="../image/logo.png" alt="EVOUP Intranet OA System  --powered by evoup" height="64" width="200"> --></td>
      <td id="headerbanner"><IMG SRC="../image/xiaomi.gif"  BORDER="0" ALT=""><span class="bold">&raquo;</span>
	  <?php 
		session_start();
		//echo $_SESSION[��var1��]; 
		$x=$_SESSION ['name'];
		$y=$_SESSION ['staff'];
		echo "���ã�<b>".$x."</b>!"." �����ǣ�";
echo $showtime=date('Y-m-d');
		//echo "[$y]";

		//echo '���ݵ�session����var1��ֵΪ��'.$_SESSION[��var1��]; 
		//if(isset($_SESSION[��name��]))
		//{echo '�Ѿ�ͨ����֤';
		//}






		?><!-- <?php echo $showtime=date('Y-m-d');?>  -->
		<SCRIPT LANGUAGE="JavaScript" src="../js/static/time2.js"></SCRIPT>
		��ǰ���ߣ�<?php
		
		//��ʼ����
$ol = new UsersOnline(false);

//get rid of the old records
$ol->refresh();

//who is at my site?

//��ֻ��Ϊ����addvisitor����-_-!
//ADDING A USER, NO REPORTING
$ol = new UsersOnline(true);
$ol->printNumber("site");
		
		
		
		?>��
<a href=<?php echo"$PHP_SELF?action=logout";?>>�˳�</a>
</td>
    </tr>
    <tr>
      <td id="headerbar" colspan="2">&nbsp;</td>
    </tr>
  </tbody></table>
</BODY>
</HTML>