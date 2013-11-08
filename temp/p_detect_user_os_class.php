<?php
/*============================================
版权：本程序为"无忌编程站" 开发 (http://www.zh5j.com , QQ:44922032)
引用请注明程序来源和版权 Copyright BestBF@163.com
======
本档名称：操作系统和浏览器判断类
============================================*/
error_reporting(E_ALL);
echo $test;//会在这一行出现 NOTICE：……:D
class OS_Browse{
var $OB;
function OS_Browse($Agent=''){
$this->OB[o]=$this->OS($Agent);
$this->OB=$this->Browse($Agent);
return $this->OB;
}
function OS($Agent=''){#作者朱武杰；[url]Http://[/url]
if(!$Agent)$Agent=$_SERVER["HTTP_USER_AGENT"];
//操作系统名~ 操作系统关键字~版本
$OS=split("([\r\n~])+",preg_quote(trim("
Windows 2003~win~nt 5.2
Windows XP~win~nt 5.1
Windows 2000~win~nt 5.0
Windows ME~win~4.90
Windows 98~win~98
Windows 95~win~95
Longhorn~win~nt 6.0
Windows NT~win~nt
Windows 32~win~32
Linux~Linux~
Unix~Unix~
SunOS~sun~os
IBM OS/2~ibm~os
Macintosh~Mac~PC
PowerPC~PowerPC~
AIX~AIX~
HPUX~HPUX~
NetBSD~NetBSD~
BSD~BSD~
IRIX~IRIX~
FreeBSD~FreeBSD~")));
//print_R($OS);
//$cnt=floor(count($OS)/3);
for($i=0;$i if(@eregi($OS[$i+1],$Agent)&&@eregi($OS[$i+2],$Agent)){return $OS[$i];}
}
return Unknown;
}
function Browse($Agent=''){#作者朱武杰；Http://www.zh5j.com QQ:44922032 Email:BestBF@163.com
if(!$Agent)
$Agent=$_SERVER["HTTP_USER_AGENT"];
if(ereg("Mozilla",$Agent)){
if(eregi(MSIE,$Agent)){//IE
preg_match("/ ([\d\.]+)/",$Agent,$matches);
return"IExplorer$matches[0]";
}
if (eregi(Netscape,$Agent)) {//NS
preg_match("/([\d\.]+)$/",$Agent,$matches);
//print_r($matches);
return"Netscape $matches[0]";
}
}
$Browsers=explode("~","Lynx~MOSAIC~AOL~Opera~JAVA~MacWeb~WebExplorer~OmniWeb");//其他
for ($i=0;$i<=7;$i++) {
if (strpos($Agent,$Browsers[$i])){
$browser = $Browsers[$i];
$browserver ="";
return "$browser$browserver";
}
}
return Unknown;
}
}
echo "212";
$s=new OS_Browse();
echo $s;
?>
