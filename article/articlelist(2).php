<?php
define('IN_EVP', true);
ob_start();
include(dirname(__FILE__)."/../include/checkpostandget.php");
include(dirname(__FILE__).'/../include/dbclass.php');
include(dirname(__FILE__)."/../include/common.php");
include_once(dirname(__FILE__)."/../header.php");
include_once(dirname(__FILE__)."/../footer.php");
require dirname(__FILE__)."/../inc/template.inc";

$tpl = new Template(dirname(__FILE__)."/../template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$skinname="skin9";

$tpl->set_file("main","$skinname/articlelist.html");
$templatedir=dirname(__FILE__)."/../template/$skinname/";
include(dirname(__FILE__)."/../include/session_mysql.php");
session_start();
include(dirname(__FILE__)."/../include/loginif.php");


if ($_GET['id']=='网上办事'){$idc2="id='current'\"";$idc=$idc3='';}
if ($_GET['id']=='制度规定'){$idc3="id='current'\"";$idc=$idc2='';}
$tpl->set_var("node",$_GET['id']);
$menuli ="<li><a href=\"../index.php\" ".$idc.">首  页</a></li><li><a \n";
$menuli .= "href=\"../article/articlelist.php?id=网上办事&rootview=yes\" ".$idc2.">网上办事</a></li><li><a \n";
$menuli .= "href=\"../article/articlelist.php?id=制度规定&rootview=yes\" ".$idc3.">制度规定</a></li><li><a \n";
$menuli .= "href=\"#\">选 项</a></li>";

showheader($templatedir,$tpl,2);
$tpl->set_var("menu_li",$menuli);



if (isset($_SESSION['name'])) 
{$console_listr='<li><a href=../console.php>我的控制台</a></li>';}
else{$console_listr='';}

$tpl->set_var("console_li",$console_listr);
$tpl->set_var("loginbox");
$tpl->set_var("myconsole");
$tpl->set_var("logout_li");


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






$pid=safe_convert($_GET['id']);
$rootview=safe_convert($_GET['rootview']);
//最新安排



//$pid=safe_convert($_GET['id']);
//a list of articles
$tpl->set_block("main", "list", "nlist");  
//$result2=$db->query("select t1.* from article_content as t1  inner join article as t2 on t1.artid=t2.id and t1.artid=1 limit 0,4");

//$result2=$db->query("select * from article_content where artrootid=$pid");

if ($rootview=='yes'){
$result2=$db->query("select t1.* from `article_content` as t1,`article` as t2 where t2.artclass='{$pid}' and t1.artrootid=t2.rootid order by id desc");}//全部
else{
$result2=$db->query("select t1.* from `article_content` as t1,`article` as t2 where t2.artclass='{$pid}' and t1.artrootid=t2.rootid and t2.id=t1.artid");}//单个

while ($row2 = mysql_fetch_array($result2))
{//$time0=$row2['adddate'];

$tpl->set_var("article_list_title", "<a href=readarticle.php?id=$row2[id] >$row2[title]</a>");
$tpl->set_var("article_list_time", "$row2[adddate]");
$tpl->set_var("time0", "$time0");$tpl->parse("nlist", "list", true);
}


$tpl->set_var("SITENAME",SITENAME);


showfooter($templatedir,$tpl);



$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>