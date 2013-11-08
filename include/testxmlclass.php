<?php
require('xmlclass.php');
/* example */

/* 对象初始化 */
$xml = new xml('test');

/* 允许输出换行/缩进 */
$xml->setSpace(true);

/* 设置xml声明 */
$d = &$xml->addDeclare('xml');
$d->setAttrib("version","1.0");

/* 设置xml文档树 */
$xml1 = &$xml->addElement('test1','test1-1');
$xml1->addElement('test2','test2-1');
//$x2 = &$xml1->addElement('test3','test2-2');
//$x2->setAttrib("asd","1&23<>4'\"23");

$xml1->addElement('test4','test2-3');
//$xml->addElement('test455','taadsfa<><>fdsadest2-3');
//$xml->addComment('adsfadsf');//注释

$x1 = &$xml->addElement('test455');
$x1->setAttrib("asd",123423);
$xml->setAttrib(array("asd"=>123,'sdfgdfg'=>2341));
$xml->setAttrib("asd",123423);
/* 输出文件 */
$xml->tofile('aaa.xml');
?>