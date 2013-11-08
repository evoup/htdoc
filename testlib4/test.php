<?php 
//包含进模板类 template.inc 
require "../inc/template.inc"; 

//创建一个实例 
$tpl = new Template("../"); 

//将整个文件读进来 
$tpl->set_file("main", "testlib4/third.html"); 
$tpl->set_file("my_header", "testlib4/header.html"); 
$tpl->set_file("my_footer", "testlib4/footer.html"); 

//设置header.html里的变量title的值 
$tpl->set_var("title", "这个是网页标题"); 

//设置块 
$tpl->set_block("main", "list", "lists"); 
$array = array("张三" => 82, "李四" => 90, "王二" => 60, "麻子" => 77); 
foreach ($array as $username=>$score) 
{ 
$tpl->set_var("username", $username); 
$tpl->set_var("score", $score); 
$tpl->parse("lists", "list", true); 
} 

//执行my_header,my_footer里的模板变量替换,并把最终结果分别赋给主模板中的header,footer 
$tpl->parse("header", "my_header"); 
$tpl->parse("footer", "my_footer"); 

//完成主模板内变量的替换 
$tpl->parse("mains", "main"); 

//输出 
$tpl->p("mains"); 

?> 
