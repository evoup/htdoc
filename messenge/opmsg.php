<?php
define('IN_EVP', true);
//来自global.php from bbg,还要把放到通用层用来经常引用
/*function getemot ($matches) {//Emot
	global $myemots;
	$currentemot=$matches[1];
	$emotimage=$myemots[$currentemot]['image'];
	return "<img src=\"../image/emot/{$currentemot}.gif\" border=\"0\" alt=\"$currentemot\" />";
}*///这段注释掉了common.php里相应的getemot函数
//include("../include/checkpostandget.php");
include("../include/classdate.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
session_start();
include("../include/check_if_iskick.php");



include("../include/common.php");

if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index();
die("");
//die("你没有权限进入本栏目!");
}
?>
<SCRIPT src='../js/static/common.js'></SCRIPT>
<?php


require "../inc/template.inc";
$tpl = new Template("../template");
//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "opmsg.html");

if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
$id=$_GET['id'];
//echo $id;
//echo $_SESSION[’var1’]; 
$x=$_SESSION ['name'];
$y=$_SESSION ['staff'];
//echo "$x"."[$y]" ;

/*function getcontent($content, $html=0, $ubb=1, $emot=1, $advanced=1) {
	$content=str_replace('[separator]', '', $content);
	$content=str_replace('[newpage]', '', $content);
if ($emot==1) {
	$content =preg_replace_callback("/\[emot\]([^ ]+?)\[\/emot\]/is", 'getemot', $content);
}
if ($ubb==1) {
	include_once  ("../include/ubb.php");
	$content =convert_ubb($content, $advanced);
}
return $content;
}*
//这段注释掉了common.php里相应的getcontent函数


/**
+--------------------------------------------------
| 函数名：Encode($str)
| 作用：转换html代码和转行等。
| 参数：
| @param: $str：要转换的字符串
| 返回值：转换后的字符串。
+--------------------------------------------------
*/
function Encode($str){
if(!get_magic_quotes_gpc()){
$str = addslashes($str);
}
$str = htmlspecialchars($str);
$str = str_replace("\r\n","<br>",$str);
$str = str_replace("\r","<br>",$str);
$str = str_replace("\n","<br>",$str);
$str = str_replace(" ","　",$str);
$str = str_replace("'","’",$str);
return $str;
}
/**
+--------------------------------------------------
| 函数名：Decode($str)
| 作用：与Encode相反，用于修改时还原回本来的字符串
| 参数：
| @param: $str：要转换的字符串。
| 返回值：转换后的字符串。
+--------------------------------------------------
*/
function Decode($str){
$str = str_replace("<br>","\r\n",$str);
$str = str_replace("<br>","\r",$str);
$str = str_replace("<br>","\n",$str);
$str = str_replace("<","&lt;",$str);
$str = str_replace(">","&gt;",$str);
$str = str_replace("’","'",$str);
return $str;
}
$query="update msg set isread='1' where msgid={$id};";
$db->query($query);
$result=$db->query("select * from msg where msgid={$id} and inceptid={$_SESSION['id']}");
while($row=$db->getarray($result)){
if (!$row)
{die('错误的版面参数');}
$row[content]=getcontent($row[content]);
$sender=$row[sender];
$result1=$db->query("select * from usr where nickname='{$sender}'");
$row1=$db->getarray($result1);

//echo $row1[0];


//regx判断扩展名有效性
 /*function rexp($filename){
       while(1){
           $flag=preg_match("/\.(.*)/i",$filename,$matches);
           if ($flag == ""){
              return $filename;        
           }else{
              $filename=$matches[1];
           }
       }
   }*/
//这段注释掉了common.php里相应的regx函数


//$xcontd=Decode($row[content]);
//$xcontd=html_entity_decode($row[content]);

$tpl->set_var("title", "$row[title]");
$tpl->set_var("from", "$sender");
$tpl->set_var("to", "$x");
$tpl->set_var("time", "$row[sendtime]");
$tpl->set_var("content", "$row[content]");
$tpl->set_block("main", "list", "nlist"); 



$result2=$db->query("select * from attachments where msgid='{$id}'");



while ( $row2 = mysql_fetch_array($result2))
{$filename=$row2['name'];
$flag=strtolower(rexp($filename));
$attachmentstmp="<A href=".$DOCUMENT_ROOT."/upload_dir/attachments/$row2[src] target=_blank>$row2[name]</a>";
if ($flag!=''){$attachmentstmp=$attachmentstmp."<img src=".$DOCUMENT_ROOT."/image/attach/$flag.gif><br>";}
$tpl->set_var("attachments", $attachmentstmp);


$tpl->parse("nlist", "list", true);
}
//下面这个算法很不好,查下怎么弄
if(!mysql_fetch_array($result2))
	{
$tpl->set_var("attachments", '');$tpl->parse("nlist", "list", true);
}

//$tpl->set_var("senderid","$row1[0]");
$senderid=$row1[0];
//未回复连接的文章标题URL传递进行加密
$title_encoded=base64_encode($row['title']);
//加密有时有乱码问题等等再说
$title_encoded=$row['title'];
$tpl->set_var("replylink","<a href=\"msgpost_ubb.php?Recipient=$senderid&action=reply&title=$title_encoded\">回复</a> ");
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
}
//2006-6-8 09:07 PM
?><!-- <script>
//leftFrame指左边框架的名字
parent.leftFrame.location.reload();
</script> -->