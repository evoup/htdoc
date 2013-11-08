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


include("../include/checkpostandget.php");
include('../include/dbclass.php');
include('../include/session_mysql.php');
session_start();
if (!isset($_SESSION['admin_id'])){
die('没有权限');
}
//检查超时开始
	$timeout=1200;   //超时时间,单位:秒,这里设为20分钟. 
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
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]


//判断是哪里提交的
if(isset($_REQUEST[FTOKEN_NAME])) {//加个条件，因为它不是单入口APP,所以要判断是提交后的
token_check();
}


if ($_GET['action']=='del'){

$delid=safe_convert($_GET['id']);
$sql="delete from `article` where id={$delid}";
//echo $sql;
$db->query($sql);
echo("<script>alert('执行了删除操作')</script>");
/*echo("<script>this.href='admin_class_edit.php?action=list'</script>");*/

header("Location: admin_class_edit.php?action=list");

}
//add
if ($_GET['action']=='add'){
ob_end_clean;
$tpl->set_var("gen_input",gen_input());
$tpl->set_file("main", "_admin_class_edit_add.html");
$tpl->set_var("phprand",rand());//模板里是设置js?t=new Data();是没用的，可能是使用了缓存，所以要写在服务端页来禁止js缓存
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
die;
}

if ($_GET['action']=='move'){
//die($_SESSION['STOKEN_NAME']);
//var_dump($_SESSION);
//下面走完在提交到action=list不加session_start()会出现问题

$tpl->set_var("gen_input",gen_input());
$tpl->set_file("main", "_admin_class_edit_move.html");
//$_SESSION['POSTFLAG']="move".rand();
//$tpl->set_var("postflag",$_SESSION['POSTFLAG']);//这是个检查是否从SERVER端提交和防止反复提交的标识,注意万一伪造了一个怎么做！！！
$tpl->set_var("phprand",rand()); //V1.0

$tpl->parse("mains", "main");

$tpl->pparse("mains", "main");
die;//解析模板结束就跳出,die和exit()是一个意思s
//die($_SESSION['STOKEN_NAME']);
}

//list
if ($_GET['action']=='list')
{
/*if(isset($_REQUEST['FTOKEN_NAME'])) {
//die('怎么还是没SESSION');
//die($_SESSION['STOKEN_NAME']);
var_dump($_SESSION);
}
*/ 
//POST
	//添加文章的方法
	if (isset($_POST['pagedo'])	&& $_POST['pagedo']=='move'){
	//print_r('要执行文章目录转移');
	token_check();
	
	$cat_id=safe_convert($_POST['cat_id']);
	$target_cat_id=safe_convert($_POST['target_cat_id']);
	//die($cat_id);
	//var_dump($_POST);
	
	$sql="update `article_content` set `artid`={$target_cat_id} where `artid` ={$cat_id}";
	//die($sql);
	$db->query($sql);
	echo "<script>alert('转换成功！')</script>";
	}
	
	
	if (isset($_POST['pagedo'])	&& $_POST['pagedo']=='add' && 
	isset($_POST['parent_id']) && ($_POST['parent_id']!='')  && isset($_POST['cat_name']) && ($_POST['cat_name']!='')
	){
	//print_r('要执行添加分类');
	token_check();
	$parent_id=safe_convert($_POST['parent_id']);
	$cat_name=safe_convert($_POST['cat_name']);
	
		if ($parent_id=='0'){
		//这是创建顶级分类的方法
		//这里要锁表，还没做
		$sql='select max(id) from article';
		$result=$db->query($sql);
			while($row=$db->getarray($result)){
			//die($row[0]);//就是当前最大的id
			$maxid=$row[0];
			}
		$sql="insert into article(artclass,grade,superior,rootid) values ('{$cat_name}',1,0,'{$maxid}') ";
		}
		else{//这是创建非顶级分类的方法
		$sql="select * from article where id ={$parent_id}";
		$result=$db->query($sql);
		$row=$db->getarray($result);
		//foreach ($row as $key=>$value){
		//die($value);
		$sql="insert into article(artclass,grade,superior,rootid) values ('{$cat_name}',{$row[grade]}+1,{$row[id]},{$row[rootid]}) ";
		//die($sql);
		}
	$db->query($sql);
	echo "<script>alert('添加成功！')</script>";
	//}
	// 把查到的上一层的层级ID和根ID还有名字插入数据库
	}
	
	
	
	//如果是修改文章分类名
	if ($_POST['pagedo']=='editclass'){
	//list($key, $val) = each($_POST);以后再使用一次性safeconvert的写法
	$artclassname=safe_convert($_POST[partclass_txt]);
	$pid=safe_convert($_POST[pid]);
	$sql="update article set `artclass`='$artclassname' where `id`=$pid";
	$db->query($sql);
	}
set_maintplfile();
}

function set_maintplfile(){
global $tpl;
$tpl->set_file("main", "_admin_class_edit.html");
}



$tpl->set_block("main", "list", "nlist"); //第一个参数是什么区块，第二个是区块模板名，第三个是要parse的！
$tpl->set_block("list", "list1", "nlist1"); 
$tpl->set_block("list1", "list2", "nlist2");
$tpl->set_block("list2", "list3", "nlist3");
$tpl->set_block("list3", "list4", "nlist4");
$sql='select * from article where grade=1';
$result=$db->query($sql);
while($row=$db->getarray($result)){//最外层赋值
    $tpl->set_var("nlist1");//一定要的
	$sql2="select * from article where superior='$row[0]'";	
	$result2=$db->query($sql2);
	while($row2=$db->getarray($result2)){//第二层赋值
	    
		$tpl->set_var("nlist2");//一定要的
		$sql3="select * from article where superior='$row2[0]'";	//这里最好改成放在临时表里再查询
		//die ($sql3);
		
		$result3=$db->query($sql3);
		    
		while($row3=$db->getarray($result3)){
			$tpl->set_var("nlist3");
			$sql4="select * from article where superior='$row3[0]'";	//这里最好改成放在临时表里再查询
			$result4=$db->query($sql4);
			while($row4=$db->getarray($result4)){
				$tpl->set_var("nlist4");
				$sql5="select * from article where superior='$row4[0]'";	//这里最好改成放在临时表里再查询
			$result5=$db->query($sql5);
			while($row5=$db->getarray($result5)){
			$tpl->set_var("gradesublevel4", "<tr align=\"center\" class=\"1\">
      <td align=\"left\" class=\"first-cell\" ><span style='padding-left:120px;'><a href=#>$row5[1]</a></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align=\"right\">&nbsp;</td>
      <td align=\"center\"><a href=\"admin_class_edit.php?action=move&cat_id=1\">转移分类內的文章</a> |
      <a href=\"javascript:void(0)\" onclick=\"sAlert('请输入要修改的分类名','$row5[1]',$row5[0]);\">编辑 </a> |
      <a href=\"javascript:void(0)\" onclick=\"if (DeleteConfirm('是否删除该五级栏目:[$row5[1]]?')){this.href='admin_class_edit.php?action=del&id=$row5[0]';}\" title=\"移除\">移除</a></td>
    </tr>");	//依次类推，可以做出无限嵌套，只是花时间写算法的问题了,暂时写个4级的!!
		$tpl->parse("nlist4","list4",true);
			}
			$tpl->set_var("gradesublevel3", "<tr align=\"center\" class=\"1\">
      <td align=\"left\" class=\"first-cell\" ><span style='padding-left:90px;'><a href=#>$row4[1]</a></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align=\"right\">&nbsp;</td>
      <td align=\"center\"><a href=\"admin_class_edit.php?action=move&cat_id=1\">转移分类內的文章</a> |
      <a href=\"javascript:void(0)\" onclick=\"sAlert('请输入要修改的分类名','$row4[1]',$row4[0]);\">编辑 </a> |
      <a href=\"javascript:void(0)\" onclick=\"if (DeleteConfirm('是否删除该四级栏目:[$row4[1]]?')){this.href='admin_class_edit.php?action=del&id=$row4[0]';}\" title=\"移除\">移除</a></td>
    </tr>");	//依次类推，可以做出无限嵌套，只是花时间写算法的问题了,暂时写个4级的!!
		$tpl->parse("nlist3","list3",true);
			}
		$tpl->set_var("gradesublevel2", "<tr align=\"center\" class=\"1\">
      <td align=\"left\" class=\"first-cell\" ><span style='padding-left:60px;'><a href=#>$row3[1]</a></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align=\"right\">&nbsp;</td>
      <td align=\"center\"><a href=\"admin_class_edit.php?action=move&cat_id=1\">转移分类內的文章</a> |
      <a href=\"javascript:void(0)\" onclick=\"sAlert('请输入要修改的分类名','$row3[1]',$row3[0]);\">编辑 </a> |
      <a href=\"javascript:void(0)\" onclick=\"if (DeleteConfirm('是否删除该三级栏目:[$row3[1]]?')){this.href='admin_class_edit.php?action=del&id=$row3[0]';}\" title=\"移除\">移除</a></td>
    </tr>");	//依次类推，可以做出无限嵌套，只是花时间写算法的问题了,暂时写个3级的!!
		$tpl->parse("nlist2","list2",true);
		}
	$tpl->set_var("gradesub", "<tr align=\"center\" class=\"1\">
      <td align=\"left\" class=\"first-cell\" ><span style='padding-left:30px;'><a href=#>$row2[1]</a></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align=\"right\">&nbsp;</td>
      <td align=\"center\"><a href=\"admin_class_edit.php?action=move&cat_id=1\">转移分类內的文章</a> |
      <a href=\"javascript:void(0)\" onclick=\"sAlert('请输入要修改的分类名','$row2[1]',$row2[0]);\">编辑 </a> |
      <a href=\"javascript:void(0)\" onclick=\"if (DeleteConfirm('是否删除该二级栏目:[$row2[1]]？')){this.href='admin_class_edit.php?action=del&id=$row2[0]';}\" title=\"移除\">移除</a></td>
    </tr>");	//里面还是嵌套模板
	$tpl->parse("nlist1", "list1", true); 
	}
$tpl->set_var("gradetop", "<tr align=\"center\" class=\"1\">
      <td align=\"left\" class=\"first-cell\" ><span><a href=#>$row[1]</a></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align=\"right\">&nbsp;</td>
      <td align=\"center\"><a href=\"admin_class_edit.php?action=move&cat_id=1\">转移分类內的文章</a> |
      <a href=\"javascript:void(0)\" onclick=\"sAlert('请输入要修改的分类名','$row[1]',$row[0]);\">编辑 </a> |
      <a href=\"javascript:void(0)\" onclick=\"if (DeleteConfirm('是否删除该一级栏目：[$row[1]]？')){this.href='admin_class_edit.php?action=del&id=$row[0]';}\" title=\"移除\">移除</a></td>
    </tr>");
$tpl->parse("nlist", "list", true);
}



$md=new evp_makejs();
//生成用添加分类用的下拉列表JS
if ($md->make_catelog_Dropdownlist_js()){
/*echo "<script>alert('生成下拉列表OK')</script>";*/
}
//生成用添加文章用的下拉列表JS
if ($md->make_catelog_Dropdownlist_js2()){
/*echo "<script>alert('生成下拉列表OK')</script>";*/
}

//完成替换
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");

?>
