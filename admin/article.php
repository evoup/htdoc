<?php
define('IN_EVP', true);


/*# 让它在过去就“失效”
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

# 永远是改动过的
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

# HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

# HTTP/1.0
header("Pragma: no-cache");*/
ob_start();


//include("../include/checkpostandget.php");管理员部分就用不到了
include('../include/dbclass.php');
include('../include/session_mysql.php');
require_once('../include/ext_page.class.php');
//include('../include/classdate.php');



session_start();
if (!isset($_SESSION['admin_id'])  || $_SESSION['admin_id']!=1){
	echo ("您未登录或登录已超时！");//没找到
	header("refresh:5;URL=./admin.php");
	die();
}
//检查超时开始
	$timeout=1200;      //超时时间,单位:秒,这里设为20分钟. 
	$now=time(); 
	if(($now-$_SESSION[ "session_time"]) > $timeout) 
	{ 
	     //超时了. 
	     foreach ($_SESSION as $key=>$value){
	     unset($_SESSION[$key]);
	     @session_destroy();
	     }
	     //session_regenerate_id();//如果超时就再设置一个新的ID
	     die(" <script>alert( \"超时了. \");location.href='admin.php'; </script>"); 
	}else{ 
	     //还没超时. 
	     $_SESSION[ "session_time"]=time(); 
	}	
	//检查超时结束	



include("../include/common.php");
require "../inc/template.inc";
require("./makejs/function.php");
$tpl = new Template("../template/admin");
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[[["; //修改左边界符为[##
$tpl->right_delimiter = "]]]"; //修改右边界符##]


if (empty($_GET['action']) || !isset($_GET['action'])){
$_GET['action']='list';//为了满足逻辑而设置
}


//修改文章
if ($_GET['action']=='edit'){
$editid=safe_convert($_GET['id']);

$sql="select t1.*,t2.id as myid,t2.rootid,t2.artclass from article_content as t1,article as t2 where t1.id={$editid} and t1.artid=t2.id";
//die($sql);//如果2个表里有重命名最好的办法就就是select t1.xx as xx1,t2.xx form table1 as t1,table2 as t2  
$result=$db->query($sql);
$row=$db->getarray($result);
mysql_free_result($result);
$tpl->set_var("rand",rand());
//list($kwds1, $kwds2, $kwds3, $kwds4)=explode("|",$row[kwords]);//V1只有4个关键字
//$tpl->set_var("kword1",$kwds1);$tpl->set_var("kword2",$kwds2);$tpl->set_var("kword3",$kwds3);$tpl->set_var("kword4",$kwds4);
//使用js来填写关键字
$tpl->set_var("guanjianzi",$row[kwords]);


$tpl->set_var("inset_inline_js_changeselect","<script language=javascript deder=defer>document.getElementById('artsel').options[0].text='".$row['artclass']."';document.getElementById('artsel').options[0].value='".$row['myid']."/".$row['rootid']."';</script>");//把select的首列设置掉，本来可以使用selectIndex，但是这个value是这样的5/1,所以不行。
$tpl->set_var("artbt",$row['title']);
$tpl->set_var("artauthor",$row['bywhoid']);
$tpl->set_var("thumbpicname",$row['thumbpicid']);
$tpl->set_var("repostdir",'article.php?action=list&editid='.$editid);
$tpl->set_var("pagedo",'edit');//接下来要接受POST者的操作标识，是在_add_article.html里的一个隐藏域
//如果没变化为UBB，就用这个
$tpl->set_var("insert_inline_js_dbv2txtv","<script language='javascript' defer='defer'>document.getElementById('hiddentextarea').innerText='".rawurlencode(safe_invert($row['content'],1))."';var str=decodeURIComponent(document.getElementById('hiddentextarea').innerText);document.getElementById('hiddentextarea').innerText=str; </script>");//添加修改文章需要的一些JS操作

//下面这个是因为boblog是UBB的话，那么要safe_invert(str,1)
/*$tpl->set_var("insert_inline_js_dbv2txtv","<script language='javascript' defer='defer'>document.getElementById('hiddentextarea').innerText='".rawurlencode(safe_invert($row['content'],1))."';var str=decodeURIComponent(document.getElementById('hiddentextarea').innerText);document.getElementById('hiddentextarea').innerText=str; </script>");//添加修改文章需要的一些JS操作
*/
$tpl->set_var("gen_input",gen_input());//生成htmltoken
$tpl->set_var("hid_newfile",0);//隐藏字段控制FCK行为
$tpl->set_file("main", "_add_article.html");//和添加文章共用一个模板
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
exit(0);
}






//删除文章
//print_r($_REQUEST);
if ($_GET['action']=='del'){

	//接收当前页号码
	if (isset($_REQUEST['PB_page'])){
	//$curr_page=empty($_REQUEST['PB_page'])?$_REQUEST['PB_page']:1; //如果参数page为空则返回当前页为1
	$curr_page=$_REQUEST['PB_page'];
	}
	else if(isset($_POST['PB_Page_Select'])){
	$curr_page=$_REQUEST['PB_Page_Select'];
	}

$delid=safe_convert($_GET['id']);
$sql="delete from `article_content` where id={$delid}";
//echo $sql;
$db->query($sql);
echo("<script>alert('执行了删除操作')</script>");//这句被前面的void屏蔽掉了
/*echo("<script>this.href='admin_class_edit.php?action=list'</script>");*/
header("Location: article.php?action=list&PB_page=$curr_page");
}

if($_GET['action']=='add'){//添加文章页面
$tpl->set_var("rand",rand());
$tpl->set_var("artbt","");$tpl->set_var("artauthor","");$tpl->set_var("thumbpicname","");$tpl->set_var("insert_inline_js_dbv2txtv","");$tpl->set_var("inset_inline_js_changeselect","");//解析掉只用于edit的模板标记
$tpl->set_var("repostdir",'article.php?action=list');
$tpl->set_var("pagedo",'add');//接下来要接受POST者的操作标识，是在_add_article.html里的一个隐藏域
$tpl->set_var("gen_input",gen_input());//生成htmltoken
/*$tpl->set_var("kword1","");
$tpl->set_var("kword2","");
$tpl->set_var("kword3","");
$tpl->set_var("kword4","");*/
$tpl->set_var("hid_newfile",1);//隐藏字段控制FCK行为
$tpl->set_file("main", "_add_article.html");
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
exit(0);
}





if($_REQUEST['action']=='list'){
if ($_POST['pagedo']=='refreshtime'){//刷新时间
//token_check();本页还没有验证 To do add validate
$pid=safe_convert($_POST['hid_refreshtime']);
if (!is_numeric($pid)) die('hacking attempted!');
$d = strval(safe_convert(date("Y-m-d H:i")));//文章发布时间
$sql="update article_content set adddate='$d' where id=$pid";
$db->query($sql);
}


if($_POST['pagedo']=='edit'){//如果上页过来是要处理修改文章过程，有问题？万一不是呢？不执行啊，没任何问题！！
token_check();

	$gotEditId=safe_convert($_GET['editid'],0);//修改文章的id
	$postedValue=safe_convert($_POST['hideditor'],1);//编辑器的内容，就是正文
	$postedTitle=safe_convert($_POST['bt'],0);//标题
	$postedWhoId=safe_convert($_POST['author'],0);//作者
	$postedThumb_art_pic=safe_convert($_POST['thumb_art_pic'],0);//缩略图
	$posted_link_color=safe_convert($_POST['linkcolor'],0);
	$doubleclass=explode('/',$_POST['aclass']);//文章分类id
	$postedClassId=safe_convert($doubleclass[0],0);
	$posted_Root_ClassId=safe_convert($doubleclass[1],0);
	foreach ($_POST['kword'] as $key=>$value){
	$key='kword_'.strval($key);//用$$这招,出来的变量应该是$kword_0,$kword_1,$kword_2,$kword_3,共四个关键字
	$$key=$value;
	if ($value="") $$key="0";
	//echo "key is".$key;
	//echo $$key;
	}


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
	$kword_array=array($kword_0,$kword_1,$kword_2,$kword_3);//合并成一个数组//这里要优化的			http://www.phpe.net/manual/function.array-diff-key.php看手册到底用那个函数

	foreach($kword_array as $key=>$value) if(trim($value)=="") unset($kword_array[$key]);//移除空数组

	//echo count($kword_array);
	$keywordstr='';//新关键字存到数据库
	$insert_id_array=array();
	foreach ($kword_array as $key=>$value){
	//echo $value;
	$sql="insert into kword(`keyvalue`) values('{$value}');";
	//echo $sql;
	$result=$db->query($sql);
	$iid = $db->getid();//注意马上要来一个赋值，否则mysql_insert_id就可能为失败，还有mysql_insert_id()，括号里要加数据库link的
	array_push($insert_id_array,$iid);//把需要插入的ID压入数组
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

	$d = strval(safe_convert(date("Y-m-d H:i")));//文章发布时间	
	$sql="UPDATE `article_content` set 
	`content`='{$postedValue}',
	`artid`='{$postedClassId}',
	`title`='{$postedTitle}',
	`bywhoid`='{$postedWhoId}',
	`artrootid`='{$posted_Root_ClassId}',
	`kwords`='{$keywordstr}',
	`thumbpicid`='{$postedThumb_art_pic}' 
	where id='{$gotEditId}';
	";
	//die($sql);
//	article_content set content,artid,title,bywhoid,adddate,artrootid,linkcolor,kwords,thumbpicid) VALUES('{$postedValue}','{$postedClassId}','{$postedTitle}','{$postedWhoId}','{$d}','{$posted_Root_ClassId}','{$posted_link_color}','{$keywordstr}','{$postedThumb_art_pic}');";
	$db->query($sql);
	//再生成一次TAG的JS和添加文章下拉列表的JS
	$MK=new evp_makejs();
	if (!$MK->make_announce_js($content,"hot")) {
	echo "<script>alert('生成selemulti.js失败了！')</script>";
	}
	else{
	$outstr='已生成selemulti.js!';
	}
	
	if (!$MK->make_articleTag_js($content," ")) {
	echo "<script>alert('生成arttag.js失败了！')</script>";
	}
	else{
	$outstr.='已生成arttag.js!';
	}
	if (ltrim(trim($outstr))!=''){
	echo "<script>alert('$outstr')</script>";
	}

}//完成修改操作


if($_POST['pagedo']=='add'){//如果上页过来是要处理添加文章过程

token_check();//anti CSRF hacking


	$postedValue=safe_convert($_POST['hideditor'],1);//编辑器的内容，就是正文
	$postedTitle=safe_convert($_POST['bt'],0);//标题
	$postedWhoId=safe_convert($_POST['author'],0);//作者
	$postedThumb_art_pic=safe_convert($_POST['thumb_art_pic'],0);//缩略图
	$posted_link_color=safe_convert($_POST['linkcolor'],0);
	$doubleclass=explode('/',$_POST['aclass']);//文章分类id
	$postedClassId=safe_convert($doubleclass[0],0);
	$posted_Root_ClassId=safe_convert($doubleclass[1],0);
	foreach ($_POST['kword'] as $key=>$value){
	$key='kword_'.strval($key);//用$$这招,出来的变量应该是$kword_0,$kword_1,$kword_2,$kword_3,共四个关键字
	$$key=$value;
	if ($value="") $$key="0";
	//echo "key is".$key;
	//echo $$key;
	}


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
	$kword_array=array($kword_0,$kword_1,$kword_2,$kword_3);//合并成一个数组//这里要优化的			http://www.phpe.net/manual/function.array-diff-key.php看手册到底用那个函数

	foreach($kword_array as $key=>$value) if(trim($value)=="") unset($kword_array[$key]);//移除空数组

	//echo count($kword_array);
	$keywordstr='';//新关键字存到数据库
	$insert_id_array=array();
	foreach ($kword_array as $key=>$value){
	//echo $value;
	$sql="insert into kword(`keyvalue`) values('{$value}');";
	//echo $sql;
	$result=$db->query($sql);
	$iid = $db->getid();//注意马上要来一个赋值，否则mysql_insert_id就可能为失败，还有mysql_insert_id()，括号里要加数据库link的
	array_push($insert_id_array,$iid);//把需要插入的ID压入数组
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

	$d = strval(safe_convert(date("Y-m-d H:i")));//文章发布时间
	
	$sql="INSERT INTO 
	article_content(content,artid,title,bywhoid,adddate,artrootid,linkcolor,kwords,thumbpicid) VALUES('{$postedValue}','{$postedClassId}','{$postedTitle}','{$postedWhoId}','{$d}','{$posted_Root_ClassId}','{$posted_link_color}','{$keywordstr}','{$postedThumb_art_pic}');";

	$db->query($sql);


	//再生成一次TAG的JS和添加文章下拉列表的JS
	$MK=new evp_makejs();
	if (!$MK->make_announce_js($content,"hot")) {
	echo "<script>alert('生成selemulti.js失败了！')</script>";
	}
	else{
	/*echo "<script>alert('已生成selemulti.js')</script>";*/
	$outstr='已生成selemulti.js!';
	}
	
	if (!$MK->make_articleTag_js($content," ")) {
	echo "<script>alert('生成arttag.js失败了！')</script>";
	}
	else{
	/*echo "<script>alert('已生成arttag.js')</script>";*/
	$outstr.='已生成arttag.js!';
	}
	if (ltrim(trim($outstr))!=''){
	echo "<script>alert('$outstr')</script>";
	}

}//完成添加操作


//开始解析并显示
$tpl->set_file("main", "_article.html");

$tpl->set_block("main", "list", "nlist"); 


//分页开始

if (isset($_REQUEST['PB_page'])){
//$curr_page=empty($_REQUEST['PB_page'])?$_REQUEST['PB_page']:1; //如果参数page为空则返回当前页为1
$curr_page=$_REQUEST['PB_page'];
}
else if(isset($_POST['PB_Page_Select'])){
$curr_page=$_REQUEST['PB_Page_Select'];
}

else 
{$curr_page=1;}
$total_sql="select count(*) as total from article_content";//用来查出总记录数的sql语句
//$result=$db->query($total_sql);V1
//$total=$db->getarray($result);

$totalrec=$db->getfirst($total_sql);//V2
$totalrecord=$totalrec[0];//全部记录数
//die($total[0]);
$perpage=8;//每页记录数
$orderstr=' order by id desc';
$sql="select * from article_content".$orderstr." limit ".($curr_page-1)*$perpage.",".$perpage;//分页记录集sql语句
//分页结束


//die($sql);
//$sql='select * from article_content';
$result=$db->query($sql);
while($row=$db->getarray($result)){
//print_r("j");
$tpl->set_var("newslist","<tr>
    <td><input type=\"checkbox\" name=\"checkboxes[]\" value=\"$row[id]\" />$row[id]</td>
    <td class=\"first-cell\" style=\"\"><span></span></td>
    <td><span onclick=\"\"><b>$row[title]</b></span></td>
    <td align=\"right\"><span >$row[adddate]</span></td>
    <td align=\"center\"><img src=\"images/yes.gif\"  /></td>
    <td align=\"center\"><img src=\"images/no.gif\"  /></td>
    <td align=\"center\"><span><a href='javascript:refreshtime($row[id]);'>刷新</a></span></td>
        <td align=\"center\">
      <a href=\"../article/readarticle.php?id=$row[id]\" target=\"_blank\" title=\"查看\"><img src=\"images/icon_view.gif\" width=\"16\" height=\"16\" border=\"0\" /></a>
      <a href=\"article.php?action=edit&id=$row[id]\" title=\"编辑\"><img src=\"images/icon_edit.gif\" width=\"16\" height=\"16\" border=\"0\" /></a>
      <!--<a href=\"goods.php?act=copy&goods_id=17&extension_code=\" title=\"复制\"><img src=\"images/icon_copy.gif\" width=\"16\" height=\"16\" border=\"0\" /></a>-->
      <a href=\"javascript:void(0);\" onclick=\"if (DeleteConfirm('您确定要删除该文章吗？:[$row[title]]?')){this.href='article.php?action=del&id=$row[id]&PB_page=$curr_page';}\" title=\"删除\"><img src=\"images/icon_trash.gif\" width=\"16\" height=\"16\" border=\"0\" /></a>          </td>
  </tr>");
  $tpl->parse("nlist", "list", true);
}

//分页调用开始
$page=new page(array('total'=>$totalrecord,'perpage'=>$perpage));
//echo $page->show(1);//第一种分页法

$tpl->set_var("paging","总计".$totalrecord."个记录 目前第".$curr_page."页 每页".$perpage."个记录 | ".$page->show(4));
//分页调用结束

$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
}
?>