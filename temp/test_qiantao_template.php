<?php 
//������ģ���� template.inc 
require "../inc/template.inc"; 

//����һ��ʵ�� 
$tpl = new Template("../"); 

//�������ļ������� 
$tpl->set_file("main", "testlib4/third.html"); 
$tpl->set_file("my_header", "testlib4/header.html"); 
$tpl->set_file("my_footer", "testlib4/footer.html"); 

//����header.html��ı���title��ֵ 
$tpl->set_var("title", "�������ҳ����"); 

//���ÿ� 
$tpl->set_block("main", "list", "lists"); 
$array = array("����" => 82, "����" => 90, "����" => 60, "����" => 77); 
foreach ($array as $username=>$score) 
{ 
$tpl->set_var("username", $username); 
$tpl->set_var("score", $score); 
$tpl->parse("lists", "list", true); 
} 

//ִ��my_header,my_footer���ģ������滻,�������ս���ֱ𸳸���ģ���е�header,footer 
$tpl->parse("header", "my_header"); 
$tpl->parse("footer", "my_footer"); 

//�����ģ���ڱ������滻 
$tpl->parse("mains", "main"); 

//��� 
$tpl->p("mains"); 

?> 
