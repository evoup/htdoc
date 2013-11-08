<?php
//包含进模板类 template.inc
require "inc/template.inc";

//创建一个实例
$tpl = new Template("template", "keep"); //注1

//将整个文件读进来
$tpl->set_file("main", "first.html"); //注2

//给文件中的模板变量赋值
$tpl->set_var("lover", "kiki"); //注3
$tpl->set_var("man", "ccterran"); //注4
$tpl->set_var("author", "iwind"); //注5
$tpl->set_var("date", "五月四日");

//完成替换
$tpl->parse("mains", "main"); //注6

//输出替换的结果
$tpl->p("mains"); //注7

?> 