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
	font: 12px/normal "俵俽 俹僑僔僢僋", "Osaka";
	border: 1px solid #999999;}
h1 {font: 15pt/17pt "Arial"; font-weight: bold; color: maroon}
h2 {font: 13pt/15pt "Arial"; font-weight: bold; color: blue}
input { font-size: 12px ; font-family: "宋体", "Osaka"}

</style>

</HEAD>

<BODY>
<?php 
include("../include/dbclass.php");
?>
<!--投票管理 start-->
<table width="100%" height="100%" border="0" valign="center" ><tr><td align =center>
      <table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px" class=border-a>
        <tr> 
          <td class="tableline"><table width="100%" border="0" cellspacing="2" cellpadding="0">

              <tr> 
                <td bgcolor="#EEEEEE" class="14titletxt">投票分类管理</td>
              </tr>
              <tr> 
                <td style="padding-top:3px; padding-left:6px">目前已有的投票项目 </td>
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
title="admin 浜� 29/05/2006 10:14:36 鍙戣〃璇ユ棩蹇�&#10;asp.net 鏇存崲鐨偆鐨勬柟娉�" 
href="http://evil.2ec.cn/default.asp?id=373">21212121212</A><A class=sideA 
title="admin 浜� 27/05/2006 21:23:02 鍙戣〃璇ユ棩蹇�&#10;鍥剧墖杞樉鐨勪唬鐮�" 
href="http://evil.2ec.cn/default.asp?id=372">fdfdfdfdf/A><A class=sideA 
title="admin 浜� 22/05/2006 21:30:59 鍙戣〃璇ユ棩蹇�&#10;鎺ㄨ崘鐨勮彍鍗�" 
href="http://evil.2ec.cn/default.asp?id=371">ffrfrfrf/A><A class=sideA 
title="admin 浜� 19/05/2006 17:30:31 鍙戣〃璇ユ棩蹇�&#10;婕備寒鑿滃崟" 
href="http://evil.2ec.cn/default.asp?id=370">thjtyk</A><A class=sideA 
title="admin 浜� 19/05/2006 17:25:02 鍙戣〃璇ユ棩蹇�&#10;鍑归櫡鏂囧瓧" 
href="http://evil.2ec.cn/default.asp?id=369">ytjuk</A><A class=sideA 
title="admin 浜� 19/05/2006 17:23:12 鍙戣〃璇ユ棩蹇�&#10;3涓彍鍗�" 
href="http://evil.2ec.cn/default.asp?id=368">3yjyj/A><A class=sideA 
title="admin 浜� 19/05/2006 17:20:57 鍙戣〃璇ユ棩蹇�&#10;涓よ竟瀵归綈,閫傜敤鏂伴椈鍒楄〃绛�" 
href="http://evil.2ec.cn/default.asp?id=367">jyje</A><A class=sideA 
title="admin 浜� 19/05/2006 17:18:21 鍙戣〃璇ユ棩蹇�&#10;CSS瀹炵幇闃村奖鏂囧瓧鏁堟灉" 
href="http://evil.2ec.cn/default.asp?id=366">CREHT</A><A class=sideA 
title="admin 浜� 13/05/2006 12:46:20 鍙戣〃璇ユ棩蹇�&#10;鑷姩杞樉" 
href="http://evil.2ec.cn/default.asp?id=365">VEHGEH</A><A class=sideA 
title="admin 浜� 10/05/2006 19:11:41 鍙戣〃璇ユ棩蹇�&#10;瀛愮埗绐楀彛涔嬮棿鐨勬搷浣�" 
href="http://evil.2ec.cn/default.asp?id=364">FVERGH</A></DIV>
<DIV class=Pfoot></DIV></DIV>			
			
			
			
			
			
			
			</td>
        </tr>
      </table>
<!--在线投票 end-->
</BODY>
</HTML>
