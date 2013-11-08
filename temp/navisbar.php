<?php
include("include/checkpostandget.php");
include('include/dbclass.php');
include("include/common.php");
$cuid=5;
if ($action==edit){}
else{
$sql0="select * from article where id={$cuid}";
//echo "<FONT  COLOR=\"#FF00CC\">$sql0</FONT>";
$result=$db->query($sql0);
if ($db->getcount($sql0)==0){echo '没找到';}
$i=0;
	while($row=$db->getarray($result)){

	$grid=$row['grade'];
	$supr=$row['superior'];
	//echo 'grid是'.$grid;
	/*echo $row[1];*/
	$linkstr=$row[1].'/';
	}
	
for ($i=0;$i<$grid;$i++){
	
	$sql="select * from article where id =$supr";
	$result=$db->query($sql);
    while($row=$db->getarray($result)){/*echo $row[1];*/$supr=$row['superior'];$linkstr.=$row[1].'/';}
	}

}
//echo 'linkstr是'.$linkstr;
$linktempstr=explode('/',$linkstr);
for ($i=0,$j=sizeof($linktempstr)-1;$i<sizeof($linktempstr);$i++,$j--)
{
//echo $linktempstr[$i];

$x[$j]=$linktempstr[$i];

}

for ($j=0;$j<sizeof($x);$j++)
{
echo $x[$j];
}

?>