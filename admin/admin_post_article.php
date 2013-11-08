<?php 
define('IN_EVP', true);
error_reporting( E_ALL & ~E_NOTICE );
require_once("../include/class_UPLOAD.php");
include("../include/session_mysql.php");
include("../include/classdate.php");
include("../include/common.php");
include("../include/dbclass.php");
require ("makejs/function.php");


$scriptdocument_is_utf8=1;

function utf2gb($str,$scrutf8=0)
{
isset($scrutf8)?$scrutf8=$scrutf8:$scrutf8=$scriptdocument_is_utf8;//如果第二个参数是设置了的，就去读它，一般也用不到，
//就再前面设置$scriptdocument_is_utf8

//echo "<script language='javascript' charset=\"utf-8\">alert('".$scrutf8."!!');window.close();</script>";

$scrutf8?$str = $str=$str:iconv("UTF-8", "gb2312", $str);//很愚蠢的方法，不支持日本和其他国家的，呵呵，以后改//如果本身是utf8了就不做
    //$str = iconv("??????","UTF8",$str);
    return $str;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>psdata</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex, nofollow">
<link href="../sample.css" rel="stylesheet" type="text/css" />
</head>
<body>
<hr>
<?php

if ( isset( $_POST ) )
   $postArray = &$_POST ;			// 4.1.0 or later, use $_POST
else
   $postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS
//foreach ( $postArray as $sForm => $value )
//{
//$postedValue = htmlspecialchars( stripslashes($value ) ) ;
$postedTitle=utf2gb(safe_convert($_POST['bt'],0));
$postedDepId=utf2gb(safe_convert($_POST['aa'],0));
$posted_link_color=utf2gb(safe_convert($_POST['linkcolor'],0));
$doubleclass=explode('/',$_POST['aclass']);//文章分类id
$postedClassId=utf2gb(safe_convert($doubleclass[0],0));
$posted_Root_ClassId=utf2gb(safe_convert($doubleclass[1],0));
if (isset($_POST['kword'])){
	foreach($_POST['kword'] as $key=>$value){
	$key='kword_'.strval($key);//用$$这招,出来的变量应该是$kword_0,$kword_1,$kword_2,$kword_3,共四个关键字
	$$key=$value;
	if ($value="") $$key="0";
	echo "key is".$key;
	//echo $$key;
	}
}
//print_r($_REQUEST);//

//echo $postedDepId;
//echo posted_link_color;
//$postedValue=$value;
$d = strval(safe_convert(date("Y-m-d H:i")));
//TO_DO公告方法要重写
if (isset($_POST['article_or_bulletin'])&&($_POST['article_or_bulletin']==1))//判断公告还是文章
{$postedValue=utf2gb(safe_convert($_POST['input_bulletin'],0));
	if (isset($_POST['ck_announce'])&&($_POST['ck_announce']=='1'))//判断是否加入滚动新闻
	{$postedann=utf2gb(safe_convert($_POST['tx_ann'],0));
	$sql="INSERT INTO bulletin(content,title,bywhoid,adddate,isannounce,anncontent) VALUES('{$postedValue}','{$postedTitle}',{$postedDepId},'{$d}','1','{$postedann}');";//
	}
	else
	{$sql="INSERT INTO bulletin(content,title,bywhoid,adddate) VALUES('{$postedValue}','{$postedTitle}',{$postedDepId},'{$d}');";
	}

}
else{//如果不是公告，文章
$postedValue=utf2gb(safe_convert($_POST['FCKeditor1'],1));

//检查关键字是否存在
$sql ="select keyvalue,id from kword where (keyvalue='$kword_0' or keyvalue='$kword_1' or keyvalue='$kword_2' or keyvalue='$kword_3')";
$result=$db->query($sql);
$exsited_keywords_array=array();
while($row=$db->getarray($result)){
//$row[0];
//如果碰到有的关键字就不要了？No要保存到下面
	if ($kword_0==$row[0]) {
	$kword_0="";
	array_push($exsited_keywords_array,$row[1]);//把存在关键字的找到ID然后压入数组栈
	}
	if ($kword_1==$row[0]) {
	$kword_1="";
	array_push($exsited_keywords_array,$row[1]);
	}
	if ($kword_2==$row[0]) {
	$kword_2="";
	array_push($exsited_keywords_array,$row[1]);
	}
	if ($kword_3==$row[0]) {
	$kword_3="";
	array_push($exsited_keywords_array,$row[1]);
	}
}
$kword_array=array($kword_0,$kword_1,$kword_2,$kword_3);//合并成一个数组//这里要优化的http://www.phpe.net/manual/function.array-diff-key.php看手册到底用那个函数

foreach($kword_array as $key=>$value) if(trim($value)=="") unset($kword_array[$key]);//移除空数组

//echo count($kword_array);
$keywordstr='';//新关键字存到数据库
$insert_id_array=array();
	foreach ($kword_array as $key=>$value){
	//echo $value;
	$sql="insert into kword(`keyvalue`) values('{$value}');";
	echo $sql;
	$result=$db->query($sql);
	echo mysql_insert_id();
	array_push($insert_id_array,mysql_insert_id());//把需要插入的ID压入数组
	echo '<br>';
	}

/*foreach ($insert_id_array as $key=>$value){//V1

	$keywordstr=$keywordstr.'|'.$value;

}//出现这样的x1|x2|x3|x4
//*/
$insert_id_array=array_interlace($insert_id_array,$exsited_keywords_array);
unset($exsited_keywords_array);
$keywordstr=implode('|',$insert_id_array);//V2
unset($insert_id_array);



$sql="INSERT INTO 
article_content(content,artid,title,bywhoid,adddate,artrootid,linkcolor,kwords) VALUES('{$postedValue}','{$postedClassId}','{$postedTitle}',{$postedDepId},'{$d}','{$posted_Root_ClassId}','{$posted_link_color}','{$keywordstr}');";
}
if($result=$db->query($sql))
	{//echo "消息已经成功发送到了$Recipient";
//}

?>
<tr>
  <td valign="top" nowrap><b>
    <?=$sForm?>
    </b></td>
  <td width="100%"><?=$postedValue?></td>
</tr>
<?php
}




$MK=new evp_makejs();
if (!$MK->make_announce_js($content,"hot")) 
{
echo "<script>alert('生成selemulti.js失败了！')</script>";
}
else
{
echo "<script>alert('已生成selemulti.js')</script>";
}

if (!$MK->make_articleTag_js($content," ")) 
{
echo "<script>alert('生成arttag.js失败了！')</script>";
}
else
{
echo "<script>alert('已生成arttag.js')</script>";
}


//上面报了很多错-_-!再说了。能用就凑活了，以后看黑客防线解决
echo "<script language='javascript' charset=\"utf-8\">alert('Publish successed!!');window.close();</script>";

?>
</table>
</body>
</html>
