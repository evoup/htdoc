<?php
include("../include/checkpostandget.php");
include('../include/dbclass.php');
include("../include/common.php");
require "../inc/template.inc";
$tpl = new Template("../template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "bulletinlist.html");


$pid=safe_convert($_GET['id']);
//最新安排


//$tpl->set_var("arrangetitle", "各级部门注意");
//$tpl->set_var("arrangetime", "2006-12-7");

//$pid=safe_convert($_GET['id']);
//a list of articles
$tpl->set_block("main", "list", "nlist");  
//$result2=$db->query("select t1.* from article_content as t1  inner join article as t2 on t1.artid=t2.id and t1.artid=1 limit 0,4");
$result2=$db->query("select * from bulletin");
while ($row2 = mysql_fetch_array($result2))
{//$time0=$row2['adddate'];

$tpl->set_var("article_list_title", "<a href=readbulletin.php?id=$row2[id] >$row2[title]</a>");
$tpl->set_var("time0", "$time0");$tpl->parse("nlist", "list", true);
}

$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>