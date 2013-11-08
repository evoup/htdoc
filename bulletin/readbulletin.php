<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");
include('../include/dbclass.php');
include("../include/common.php");
include_once("../header.php");
include_once("../footer.php");
include("../include/session_mysql.php");
include ('../include/naviclass.php');
session_start();
include("../include/loginif.php");

if (isset($_SESSION['name'])) 
{$console_listr='<li><a href=../console.php>我的控制台</a></li>';}
else{$console_listr='';}






$pid=safe_convert($_GET['id']);
$ck=$_COOKIE['lastbrow'];
setcookie("lastbrow",$ck.'S'.strval($pid),time()+3600,'/');
ob_end_flush() ;
require "../inc/template.inc";
$tpl = new Template("../template");
$templatedir="../template/skin7/";
//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; 
$tpl->right_delimiter = "##]"; 
$tpl->set_file("main", "skin7/readbulletin.html");
showheader($templatedir,$tpl);
$tpl->set_var("console_li", $console_listr);
$tpl->set_var("mainidx", "<a href='../index.php'>佳艺内网</a>");
$tpl->set_var("subidx", "<a href='bulletinlist.php'>公告中心</a>");

$tpl->set_var("myconsole",'');
$tpl->set_var("logout_li",'');
$tpl->set_var("loginbox",'');


//
if (isset($_SESSION['name']))//同样登陆后才可以显示最近访问过的连接
{ 
$sql="select browurl,urlname from `lastbrow` where userid={$_SESSION[id]}";

$result5=$db->query($sql);

while ($row5=mysql_fetch_array($result5))
{$s1="<a href=$row5[0] alt=$row5[0] title=$row5[0]>".$row5[1]."</a>";

}

$tpl->set_var("lastb", $s1);

}
else{$tpl->set_var("lastb", '抱歉，未登录');}

//



$result=$db->query("select t1.*,t2.depname from article_content as t1 join department as t2 on t1.bywhoid=t2.id where t1.id=$pid limit 0,1 ");
while ( $row = mysql_fetch_array($result))
{
$tpl->set_var("articletitle", "$row[title]");
$tpl->set_var("articlecontent","$row[content]");
$tpl->set_var("artbywho","$row[depname]");
$tpl->set_var("adddate","$row[adddate]");



$artid=$row['artid'];//这个给下面的navi参数
}

//$result=$db->query("select id from where article where ");
//加个navi
//$x=&new navismallbar($artid);
$x=&new navismallbar($artid);
//$x->echox();//测试方法
$navistr=$x->dbecho();
$tpl->set_var("snavi", "$navistr");
//unset($x);








$result=$db->query("select * from bulletin where id=$pid limit 0,1");



while ( $row = mysql_fetch_array($result))
{
$tpl->set_var("bulletintitle", "$row[title]");$bulletin_content=getcontent($row[content]);
$tpl->set_var("bulletincontent","$bulletin_content");$tpl->set_var("articletitle", "$row[title]");
//$tpl->set_var("artbywho","$row[depname]");
}

function Encode($str){
if(!get_magic_quotes_gpc()){
$str = addslashes($str);
}
$str = htmlspecialchars($str);
$str = str_replace("\r\n","<br>",$str);
$str = str_replace("\r","<br>",$str);
$str = str_replace("\n","<br>",$str);
$str = str_replace(" ","　",$str);
$str = str_replace("'","’",$str);
return $str;
}
//网站公告
$result2=$db->query("select * from bulletin where id='1'");
while ( $row2 = mysql_fetch_array($result2))
{$sitenewstime=$row2['time'];
//$content=getcontent($row2['content'],1,1,1);
//$content=Encode($row2['content']);
$content=$row2['content'];
}
$tpl->set_var("sitenewstime", "$sitenewstime");
$tpl->set_var("siteshortnews", "<a href=#>$content</a>");

//网上办事
$tpl->set_block("main", "list", "nlist");  
//$result2=$db->query("select t1.* from article_content as t1  inner join article as t2 on t1.artid=t2.id and t1.artid=1 limit 0,4");
$result2=$db->query("select * from article_content  where artid=1 limit 0,4");
while ($row2 = mysql_fetch_array($result2))
{$time0=$row2['adddate'];
$onlinework=$row2['title'];
$tpl->set_var("onlinework", "<a href=#>$onlinework</a>");
$tpl->set_var("time0", "$time0");$tpl->parse("nlist", "list", true);
}
$tpl->set_var("bywho", "by <a href=#>行政部</a>");
//制度规定
$tpl->set_block("main", "list1", "nlist1"); 
$result3=$db->query("select * from article_content  where artid=2 limit 0,4");
while ($row3 = mysql_fetch_array($result3))
{$tpl->set_var("zdgd", "<a href=#>$row3[title]</a>");
$tpl->set_var("time1", "$row3[adddate]");$tpl->parse("nlist1", "list1", true);
}
showfooter($templatedir,$tpl);
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>