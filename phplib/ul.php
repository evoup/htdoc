<?php
//������ģ���� template.inc
require "inc/template.inc";
//����һ��ʵ��
$tpl = new Template("template");
//�������ļ�������
$tpl->set_file("main", "ul.html");
//���ؿ�list
$tpl->set_block("main", "list", "lists");
//�������ݿ⣬ѡ�����ݿ���
//ʡ��.....
//��ѯ���
$link=mysql_connect("localhost","root","getter");
mysql_select_db("jzoa",$link);
$result = mysql_query("SELECT * FROM login");
//���ļ��е�ģ�������ֵ
echo "break ok";
//die;
while ($row = mysql_fetch_array($result))
{
	//echo "row0".$row[0];
$tpl->set_var("username", $row[0]);
$tpl->set_var("score", $row[1]);
$tpl->parse("lists", "list", true);
}
//����滻
$tpl->parse("mains", "main");
//���
$tpl->pparse("mains", "main");
?>