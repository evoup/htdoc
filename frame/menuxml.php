<?php
require('../include/xmlclass.php');
/* example */

/* �����ʼ�� */
$xml = new xml('tree');

/* �����������/���� */
$xml->setSpace(true);

/* ����xml���� */
$d = &$xml->addDeclare('xml');
$d->setAttrib("version","1.0");
$d->setAttrib("encoding","gb2312");

/* ����xml�ĵ��� */
$xml1 = &$xml->addElement('tree','test1-1');
$t1=$xml1->addElement('tree','test2-1');
$t2=$t1->addElement('tree','gg');
//$x2 = &$xml1->addElement('test3','test2-2');
//$x2->setAttrib("asd","1&23<>4'\"23")
$xml1->addElement('tree','test2-3');
//$xml->addElement('test455','taadsfa<><>fdsadest2-3');
//$xml->addComment('adsfadsf');//ע��
//$x1 = &$xml->addElement('test455');
//$x1->setAttrib("asd",123423);
//$xml->setAttrib(array("asd"=>123,'sdfgdfg'=>2341));
//$xml->setAttrib("asd",123423);
$xml1->setAttrib("text","���ķ��͹���");
$xml1->setAttrib("menugrade","1");
$xml1->setAttrib("menusuperior","2");
$xml1->setAttrib("value","1");
$xml1->setAttrib("action","javascript:call(1,2);");
$xml1->setAttrib("radio","");
$xml1->setAttrib("checked","false");
$t1->setAttrib("text","�����͹���");
$t2->setAttrib("src","../req/tree.xml");
//$t1->setAttrib("src","../rep/tree.xml");
/* ����ļ� */
$xml->tofile('document_general.xml');
?>