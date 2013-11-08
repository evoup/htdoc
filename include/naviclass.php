<?php
//include("include/checkpostandget.php");
//确认包含了define.php
//include ("define.php");
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
		global $db;
		$dbn=$db;
//include("dbclass_navi.php");//用全局了，注意先把dbclass.php包含进来

//$cuid=5;
//if ($action=='edit'){}
//else{
$sql0="select * from article where id={$this->cuid}";
//echo "<FONT  COLOR=\"#FF00CC\">$sql0</FONT>";
$result=$dbn->query($sql0);
if ($dbn->getcount($sql0)==0){
	//echo '没找到';
}
$i=0;
	while($row=$dbn->getarray($result)){

	$grid=$row['grade'];
	$supr=$row['superior'];
	//echo 'grid是'.$grid;
	/*echo $row[1];*/
	$linkstr=$row[1].'/';//这是artclass
	//$linkstrid=$row[0].'/';//这是id//不用id了，加个index用中文查，还快
	}
	
for ($i=0;$i<$grid;$i++){
	
	$sql="select * from article where id =$supr";
	$result=$dbn->query($sql);
    while($row=$dbn->getarray($result)){/*echo $row[1];*/$supr=$row['superior'];$linkstr.=$row[1].'/';}
	}

//}




$linktempstr=explode('/',$linkstr);
for ($i=0,$j=sizeof($linktempstr)-1;$i<sizeof($linktempstr);$i++,$j--)
	{
	$x[$j]=$linktempstr[$i];
	}



/*$linktempstrid=explode('/',$linkstrid);
for ($i=0,$j=sizeof($linktempstrid)-1;$i<sizeof($linktempstrid);$i++,$j--)
	{
	$y[$j]=$linktempstrid[$i];
	}*/



for ($linkstr='<a href="../../index.php">'.SITENAME.'</a>',$j=0;$j<sizeof($x);$j++)
{
if ($j==1){
$linkstr.="&gt;"."<a href=../../article/articlelist.php?id=".rawurlencode($x[$j])."&rootview=yes>".$x[$j]."</a>";}
else{$linkstr.="&gt;"."<a href=../../article/articlelist.php?id=".rawurlencode($x[$j]).">".$x[$j]."</a>";}

}
return $linkstr;



}
//dbecho结束


}
?>