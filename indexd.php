<?php
include_once("include/checkpostandget.php");
include_once('include/dbclass.php');
include_once("include/common.php");include("include/classdate.php");
include_once("header.php");
include_once("footer.php");
require_once "inc/template.inc";
$tpl = new Template("template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "skin9/main.html");
$templatedir="template/skin9/";

//console
include_once("include/session_mysql.php");
session_start();
include_once("include/loginif.php");

$nowtim=new date();
$nowt=$nowtim->display();

if (isset($_SESSION['name'])) 
{
//echo "您已经成功登陆<br>"; 

$x=$_SESSION ['name'];
$y=$_SESSION ['staff'];
$z=$_SESSION['sex'];
$consolestr= "<div id=usrbar><div id=welcome>";
if (@intval($z)==0){
$consolestr.="<img src='../image/tm1.gif' />&nbsp;&nbsp;";}
else if (@intval($z)==1){
$consolestr.="<img src='../image/tm2.gif' />&nbsp;&nbsp;";}
$consolestr.="<b>".$x."</b>,欢迎登录佳艺内网</div>";
//$consolestr.="<SCRIPT LANGUAGE=\"JavaScript\" src='frame/ajaxmsg_i.js'></SCRIPT>\n";
$consolestr.= "<div id=mailst><IMG SRC=\"image/mail2.gif\"  BORDER=\"0\" ALT=\"\" style='margin-right:10px'>您有<A  HREF=\"messenge/msgview_i.php\" \n";
$consolestr.= ">[<span id=msgunread style='display:inline'>0</span>]</A>个短消息未读</div>";
$consolestr.= "<div style=\"position: absolute; width: 140px; top: 40px; left: 0px;  padding: 5px; \n";
$consolestr.= "overflow: auto;\">";
$consolestr.= "</div><div id=leijia value=0></div>\n";
$console_listr='<li><a href=console.php>我的控制台</a></li>';
$body_str="<body onload='go(); ' id=bodytag>";
$logout_str="|<A HREF=index.php?action=logout>退出</A></div>";
$loginboxstr='';//登陆界面窗体不用了
} 
else
{ 
// 验证失败，将 $_SESSION["admin"] 置为 false
$loginboxstr="\n";


$loginboxstr.= "<SCRIPT LANGUAGE=\"JavaScript\" type=\"text/javascript\">\n";
$loginboxstr.= "<!--\n";
$loginboxstr.= "function alertx(){\n";
$loginboxstr.= "	if (document.getElementById('logname').value==\"\")\n";
$loginboxstr.= "	{\n";
$loginboxstr.= "		alert(\"请填写用户名！\");\n";
$loginboxstr.= "		return false;\n";
$loginboxstr.= "	}\n";
$loginboxstr.= "	if (document.getElementById('password').value==\"\")\n";
$loginboxstr.= "	{\n";
$loginboxstr.= "		alert(\"请填写密码！\");\n";
$loginboxstr.= "		return false;\n";
$loginboxstr.= "	}\n";
$loginboxstr.= "}\n";
$loginboxstr.= "//-->\n";
$loginboxstr.= "</SCRIPT>\n";
$loginboxstr.= "\n";
$loginboxstr.= "\n";
$loginboxstr.= "\n";
$loginboxstr.= "<FORM id=fm METHOD=POST ACTION=\"validate_i.php\" onsubmit=\"javascript :return alertx();\" \n";
$loginboxstr.= "autocomplete = \"off\">\n";

$loginboxstr.= "\n";//下面是登录窗体的背景
$loginboxstr.= "<div id=loginbox_bg2><TABLE class=tableborder   cellSpacing=3 cellPadding=4 width=185   height=176 align=center border=0  \n";
$loginboxstr.= "valign=center>\n";
$loginboxstr.= "<tr >\n";
$loginboxstr.= "<td class=header_skin6 colspan=2 style='font-size: 14px;text-align:center;'> &nbsp; </td>\n";
$loginboxstr.= "</tr>\n";
$loginboxstr.= "<TR >\n";
$loginboxstr.= "	<TD  align=center style='font-size:12px;font-weight:bold'>用户名：</TD>\n";
$loginboxstr.= "	<TD>\n";
$loginboxstr.= "	<INPUT TYPE=\"text\" NAME=\"logname\" id = \"logname\" size=19 class=textare \n";
$loginboxstr.= "style=\"width:60px;border-style:solid;border-width:1;padding-left:4;padding-right:4;padd\n";
$loginboxstr.= "ing-top:1;padding-bottom:1\">\n";
$loginboxstr.= "	</TD>\n";
$loginboxstr.= "</TR>\n";
$loginboxstr.= "<TR>\n";
$loginboxstr.= "	<TD align=center style='font-size:12px;font-weight:bold'>密&nbsp;&nbsp;码：</TD>\n";
$loginboxstr.= "	<TD><INPUT TYPE=\"password\" name=\"password\" id=\"password\" class=textare  \n";
$loginboxstr.= "style=\"width:60px;border-style:solid;border-width:1;padding-left:4;padding-right:4;padd\n";
$loginboxstr.= "ing-top:1;padding-bottom:1\">\n";
$loginboxstr.= "	</TD>\n";
$loginboxstr.= "</TR>\n";
$loginboxstr.= "<TR >\n";
$loginboxstr.= "<td><INPUT TYPE=\"button\" value='忘记密码' class='inp5' onsubmit='alert('g');'></td>	<TD  ><INPUT TYPE=\"submit\" value=\"登&nbsp;&nbsp;录\" \n";
$loginboxstr.= "class='inp5'></TD>\n";
$loginboxstr.= "	</TR>\n";
$loginboxstr.= "</TABLE></div><BR><DIV ALIGN=\"center\"></DIV>\n";

$loginboxstr.= "</FORM>\n";
//die("您无权访问本栏目!"); 
//$console_listr='这里是没登陆的控制台';
$console_listr='';
$body_str="<body id=bodytag>";
$logout_str='';
}





//console

showheader($templatedir,$tpl);
$tpl->set_var("nowtime", $nowt);
$tpl->set_var("myconsole", $consolestr);
$tpl->set_var("console_li", $console_listr);
$tpl->set_var("body", $body_str);
$tpl->set_var("logout_li", $logout_str);
$tpl->set_var("loginbox", $loginboxstr);
showfooter($templatedir,$tpl);

//最近的
//setcookie("lastbrow");
//for ($i=0;$i<91;$i++){}
//setcookie("lastbrow", '1|2|3|4',time()+3600);



 //$ck=$_COOKIE['lastbrow'];

//$ckarray = explode('S', $ck);


//$tpl->set_var("lastbrowser", 's');

//最新安排
//$tpl->set_var("arrangetitle", "各级部门注意");
//$tpl->set_var("arrangetime", "2006-12-7");

//网站公告

$result2=$db->query("select * from bulletin order by id limit 0,1");
while ( $row2 = mysql_fetch_array($result2))
{$sitenewstime=strval($row2['time']);
$content=csubstr(safe_convert($row2['content'],1),'0','160');

$numofsize=cutchs($row2['content']);
if ($numofsize>160)
	{$content=$content.'...';
$tpl->set_var("siteshortnews", "<a href='bulletin/readbulletin.php?id=$row2[id]' title='$row2[content]【单击左键查看全部内容】'>$content</a>");
}
else{$tpl->set_var("siteshortnews", "<a href='bulletin/readbulletin.php?id=$row2[id]'>$content</a>");
}
}
$tpl->set_var("sitenewstime", "$sitenewstime");


//网上办事
$tpl->set_block("main", "list", "nlist");  
//$result2=$db->query("select t1.* from article_content as t1  inner join article as t2 on t1.artid=t2.id and t1.artid=1 limit 0,4");
$result2=$db->query("select * from article_content  where artrootid=1 order by id desc limit 0,5 ");
while ($row2 = mysql_fetch_array($result2))
{$time0=$row2['adddate'];
$onlinework=$row2['title'];
if($row2['linkcolor']=='1'){$tpl->set_var("onlinework", "<a href='article/readarticle.php?id=$row2[id]' id=redlink title='$onlinework'>$onlinework</a>");}
elseif($row2['linkcolor']=='2'){$tpl->set_var("onlinework", "<a href='article/readarticle.php?id=$row2[id]' id=bluelink title='$onlinework'>$onlinework</a>");}
else{
$tpl->set_var("onlinework", "<a href='article/readarticle.php?id=$row2[id]' title='$onlinework'>$onlinework</a>");
}


$tpl->set_var("time0", "$time0");$tpl->parse("nlist", "list", true);
}
$tpl->set_var("bywho", "by <a href=#>行政部</a>");
//制度规定
$tpl->set_block("main", "list1", "nlist1"); 
$result3=$db->query("select * from article_content  where artrootid=2 order by id desc limit 0,5");
while ($row3 = mysql_fetch_array($result3))
{
if ($row3['isdispatch']=='1'){$tpl->set_var("zdgd_pic",'<img src=template/skin7/image/disp.gif title=发文 alt=发文></img>');}
else{$tpl->set_var("zdgd_pic",'');}
if($row3['linkcolor']=='1'){$setzdgdvar="<a href='article/readarticle.php?id=$row3[id]' id=redlink>$row3[title]</a>";}
elseif($row3['linkcolor']=='2'){$setzdgdvar="<a href='article/readarticle.php?id=$row3[id]' id=bluelink>$row3[title]</a>";}
else{$setzdgdvar="<a href='article/readarticle.php?id=$row3[id]'>$row3[title]</a>";}



$tpl->set_var("zdgd",$setzdgdvar);

$tpl->set_var("time1", "$row3[adddate]");




$tpl->parse("nlist1", "list1", true);
}
//会议纪要
$tpl->set_block("main", "list2", "nlist2"); 
$result4=$db->query("select * from article_content  where artrootid=3 order by id desc limit 0,5");
while ($row4 = mysql_fetch_array($result4))
{
	if($row4['linkcolor']=='1'){$tpl->set_var("hyjy", "<a href='article/readarticle.php?id=$row4[id]' id=redlink>$row4[title]</a>");}
	elseif($row4['linkcolor']=='2'){$tpl->set_var("hyjy", "<a href='article/readarticle.php?id=$row4[id]' id=bluelink>$row4[title]</a>");}
	else{	$tpl->set_var("hyjy", "<a href='article/readarticle.php?id=$row4[id]'>$row4[title]</a>");}

$tpl->set_var("time2", "$row4[adddate]");$tpl->parse("nlist2", "list2", true);
}


if (isset($_SESSION['name']))//同样登陆后才可以显示最近访问过的连接
{ $tpl->set_block("main", "list0", "nlist0"); 
$sql="select browurl,urlname from `lastbrow` where userid={$_SESSION[id]} order by id desc limit 0,7";

$result5=$db->query($sql);
if (mysql_num_rows($result5)>0){
while ($row5=mysql_fetch_array($result5))
{$s1="<a href=$row5[0] alt=$row5[0] title=$row5[0]>".$row5[1]."</a>";$tpl->set_var("lastb", $s1);
$tpl->parse("nlist0", "list0", true);
}
}
else{$tpl->set_var("lastb", '');$tpl->parse("nlist0", "list0",false);}


}
else{$tpl->set_var("lastb", '抱歉，未登录');}

include_once ('calendar/test1.php');
$tpl->set_var('calendar_s',$calins);
$tpl->set_var('calendar_s1',"");//第二个日历，不要了

$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>