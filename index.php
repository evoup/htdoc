<?php
/////////////////////////
function microtime_float()
{
     list($usec, $sec) = explode(" ", microtime());
     return ((float)$usec + (float)$sec);
}
$time_start = microtime_float();
/////////////////////////
define('IN_EVP', true);

define('MYVERSION',"1.0");//新版本号不是0了，而是1，为了升级
header("Expires: " .gmdate ("D, d M Y H:i:s", time() + 3600 * 24 * 30). " GMT");//一直使用缓存，如果缓存系统有的话
ob_start('ob_gzhandler'); 
include_once(dirname(__FILE__)."/include/global.php");//干掉全局变量
include_once(dirname(__FILE__)."/include/checkpostandget.php");
include_once(dirname(__FILE__).'/include/dbclass.php');
include_once(dirname(__FILE__)."/include/common.php");
include(dirname(__FILE__)."/include/classdate.php");
include_once(dirname(__FILE__)."/header.php");
include_once(dirname(__FILE__)."/footer.php");
require_once(dirname(__FILE__)."/inc/template.inc");
$tpl = new Template("template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[[["; //修改左边界符为[[[
$tpl->right_delimiter = "]]]"; //修改右边界符]]]
$skin='skin9';
$tpl->set_file("main", "$skin/main.html");
$templatedir="template/$skin/";

//console
include_once("include/session_mysql.php");
//session_start();
//判断是否登录，不登录，是游客，游客可以不显示?注意后台用session判断逻辑，前台用COOKIE
//if ($_SESSION['isLogin']!=''){//登录了，不是游客
//记录所在URI
//$_SESSION['URI']=request_uri();
//}
/*foreach ($_SESSION as $key=>$value){
printf($key."(".$value.")____");
}*/
//////////////////////登录向自己POST，该类能自己跳转到管理页///////////////////////////////
include($_SERVER['DOCUMENT_ROOT']."/include/class_access_user/access_user_class.php"); 
$my_access = new Access_user;
$my_access->login_reader();
// $my_access->language = "de"; // use this selector to get messages in other languages
if (isset($_GET['activate']) && isset($_GET['ident'])) { // this two variables are required for activating/updating the account/password
	//$my_access->auto_activation = false; // use this (true/false) to stop the automatic activation
	$my_access->activate_account($_GET['activate'], $_GET['ident']); // the activation method 
}
if (isset($_GET['validate']) && isset($_GET['id'])) { // this two variables are required for activating/updating the new e-mail address
	$my_access->validate_email($_GET['validate'], $_GET['id']); // the validation method 
}
if (isset($_POST['Submit_x'])) {//注意input type=image要写成_x的形式
	$my_access->save_login = (isset($_POST['remember'])) ? $_POST['remember'] : "no"; // use a cookie to remember the login
	$my_access->count_visit = true; // if this is true then the last visitdate is saved in the database
	$my_access->login_user($_POST['login'], $_POST['password']); // call the login method
} 
$error = $my_access->the_msg; 
///////////////////////////////////////////////////////////////////////////////////////////////
//session_start();
//include_once("include/loginif.php");
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
$consolestr.="<b>".$x."</b>,欢迎[[[xx]]]网,Sir</div>";
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
//console
showheader($templatedir,$tpl);
$tpl->set_var("nowtime", $nowt);
$tpl->set_var("myconsole", $consolestr);
$tpl->set_var("console_li", $console_listr);
$tpl->set_var("body", $body_str);
$tpl->set_var("logout_li", $logout_str);

if (MYVERSION=="1.0" and !isset($_SESSION['name']))//为了保留原来的loginbox字符赋值方式，改用嵌套模板
{//$tpl->set_var("loginbox", $loginboxstr);
$tpl->set_file(
	array(
	'my_loginbox'=>$skin.'/loginbox_new.html',//登录框
	'my_loginbox_well'=>$skin.'/loginbox_well.html',//登录成功后的登录框
	)
);

$postlogname=(isset($_POST['login'])) ? $_POST['login'] : $my_access->user;
$postpassword=(isset($_POST['password'])) ? $_POST['password'] : $my_access->user_pw;
$checkit=($my_access->is_cookie == true) ? " checked" : "";
$forgotURL="reg1/forgot_password.php";
$loginerr="<b>".(isset($error)) ? $error : "&nbsp;"."</b>";
$actionURL=$_SERVER['PHP_SELF'];

$tpl->set_var("postlogname",$postlognname);
$tpl->set_var("postpassword",$postpassword);
$tpl->set_var("checkit",$checkit);
$tpl->set_var("forgotURL",$forgotURL);
$tpl->set_var("loginerr",$loginerr);
$tpl->set_var("actionURL",$actionURL);
/////////////////////////////////////////////////////////

}
else//老版本了，好了就删掉
{
$tpl->set_file("my_loginbox","$skin/loginbox_new.html");
$tpl->set_var("loginbox", $loginboxstr);//否则就进入欢迎控制台
$tpl->set_var("loginbox","你是第22次登录。");
}



showfooter($templatedir,$tpl);

//最近的
//setcookie("lastbrow");
//for ($i=0;$i<91;$i++){}
//setcookie("lastbrow", '1|2|3|4',time()+3600);
//$ck=$_COOKIE['lastbrow'];
//$ckarray = explode('S', $ck);
//$tpl->set_var("lastbrowser", 's');

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
unset($row2);

//时尚
$tpl->set_block("main", "list", "nlist");  
$result2=$db->query("select * from article_content  where artrootid=1 order by id desc limit 0,5 ");
while ($row2 = mysql_fetch_array($result2))
{$time0=$row2['adddate'];
$title=utf8_substr($row2['title'],0,20);//完美截取中文字符UTF-8版
//print_r($row2['title']);
$Artcatlog1=$row2['title'];
if($row2['linkcolor']=='1'){$tpl->set_var("Artcatlog1", "<a href='article/readarticle.php?id=$row2[id]' id=redlink title='$Artcatlog1'>$title</a>");}
elseif($row2['linkcolor']=='2'){$tpl->set_var("Artcatlog1", "<a href='article/readarticle.php?id=$row2[id]' id=bluelink title='$Artcatlog1'>$title</a>");}
else{
$tpl->set_var("Artcatlog1", "<a href='article/readarticle.php?id=$row2[id]' title='$Artcatlog1'>$title</a>");
}
$tpl->set_var('listview0',"<a href='/article/articlelist.php?id=".rawurlencode('时尚')."&rootview=yes'><img src='image/more.gif' /></a>");
$tpl->set_var("time0", "$time0");$tpl->parse("nlist", "list", true);
}
unset($row2);

//数码
$tpl->set_block("main", "list1", "nlist1"); 
$result3=$db->query("select * from article_content  where artrootid=2 order by id desc limit 0,5");
while ($row3 = mysql_fetch_array($result3))
{
$title=utf8_substr($row3['title'],0,20);//完美截取中文字符UTF-8版	
if ($row3['isdispatch']=='1'){$tpl->set_var("zdgd_pic",'<img src=template/skin7/image/disp.gif title=发文 alt=发文></img>');}
else{$tpl->set_var("zdgd_pic",'');}
if($row3['linkcolor']=='1'){$setzdgdvar="<a href='article/readarticle.php?id=$row3[id]' id=redlink>$title</a>";}
elseif($row3['linkcolor']=='2'){$setzdgdvar="<a href='article/readarticle.php?id=$row3[id]' id=bluelink>$title</a>";}
else{$setzdgdvar="<a href='article/readarticle.php?id=$row3[id]' title='$row3[title]'>$title</a>";}
$tpl->set_var("Artcatlog2",$setzdgdvar);
$tpl->set_var("time1", "$row3[adddate]");
$tpl->set_var('listview1',"<a href='/article/articlelist.php?id=".rawurlencode('数码')."&rootview=yes'><img src='image/more.gif' /></a>");
unset($row3);
$tpl->parse("nlist1", "list1", true);
}

//娱乐
$tpl->set_block("main", "list2", "nlist2"); 
$result4=$db->query("select * from article_content  where artrootid=3 order by id desc limit 0,5");
while ($row4 = mysql_fetch_array($result4))
{
	$title=utf8_substr($row4['title'],0,18);//完美截取中文字符UTF-8版	
	if($row4['linkcolor']=='1'){$tpl->set_var("Artcatlog3", "<a href='article/readarticle.php?id=$row4[id]' id=redlink title='$row4[title]'>$title</a>");}
	elseif($row4['linkcolor']=='2'){$tpl->set_var("Artcatlog3", "<a href='article/readarticle.php?id=$row4[id]' id=bluelink title='$row4[title]'>$title</a>");}
	else{
	$tpl->set_var("Artcatlog3", "<a href='article/readarticle.php?id=$row4[id]' title='$row4[title]'>$title</a>");}
$tpl->set_var('listview2',"<a href='/article/articlelist.php?id=".rawurlencode('娱乐')."&rootview=yes'><img src='image/more.gif' /></a>");
$tpl->set_var("time2", "$row4[adddate]");$tpl->parse("nlist2", "list2", true);
}
unset($row4);

//情感两性
$tpl->set_block("main", "list3", "nlist3"); 
$result5=$db->query("select * from article_content  where artrootid=24 order by id desc limit 0,5");
while ($row5 = mysql_fetch_array($result5))
{
	$title=utf8_substr($row5['title'],0,18);//完美截取中文字符UTF-8版	
	if($row5['linkcolor']=='1'){$tpl->set_var("Artcatlog4", "<a href='article/readarticle.php?id=$row5[id]' id=redlink title='$row5[title]'>utf8_substr($row5[title],0,20)</a>");}
	elseif($row5['linkcolor']=='2'){$tpl->set_var("Artcatlog4", "<a href='article/readarticle.php?id=$row5[id]' id=bluelink title='$row5[title]'>$row5[title]</a>");}
	else{$tpl->set_var("Artcatlog4", "<a href='article/readarticle.php?id=$row5[id]' title='$row5[title]'>$title</a>");}
$tpl->set_var('listview3',"<a href='/article/articlelist.php?id=".rawurlencode('情感两性')."&rootview=yes'><img src='image/more.gif' /></a>");
$tpl->set_var("time3", "$row5[adddate]");$tpl->parse("nlist3", "list3", true);
}
unset($row5);
//英语
$tpl->set_block("main", "list4", "nlist4"); 
$result4=$db->query("select * from article_content  where artrootid=30 order by id desc limit 0,5");
while ($row = mysql_fetch_array($result4))
{
	$title=utf8_substr($row['title'],0,18);//完美截取中文字符UTF-8版	
	if($row['linkcolor']=='1'){$tpl->set_var("Artcatlog5", "<a href='article/readarticle.php?id=$row[id]' id=redlink  title='$row[title]'>$row[title]</a>");}
	elseif($row['linkcolor']=='2'){$tpl->set_var("Artcatlog5", "<a href='article/readarticle.php?id=$row[id]' id=bluelink  title='$row[title]'>$row[title]</a>");}
	else{
	$tpl->set_var("Artcatlog5", "<a href='article/readarticle.php?id=$row[id]' title='$row[title]'>$title</a>");}

$tpl->set_var("time5", "$row[adddate]");$tpl->parse("nlist4", "list4", true);
}



if (isset($_SESSION['name']))//同样登陆后才可以显示最近访问过的连接
{ $tpl->set_block("main", "list0", "nlist0"); 
//用2次聚组函数+order实现groupby后再排序
$sql="select browurl,urlname,max(lastviewed) from `lastbrow` where userid={$_SESSION[id]}  group by browurl order by max(lastviewed) desc limit 0,7";

$result5=$db->query($sql);
if (mysql_num_rows($result5)>0){
while ($row5=mysql_fetch_array($result5))
{$s1="<a href=$row5[0] alt=$row5[0] title=$row5[0]>".$row5[1]."</a>";$tpl->set_var("lastb", $s1);
$tpl->parse("nlist0", "list0", true);
}
}
else{$tpl->set_var("lastb", '');$tpl->parse("nlist0", "list0",false);}


}
else{$tpl->set_var("lastb", '未登录');}

/*include_once ('calendar/test1.php');
$tpl->set_var('calendar_s',$calins);
$tpl->set_var('calendar_s1');//第二个日历，不要了*/

$tpl->set_var('site_name',"嘉定365");
/*isset($_SESSION['name'])?$tpl->set_var("loginbox","你是第22次登录。<br>
上次登录时间是2008-03-22.<br>
<a href=#>立即阅读新消息(1)>></a><br>
了解朋友新情报，以及最新访客等<br>
<a href=#>立即访问个人中心>></a>")
:*/  //方法不好，增加服务器负担，改成全部解释生成静态，用DOM+COOKIE的办法


if (isset($_SESSION['user'])){
$tpl->parse("loginbox", "my_loginbox_well"); //解析嵌套模板登录框
}
else{
$tpl->parse("loginbox", "my_loginbox"); //解析嵌套模板登录框
}


$sql="select thumbpicid from article_content where thumbpicid<>'' and id= (select Max(id) from article_content)";

$result=$db->query($sql);
while ($row=$db->getarray($result)){
$tpl->set_var("thumbimg1",$row[thumbpicid]);
}

$sql="select * from bulletin order by id desc limit 5 ";
$result=$db->query($sql);
while ($row=$db->getarray($result)){
$out_bulletin.="<a href=>".$row['anncontent']."</a><br>";

}
$tpl->set_var("out_bulletin",$out_bulletin);

$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
/////////////
$time = $time_end - $time_start;
echo "</br><div align=center>Did nothing in $time seconds</div>\n";
///////////
?>