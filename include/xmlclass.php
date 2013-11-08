<?php
/**
* ������XML�ĵ�������(��dom)
* author: q3boy <q3boy@sina.com>
* version: v0.1 aplha
* update: 2003/9/8
* ֧��Element/CDATA/Declare/attribute/Comment����ѡ���Ƿ�������к�����
*/
class xml {

/** Ԫ���� */
var $name;
/** Ԫ��ֵ */
var $value;
/** Ԫ������ */
var $type;
/** Ԫ������ */
var $attrib;
/** XML���� */
var $declare;
/** �Ƿ��������� */
var $space;

/** ���캯�� */
function xml($name='',$value='') {
$this->name = $name;
$this->value = $value;
$this->declare = array();
$this->setTypes('Element');
$this->setAttrib(array());
$this->setSpace(false);
}

/** ����Ԫ������ */
function setTypes($type) {
$this->type = $type;
}

/** �����Ƿ��������� */
function setSpace($space) {
$this->space = $space;
}

/** ����Ԫ������ */
function setAttrib($name,$value='') {
if(is_array($name)) {
$this->attrib = array_merge($this->attrib,$name);
}else {
$this->attrib[$name] = $value;
}
}

/** �����Ԫ�� */
function addElement($name='',$value='') {
if(!is_array($this->value)) {
$this->value = array();
}
$xml = new xml($name,$value);
$xml->setSpace($this->space);
$this->value[] = &$xml;
return $this->value[sizeof($this->value)-1];
}

/** ���CDATA���� */
function addCDATA($name='',$value='') {
if(!is_array($this->value)) {
$this->value = array();
}
$xml = new xml($name,$value);
$xml->setSpace($this->space);
$xml->setTypes('CDATA');
$this->value[] = &$xml;
return $this->value[sizeof($this->value)-1];
}

/** ���XML���� */
function addDeclare($name='',$value='') {
if(!is_array($this->declare)) {
$this->value = array();
}
$xml = new xml($name,$value);
$xml->setSpace($this->space);
$xml->setTypes('Declare');
$this->declare[] = &$xml;
return $this->declare[sizeof($this->value)-1];
}

/** ���ע���ı� */
function addComment($content='') {
if(!is_array($this->value)) {
$this->value = array();
}
$xml = new xml($content);
$xml->setSpace($this->space);
$xml->setTypes('Comment');
$this->value[] = &$xml;
return $this->value[sizeof($this->value)-1];
}

/** ����xml�ı��� */
function toString($itm='',$layer=0) {
if(!is_object($itm))$itm = &$this;
/* ����/���� */
if($this->space) {
$tab = str_repeat(" ",$layer);
$tab1 = str_repeat(" ",$layer+1);
$br = "\n";
}
/* XML���� */
for($i=0; $i<sizeof($itm->declare); $i++) {
$out = "<?".$itm->declare[$i]->name;
foreach($itm->declare[$i]->attrib as $key=>$val) {
$out .=" $key=\"".$this->encode($val)."\"";
}
$out.="?>$br";
}
/* �ĵ��� */
switch($itm->type) {
case 'CDATA':
case 'Element':
$out .= $tab.'<'.$itm->name;
foreach($itm->attrib as $key=>$val) {
$out .=" $key=\"".$this->encode($val)."\"";
}
if(is_array($itm->value)) {
$out .='>'.$br;
for($i=0; $i<sizeof($itm->value); $i++) {
$out .=$this->toString($itm->value[$i],$layer+1);
}
$out .= $tab.'</'.$itm->name.'>'.$br;

}elseif($itm->value!='') {
$out .='>'.$br.$this->encode($itm->value,$itm->type,$tab1,$br).$br.$tab.'</'.$itm->name.'>'.$br;
}else {
$out .=' />'.$br;
}
break;
case 'Comment':
$out .= '<!--'.$br.$itm->name.$br.'-->'.$br;
break;
}
return $out;
}

/** ����xml�ļ� */
function toFile($file) {
$fp = fopen($file,'w');
fwrite($fp,trim($this->toString()));
fclose($fp);
}

/** ʵ������ת�� */
function encode($content,$type='Element',$tab1='',$br='') {
if($type=='Element') {
return $tab1.strtr($content,array('>'=>'&lt;','<'=>'&gt;','&'=>'&amp;','"'=>'&quot;',"'"=>'&apos;'));
}elseif($type=='CDATA') {
return '<![CDATA['.$br.str_replace(']]>',']] >',$content).$br.']]>';
}
}
}


/* example */

/* �����ʼ�� */
//$xml = new xml('test');

/* �����������/���� */
//$xml->setSpace(true);

/* ����xml���� */
//$d = &$xml->addDeclare('xml');
//$d->setAttrib("version","1.0");

/* ����xml�ĵ��� */
//$xml1 = &$xml->addElement('test1','test1-1');
//$xml1->addElement('test2','test2-1');
//$x2 = &$xml1->addElement('test3','test2-2');
//$x2->setAttrib("asd","1&23<>4'\"23");

//$xml1->addElement('test4','test2-3');
//$xml->addElement('test455','taadsfa<><>fdsadest2-3');
//$xml->addComment('adsfadsf');//ע��
/* CDATA���� */
//$xml->addCDATA('cdname','dflkgmsglsd
//f]gl
//sdgl
//asgl
//sf"&ldgsldkfg]]>
//sldf
//gsdfgsD?FG>S<DG>S?D<Fgsd]fglsg>>');
//$x1 = &$xml->addElement('test455');
//$x1->setAttrib("asd",123423);
//$xml->setAttrib(array("asd"=>123,'sdfgdfg'=>2341));
//$xml->setAttrib("asd",123423);
/* ����ļ� */
//$xml->tofile('aaa.xml');
?>