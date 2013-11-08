<?php
//包含进模板类 template.inc
require "inc/template.inc";
//创建一个实例
$tpl = new Template("template");
//将整个文件读进来
$tpl->set_file("main", "ul.html");
//加载块list
$tpl->set_block("main", "list", "lists");
//连接数据库，选择数据库略
//省略.....
//查询结果
$link=mysql_connect("localhost","root","getter");
mysql_select_db("jzoa",$link);
$result = mysql_query("SELECT * FROM login");
//给文件中的模板变量赋值
echo "break ok";
//die;
while ($row = mysql_fetch_array($result))
{
	//echo "row0".$row[0];
$tpl->set_var("username", $row[0]);
$tpl->set_var("score", $row[1]);
$tpl->parse("lists", "list", true);
}
//完成替换
$tpl->parse("mains", "main");
//输出
$tpl->pparse("mains", "main");
?>