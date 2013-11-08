<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">

<style type=text/css>
body {font: 10pt "Arial" ; /*background: #F6F6F6;*/color:#494949; }
p {font: 10pt/12pt "Arial"; color: black}
td {  font-size: 12px; line-height: normal,}
.border-a {
	font: 12px/normal "�l�r �o�S�V�b�N", "Osaka";
	border: 1px solid #999999;}
h1 {font: 15pt/17pt "Arial"; font-weight: bold; color: maroon}
h2 {font: 13pt/15pt "Arial"; font-weight: bold; color: blue}
input { font-size: 12px ; font-family: "����", "Osaka"}

</style>

</HEAD>

<BODY>
<?php 
include("../include/dbclass.php");
?>
<!--ͶƱ���� start-->
<table width="100%" height="100%" border="0" valign="center" ><tr><td align =center>
      <table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px" class=border-a>
        <tr> 
          <td class="tableline"><table width="100%" border="0" cellspacing="2" cellpadding="0">

              <tr> 
                <td bgcolor="#EEEEEE" class="14titletxt">ͶƱ�������</td>
              </tr>
              <tr> 
                <td style="padding-top:3px; padding-left:6px">Ŀǰ���е�ͶƱ��Ŀ </td>
              </tr>
              <tr> 
                <td align="center" valign="top"> 
                <input type="hidden" name="aidValue">
                  <table width="90%" border="1" cellspacing="0" cellpadding="0">

              											<tr>
														<td></td>
						<td colspan="2" class="toupiaopad">
						

<?php
$sql="select id,title from vote group by id desc";
$result=$db->query($sql);
while($row=$db->getarray($result)){
echo $row[id];

echo "<A HREF=\"\">$row[title]</A><br>";
}
?>
<div id="innermainContent">gfgfgfgf</div>
						</td>
						</tr>
						












				                  </table></td>
              </tr>
				<tr>
				<td height="36" align="center">
				</td>
				</tr>

            </table>
			
<DIV class=sidepanel id=Side_NewLogForPJBlog>
<H4 class=Ptitle>212121212121212121212121</H4>
<DIV class=Pcontent><A class=sideA 
title="admin 于 29/05/2006 10:14:36 发表该日志&#10;asp.net 更换皮肤的方法" 
href="http://evil.2ec.cn/default.asp?id=373">21212121212</A><A class=sideA 
title="admin 于 27/05/2006 21:23:02 发表该日志&#10;图片轮显的代码" 
href="http://evil.2ec.cn/default.asp?id=372">fdfdfdfdf/A><A class=sideA 
title="admin 于 22/05/2006 21:30:59 发表该日志&#10;推荐的菜单" 
href="http://evil.2ec.cn/default.asp?id=371">ffrfrfrf/A><A class=sideA 
title="admin 于 19/05/2006 17:30:31 发表该日志&#10;漂亮菜单" 
href="http://evil.2ec.cn/default.asp?id=370">thjtyk</A><A class=sideA 
title="admin 于 19/05/2006 17:25:02 发表该日志&#10;凹陷文字" 
href="http://evil.2ec.cn/default.asp?id=369">ytjuk</A><A class=sideA 
title="admin 于 19/05/2006 17:23:12 发表该日志&#10;3个菜单" 
href="http://evil.2ec.cn/default.asp?id=368">3yjyj/A><A class=sideA 
title="admin 于 19/05/2006 17:20:57 发表该日志&#10;两边对齐,适用新闻列表等" 
href="http://evil.2ec.cn/default.asp?id=367">jyje</A><A class=sideA 
title="admin 于 19/05/2006 17:18:21 发表该日志&#10;CSS实现阴影文字效果" 
href="http://evil.2ec.cn/default.asp?id=366">CREHT</A><A class=sideA 
title="admin 于 13/05/2006 12:46:20 发表该日志&#10;自动轮显" 
href="http://evil.2ec.cn/default.asp?id=365">VEHGEH</A><A class=sideA 
title="admin 于 10/05/2006 19:11:41 发表该日志&#10;子父窗口之间的操作" 
href="http://evil.2ec.cn/default.asp?id=364">FVERGH</A></DIV>
<DIV class=Pfoot></DIV></DIV>			
			
			
			
			
			
			
			</td>
        </tr>
      </table>
<!--����ͶƱ end-->
</BODY>
</HTML>
