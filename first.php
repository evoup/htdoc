<?php
//������ģ���� template.inc
require "inc/template.inc";

//����һ��ʵ��
$tpl = new Template("template", "keep"); //ע1

//�������ļ�������
$tpl->set_file("main", "first.html"); //ע2

//���ļ��е�ģ�������ֵ
$tpl->set_var("lover", "kiki"); //ע3
$tpl->set_var("man", "ccterran"); //ע4
$tpl->set_var("author", "iwind"); //ע5
$tpl->set_var("date", "��������");

//����滻
$tpl->parse("mains", "main"); //ע6

//����滻�Ľ��
$tpl->p("mains"); //ע7

?> 