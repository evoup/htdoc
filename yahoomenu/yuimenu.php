<?php
Class menu // ќбъ€вл€ем новый класс с именем
{
  var $link;
	var $lvl;
	var $lang;
  var	$host;  //your host
  var $user; //MySQL user
  var $pass; // MySQL password
  var $bd; //database

/* эти функции будут работать только внутри класса Sample */
/* или внутри классов-наследников данного класса */
function setTitle($title) // устанавливает значение в переменную $Title
{
/* ќбратите внимание, что бы обратитьс€ к переменной, */
/* нужно сначало написать $this-> а потом только им€ переменной */
    $this->Title = $title;
}

function setConnect($host,$user,$pass,$bd){
$this->HOST=$host;  
$this->USER=$user; 
$this->PAS=$pass; 
$this->BD=$bd;
$link = mysql_connect($host, $user, $pass ) or die ("Could not connect to MySQL");
 mysql_select_db ($bd) or die ("Could not select database");
}

/* дл€ обращени€ к функци€м внутри класса используетс€ тот же */
/* подход, что и дл€ переменных, т.е. $this->им€_функции(параметры) */
function ShowTree($ParentID, $lvl,$lang) {
//
	global $link;
	global $lvl;
	global $lang;
	if($lang=="" or $lang=='ru'){$prefix="";}else{$prefix='_en';}
  $table="h_meny".$prefix;
	$lvl++;
	$count=0;
	mysql_query("SET NAMES 'UTF8'");
	$result = mysql_query ("SELECT * FROM ".$table." WHERE sublevel = ". $ParentID ." ORDER BY id,level;");
if(mysql_num_rows($result) > 0){
while($line=mysql_fetch_array($result))
 { $count++;
 if ($lvl==1)
    {
    echo ("<LI class=yuimenubaritem><A class=yuimenubaritemlabel href=$line[link]&lang=$lang title=$Line[hint]>$line[point]</a>\n");
    }
    else
    { if ($count==1){echo"<DIV class=yuimenu id=$line[id]>
  <DIV class=bd>
  <UL>\n";}
    echo("<li class=yuimenuitem><A class=yuimenuitemlabel href=$line[link]&lang=$lang>$line[point]</a>\n");
    }
$newClass = new menu();
$newClass->ShowTree($line[id],$lvl,$lang);
		$lvl--;
	}
echo "</LI>
</UL>
</DIV>
</DIV>\n";
	}
}
}
?>