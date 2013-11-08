<?php
require('../include/xmlclass.php');
/* example */

/* 对象初始化 */
$xml = new xml('tree');

/* 允许输出换行/缩进 */
$xml->setSpace(true);

/* 设置xml声明 */
$d = &$xml->addDeclare('xml');
$d->setAttrib("version","1.0");
$d->setAttrib("encoding","gb2312");

/* 设置xml文档树 */
$xml1 = &$xml->addElement('tree','test1-1');
$t1=$xml1->addElement('tree','test2-1');
$t2=$t1->addElement('tree','gg');
//$x2 = &$xml1->addElement('test3','test2-2');
//$x2->setAttrib("asd","1&23<>4'\"23")
$xml1->addElement('tree','test2-3');
//$xml->addElement('test455','taadsfa<><>fdsadest2-3');
//$xml->addComment('adsfadsf');//注释
//$x1 = &$xml->addElement('test455');
//$x1->setAttrib("asd",123423);
//$xml->setAttrib(array("asd"=>123,'sdfgdfg'=>2341));
//$xml->setAttrib("asd",123423);
$xml1->setAttrib("text","报文发送管理");
$xml1->setAttrib("menugrade","1");
$xml1->setAttrib("menusuperior","2");
$xml1->setAttrib("value","1");
$xml1->setAttrib("action","javascript:call(1,2);");
$xml1->setAttrib("radio","");
$xml1->setAttrib("checked","false");
$t1->setAttrib("text","报表发送管理");
$t2->setAttrib("src","../req/tree.xml");
//$t1->setAttrib("src","../rep/tree.xml");
/* 输出文件 */
$xml->tofile('document_general.xml');
?>