<?php
header("Expires: " .gmdate ("D, d M Y H:i:s", time() + 3600 * 24 * 30). " GMT");//一直使用缓存，如果缓存系统有的话
ob_start('ob_gzhandler');
//////////////////////////////////////////////////////
function microtime_float()
{
     list($usec, $sec) = explode(" ", microtime());
     return ((float)$usec + (float)$sec);
}
$time_start = microtime_float();
//////////////////////////////////////////////////////
define('IN_EVP', true);
//include("../include/checkpostandget.php");
include (dirname(__FILE__).'/../include/define.php');
include (dirname(__FILE__).'/../include/naviclass.php');
include(dirname(__FILE__)."/../include/common.php");
include(dirname(__FILE__).'/../include/dbclass.php');
include_once(dirname(__FILE__)."/../header.php");
include_once(dirname(__FILE__)."/../footer.php");
include(dirname(__FILE__)."/../include/session_mysql.php");
session_start();
$_SESSION['URI']=request_uri();
include(dirname(__FILE__)."/../include/loginif.php");
$evp_root_path = (defined('EVP_ROOT_PATH')) ? EVP_ROOT_PATH : './';
//echo $evp_root_path;
/*if (isset($_SESSION['name'])) 
{$console_listr='<li><a href=../console.php>我的控制台</a></li>';}
else{$console_listr='';}*///这部分以后整合掉
if (!isset($_GET['id'])) {
	$pid=1;
}
else{
	$pid=safe_convert($_GET['id']);
}
isset($_COOKIE['lastbrow'])? $ck=$_COOKIE['lastbrow']:$ck="";
//setcookie("lastbrow",$ck.'S'.strval($pid),time()+3600,'/');
//ob_end_flush() ;
require dirname(__FILE__)."/../inc/template.inc";
$tpl = new Template("../template/");
//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[[["; 
$tpl->right_delimiter = "]]]"; 
$skinname="skin9";
$tpl->set_file("main","$skinname/readarticle.html");
$templatedir=dirname(__FILE__)."/../template/$skinname/";
//$tpl->set_var("console_li", $console_listr);
//To do 确认是数字的方法
if(!is_numeric($pid) || strlen($pid)>30) {//长度超过30明显是不可能的，判断为溢出攻击
	die('hacking attemped');
}
$result=$db->query("select t1.*,t2.depname from article_content as t1 join department as t2 on t1.bywhoid=t2.id where t1.id=$pid limit 0,1");
while ( $row = mysql_fetch_array($result))
{
if(!$row) die("没有找到这页-_-!");
#if (检测到了一个分页符)
$artbdy=getcontent(explode('<div style="page-break-after: always"><span style="display: none">&nbsp;</span></div>',$row['content']));


$tpl->set_var("hits","点击:".$row['hits']);

$tpl->set_var("articletitle", "$row[title]");
if ($_REQUEST['page']==1 || !isset($_REQUEST['page']) || $_REQUEST['page']==''){
$tpl->set_var("articlecontent","$artbdy[0]");
}
else if (isset($_REQUEST['page']) and $_REQUEST['page']>1){
$j=$_REQUEST['page']-1;
$tpl->set_var("articlecontent","$artbdy[$j]");
}



$count_artbdy=count($artbdy);
for ($i=1;$i<=$count_artbdy;$i++){
$pagingstr.="<a href=".$_SERVER['PHP_SELF']."?id=$pid&page=$i class=\"fontlink\">$i</a>";
//print_r($pagingstr);
}

if ($count_artbdy!=1){
if ($_GET['page']==1){
			$nextpage=$_GET['page']+1;
			$pagingstr="<a href=readarticle.php?id=$pid&page=".$nextpage." title='下一页'><image src='../image/page_down.gif' border=0></image></a>&nbsp;&nbsp;&nbsp;&nbsp;".$pagingstr;
}
else if ($_GET['page']>1 and $_GET['page']<$count_artbdy){
	$nextpage=$_GET['page']+1;
	$prevpage=$_GET['page']-1;
	$pagingstr="<a href=readarticle.php?id=$pid&page=".$nextpage." title='下一页'><image src='../image/page_down.gif' border=0></image></a>&nbsp;&nbsp;&nbsp;&nbsp;".$pagingstr."&nbsp;&nbsp;&nbsp;&nbsp;<a href=readarticle.php?id=$pid&page=".$prevpage." title='上一页'><image src='../image/page_up.gif' border=0></image></a>";
}
			
if($_GET['page']==$count_artbdy){
	$prevpage=$_GET['page']-1;
			$pagingstr=$pagingstr."&nbsp;&nbsp;&nbsp;&nbsp;<a href=readarticle.php?id=$pid&page=".$prevpage." title='上一页'><image src='../image/page_up.gif' border=0></image></a>";
}
$tpl->set_var("paging","$pagingstr");
}
else{
$tpl->set_var("paging","");
}
$tpl->set_var("artbywho","$row[depname]");
$tpl->set_var("adddate","$row[adddate]");

if ($row[bywhoid]=='' || $row[bywhoid]=='0'){
$tpl->set_var("editor","编辑：佚名");
}
else{
$tpl->set_var("editor","编辑：$row[bywhoid]");
}

//list($kwds1, $kwds2, $kwds3, $kwds4)=explode("|",$row[kwords]);//V1只有4个关键字

$tpl->set_var('guanjianzi',$row[kwords]);
//if($row['isdispatch']==1){$tpl->set_var("disp","发文");$tpl->set_var("ungotuser","未签收人员：（测试）");}
//else{$tpl->set_var("disp","");$tpl->set_var("ungotuser","");}
//$tpl->set_var("disp","");$tpl->set_var("ungotuser","");//不要发文了，不是intranet了
$artid=$row['artid'];//这个给下面的navi参数
$arttitle=$row['title'];
}

//$result=$db->query("select id from where article where ");
if ($artid=='') {
	echo ("对不起，没有找到这篇文章！");//没找到
	header("refresh:5;URL=../index.php");
	die();
}
$x=new navismallbar($artid);
//$x->echox();//测试方法
$navistr=$x->dbecho();
$tpl->set_var("snavi", "$navistr");
//unset($x);



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
else{$tpl->set_var("lastb", '请先登录');}
showheader($templatedir,$tpl,1);
$tpl->set_var("loginbox",'');
$tpl->set_var("myconsole",'');
$logout_str="|<A HREF=../index.php?action=logout>退出</A></div>";

$tpl->set_var("logout_li",$logout_str);
$tpl->set_var("nowtime",'');
if (isset($_SESSION['name']))
{
	//$sql="select browurl,urlname from `lastbrow` where userid={$_SESSION[id]}";
	$sql="insert into lastbrow(browurl,urlname,userid,lastviewed) values('/article/readarticle.php?id={$pid}','{$arttitle}','{$_SESSION[id]}',now())"; 
	$db->query($sql);
}
//下一个
$sql="select * from article_content where id>$pid limit 1";
$result=$db->query($sql);
if (@mysql_num_rows($result)==0){
$tpl->set_var("nextlinkstr", "没有了");
}
while ( $row = mysql_fetch_array($result))
{
$tpl->set_var("nextlinkstr", "下一个<a href=readarticle.php?id=$row[id]>$row[title]</a>");
}
//上一个
$sql="select * from article_content where id<$pid order by id desc limit 1";
$result=$db->query($sql);
if (@mysql_num_rows($result)==0){
$tpl->set_var("prevlinkstr", "没有了");
}
while ( $row = mysql_fetch_array($result))
{
$tpl->set_var("prevlinkstr", "上一个<a href=readarticle.php?id=$row[id]>$row[title]</a>");
}

$tpl->set_var("SITENAME",SITENAME);

	if (isset($_SESSION['admin_id'])){
	$tpl->set_var("adminit","管理");
	}
	else{
	$tpl->set_var("adminit","");
	}


showfooter($templatedir,$tpl);
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
$time_end = microtime_float();

//select for update的语法看手册
//$sql="select @hits_count = hits from article_content where id=$pid update article_content set hits = @hits_count+1 where id=$pid";

//die($sql);
//$db->query($sql);
/////////////
$time = $time_end - $time_start;
echo "<div align=center>Did nothing in $time seconds</div>\n";
///////////
ob_end_flush();
?>