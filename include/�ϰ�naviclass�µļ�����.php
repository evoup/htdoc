<?php
//include("include/checkpostandget.php");

//include("include/common.php");
Class navismallbar{
var $cuid;

function navismallbar($cuid)
{
$this->cuid=$cuid;
}
//funtion navi结束



function echox()//测试方法
{
	echo $this->cuid;
}


function dbecho()
	{
include("dbclass_navi.php");

//$cuid=5;
if ($action==edit){}
else{
$sql0="select * from article where id={$this->cuid}";
//echo "<FONT  COLOR=\"#FF00CC\">$sql0</FONT>";
$result=$dbn->query($sql0);
if ($dbn->getcount($sql0)==0){echo '没找到';}
$i=0;
	while($row=$dbn->getarray($result)){

	$grid=$row['grade'];
	$supr=$row['superior'];
	//echo 'grid是'.$grid;
	/*echo $row[1];*/
	$linkstr=$row[1].'/';//这是artclass
	$linkstrid=$row[0].'/';//这是id
	}
	
for ($i=0;$i<$grid;$i++){
	
	$sql="select * from article where id =$supr";
	$result=$dbn->query($sql);
    while($row=$dbn->getarray($result)){/*echo $row[1];*/$supr=$row['superior'];$linkstr.=$row[1].'/';}
	}

}




$linktempstr=explode('/',$linkstr);
for ($i=0,$j=sizeof($linktempstr)-1;$i<sizeof($linktempstr);$i++,$j--)
	{
	$x[$j]=$linktempstr[$i];
	}



$linktempstrid=explode('/',$linkstrid);
for ($i=0,$j=sizeof($linktempstrid)-1;$i<sizeof($linktempstrid);$i++,$j--)
	{
	$y[$j]=$linktempstrid[$i];
	}



for ($linkstr='<a href="../index.php">佳艺内网</a>',$j=0;$j<sizeof($x);$j++)
{
//echo $x[$j];//这个就是没加斜线的navi,EX网上办事考勤考核岗位职责
$linkstr.="&gt;"."<a href=../article/articlelist.php?id=$y[$j]>".$x[$j]."</a>";

}
return $linkstr;



}
//dbecho结束





}
//类结束
?>