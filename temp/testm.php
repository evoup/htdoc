<?php
include("include/checkpostandget.php");
include('include/dbclass.php');
include("include/common.php");include("include/classdate.php");
require "inc/template.inc";
$tpl = new Template("template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //ÐÞ¸Ä×ó±ß½ç·ûÎª[##
$tpl->right_delimiter = "##]"; //ÐÞ¸ÄÓÒ±ß½ç·û##]
$tpl->set_file("main", "skin7/indexty.html");

//console
include("include/session_mysql.php");


$tpl->set_block("main", "list", "nlist");  
//$result2=$db->query("select t1.* from article_content as t1  inner join article as t2 on t1.artid=t2.id and t1.artid=1 limit 0,4");
$result2=$db->query("select * from article_content  where artrootid=1 order by id desc limit 0,5 ");
while ($row2 = mysql_fetch_array($result2))
{$time0=$row2['adddate'];
$onlinework=$row2['title'];
$tpl->set_var("onlinework", "<a href='article/readarticle.php?id=$row2[id]'>$onlinework</a>");
$tpl->set_var("time0", "$time0");$tpl->parse("nlist", "list", true);
}

$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>