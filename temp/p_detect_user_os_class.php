<?php
/*============================================
��Ȩ��������Ϊ"�޼ɱ��վ" ���� (http://www.zh5j.com , QQ:44922032)
������ע��������Դ�Ͱ�Ȩ Copyright BestBF@163.com
======
�������ƣ�����ϵͳ��������ж���
============================================*/
error_reporting(E_ALL);
echo $test;//������һ�г��� NOTICE������:D
class OS_Browse{
var $OB;
function OS_Browse($Agent=''){
$this->OB[o]=$this->OS($Agent);
$this->OB=$this->Browse($Agent);
return $this->OB;
}
function OS($Agent=''){#��������ܣ�[url]Http://[/url]
if(!$Agent)$Agent=$_SERVER["HTTP_USER_AGENT"];
//����ϵͳ��~ ����ϵͳ�ؼ���~�汾
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
function Browse($Agent=''){#��������ܣ�Http://www.zh5j.com QQ:44922032 Email:BestBF@163.com
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
$Browsers=explode("~","Lynx~MOSAIC~AOL~Opera~JAVA~MacWeb~WebExplorer~OmniWeb");//����
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
