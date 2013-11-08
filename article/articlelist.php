<?php
define('IN_EVP', true);
ob_start();
include(dirname(__FILE__)."/../include/checkpostandget.php");
include(dirname(__FILE__).'/../include/dbclass.php');
include(dirname(__FILE__)."/../include/common.php");
//include_once(dirname(__FILE__)."/../header_smarty.php");
//include_once(dirname(__FILE__)."/../footer_smarty.php");
require_once(dirname(__FILE__)."/../include/smarty_libs/Smarty.class.php");
require dirname(__FILE__)."/../inc/template.inc";


$smarty = new Smarty();
//$smarty->caching=true;
//To do 加入自定义缓存函数
//$smarty->force_compile=true;
$smarty->cache_dir=dirname(__FILE__).'/../cache/';
$smarty->template_dir = dirname(__FILE__).'/../templates/';
$smarty->compile_dir  =dirname(__FILE__).'/../templates_c/';
//$smarty->config_dir   = '/web/www.example.com/guestbook/configs/';
$smarty->cache_dir    = dirname(__FILE__).'/../cache/';
$smarty->left_delimiter='[##';
$smarty->right_delimiter='##]';

//$tpl = new Template(dirname(__FILE__)."/../template");

//evoupV1.1 phplibupdate
//$tpl->unknowns = "keep";
//$tpl->left_delimiter = "[##"; //修改左边界符为[##
//$tpl->right_delimiter = "##]"; //修改右边界符##]
//$skinname="skin9";

//$tpl->set_file("main","$skinname/articlelist.html");
//$templatedir=dirname(__FILE__)."/../template/$skinname/";
include(dirname(__FILE__)."/../include/session_mysql.php");
session_start();
include(dirname(__FILE__)."/../include/loginif.php");




//showheader($templatedir,$tpl,2);
//$tpl->set_var("menu_li",$menuli);
$smarty->assign("menu_li",$menuli);


/*if (isset($_SESSION['name'])) 
{$console_listr='<li><a href=../console.php>我的控制�?</a></li>';}
else{$console_listr='';}*/

//$tpl->set_var("console_li",$console_listr);
//$tpl->set_var("loginbox");
//$tpl->set_var("myconsole");
//$tpl->set_var("logout_li");


//
if (isset($_SESSION['name']))//同样登陆后才可以显示�?近访问过的连�?
{ 
$sql="select browurl,urlname from `lastbrow` where userid={$_SESSION[id]}";

$result5=$db->query($sql);

while ($row5=mysql_fetch_array($result5))
{$s1="<a href=$row5[0] alt=$row5[0] title=$row5[0]>".$row5[1]."</a>";

}

//$tpl->set_var("lastb", $s1);
$smarty->assign("lastb", $s1);
}
else{
	//$tpl->set_var("lastb", '抱歉，未登录');
	$smarty->assign("lastb", '抱歉，未登录');
}
//


$pid=safe_convert($_GET['id']);
if(strlen($pid)>30) //长度超过30明显是不可能的，判断为溢出攻击
										die('hacking attemped');
$rootview=safe_convert($_GET['rootview']);





if ($rootview=='yes'){
	$sql="select t1.* from `article_content` as t1,`article` as t2 where t2.artclass='{$pid}' and t1.artrootid=t2.rootid order by id desc";
$result2=$db->query($sql);}//全部
if (!$result2) {
	echo ("对不起，没有找到这篇文章！");//没找到
	header("refresh:5;URL=../index.php");
	die();
}
else{
$result2=$db->query("select t1.* from `article_content` as t1,`article` as t2 where t2.artclass='{$pid}' and t1.artrootid=t2.rootid and t2.id=t1.artid");}//单个

/*while ($row2 = mysql_fetch_array($result2))
{//$time0=$row2['adddate'];

//$tpl->set_var("article_list_title", "<a href=readarticle.php?id=$row2[id] >$row2[title]</a>");
//$tpl->set_var("article_list_time", "$row2[adddate]");
//$tpl->set_var("time0", "$time0");
//$tpl->parse("nlist", "list", true);

$smarty->assign("article_list_title", "<a href=readarticle.php?id=$row2[id] >$row2[title]</a>");
$smarty->assign("article_list_time", "$row2[adddate]");
$smarty->assign("time0", "$time0");



}*/
//$row3=mysql_fetch_array($result2);
$newslist=array();
while($rs = mysql_fetch_array($result2)) {
array_push($newslist,'<li><a href=readarticle.php?id='.$rs[id].'>'.$rs['title'].'</a></li>');	
}

/*print_r($newslist);
die();*/
$smarty->assign('artid',$newslist);

//$tpl->set_var("SITENAME",SITENAME);
$smarty->assign("SITENAME",SITENAME);
$smarty->assign("site_dir",'../');
//showfooter($templatedir,$tpl);


//$tpl->parse("mains", "main");
//$tpl->pparse("mains", "main");


$smarty->display('skin9/articlelist.html');
?>