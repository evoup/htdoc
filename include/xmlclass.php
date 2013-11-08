<?php
/**
* 轻量级XML文档生成类(非dom)
* author: q3boy <q3boy@sina.com>
* version: v0.1 aplha
* update: 2003/9/8
* 支持Element/CDATA/Declare/attribute/Comment，可选择是否包含换行和缩进
*/
class xml {

/** 元素名 */
var $name;
/** 元素值 */
var $value;
/** 元素类型 */
var $type;
/** 元素属性 */
var $attrib;
/** XML声明 */
var $declare;
/** 是否缩进换行 */
var $space;

/** 构造函数 */
function xml($name='',$value='') {
$this->name = $name;
$this->value = $value;
$this->declare = array();
$this->setTypes('Element');
$this->setAttrib(array());
$this->setSpace(false);
}

/** 设置元素类型 */
function setTypes($type) {
$this->type = $type;
}

/** 设置是否缩进换行 */
function setSpace($space) {
$this->space = $space;
}

/** 设置元素属性 */
function setAttrib($name,$value='') {
if(is_array($name)) {
$this->attrib = array_merge($this->attrib,$name);
}else {
$this->attrib[$name] = $value;
}
}

/** 添加子元素 */
function addElement($name='',$value='') {
if(!is_array($this->value)) {
$this->value = array();
}
$xml = new xml($name,$value);
$xml->setSpace($this->space);
$this->value[] = &$xml;
return $this->value[sizeof($this->value)-1];
}

/** 添加CDATA数据 */
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

/** 添加XML声明 */
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

/** 添加注释文本 */
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

/** 返回xml文本流 */
function toString($itm='',$layer=0) {
if(!is_object($itm))$itm = &$this;
/* 换行/缩进 */
if($this->space) {
$tab = str_repeat(" ",$layer);
$tab1 = str_repeat(" ",$layer+1);
$br = "\n";
}
/* XML声明 */
for($i=0; $i<sizeof($itm->declare); $i++) {
$out = "<?".$itm->declare[$i]->name;
foreach($itm->declare[$i]->attrib as $key=>$val) {
$out .=" $key=\"".$this->encode($val)."\"";
}
$out.="?>$br";
}
/* 文档树 */
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

/** 生成xml文件 */
function toFile($file) {
$fp = fopen($file,'w');
fwrite($fp,trim($this->toString()));
fclose($fp);
}

/** 实体引用转换 */
function encode($content,$type='Element',$tab1='',$br='') {
if($type=='Element') {
return $tab1.strtr($content,array('>'=>'&lt;','<'=>'&gt;','&'=>'&amp;','"'=>'&quot;',"'"=>'&apos;'));
}elseif($type=='CDATA') {
return '<![CDATA['.$br.str_replace(']]>',']] >',$content).$br.']]>';
}
}
}


/* example */

/* 对象初始化 */
//$xml = new xml('test');

/* 允许输出换行/缩进 */
//$xml->setSpace(true);

/* 设置xml声明 */
//$d = &$xml->addDeclare('xml');
//$d->setAttrib("version","1.0");

/* 设置xml文档树 */
//$xml1 = &$xml->addElement('test1','test1-1');
//$xml1->addElement('test2','test2-1');
//$x2 = &$xml1->addElement('test3','test2-2');
//$x2->setAttrib("asd","1&23<>4'\"23");

//$xml1->addElement('test4','test2-3');
//$xml->addElement('test455','taadsfa<><>fdsadest2-3');
//$xml->addComment('adsfadsf');//注释
/* CDATA数据 */
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
/* 输出文件 */
//$xml->tofile('aaa.xml');
?>