<?php 

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");


include("../fckeditor.php") ;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>add_article.php</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="noindex, nofollow">
		<link href="sample.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">

function FCKeditor_OnComplete( editorInstance )
{
	var oCombo = document.getElementById( 'cmbToolbars' ) ;
	oCombo.value = editorInstance.ToolbarSet.Name ;
	oCombo.style.visibility = '' ;
}




function alertx(){
	if (document.getElementById('bt').value=="")
	{
		alert("请填写文章标题！");
		return false;
	}
	
}
 
 
function resizeEditor(change) {    //控制fck高度用的函数
    var newheight = parseInt(document.getElementById('FCKeditor1___Frame').height, 10) + change;   
    if(newheight >= 250) {   
        document.getElementById('FCKeditor1___Frame').height = newheight + 'px';   
    }   
}   
//-->
</SCRIPT>

	</head>
	<body>
		<div style='text-align:center;letter-spacing: 2px'><h4>添加文章</h4></div>
		<div style='font-size:12px;display:inline;'><form action="admin_post_article.php" method="post" target="_blank" onsubmit="javascript :return alertx();">
		文章标题<INPUT TYPE="text" NAME="bt" id='bt' style='padding-top:0px;font: 12px Tahoma, Verdana; color: #333333; font-weight: normal; background-color: white '>文章所属
		<SELECT NAME="aclass"><option value=na>请选择文章类别</option><option value=1/1>网上办事</option><option value=2/2>制度规定</option><option value=6/2>制度规定-2000发文</option><option value=7/2>制度规定-2001发文</option><option value=8/2>制度规定-2002发文</option><option value=9/2>制度规定-2003发文</option><option value=10/2>制度规定-2004发文</option><option value=11/2>制度规定-2005发文</option><option value=12/2>制度规定-2006发文</option><option value=15/2>制度规定-2007发文</option><option value=13/2>制度规定-ISO9001</option><option value=14/2>制度规定-安全责任书</option><option value=3/3>会议纪要</option></SELECT>
		
		
		</script>发布部门<!--JS下拉开始  -->
<SCRIPT LANGUAGE="JavaScript" src='../js/dep_s_article.js' charset="utf8"></script><!-- JS下拉完成 -->链接颜色<input id="color" style='width:60px;' /><input type="button" value="选择" onclick="window.showModelessDialog('colorpicker/colordialog.html', color, 'help:no;status:no');" /><!-- <select name=linkcolor><option value=na>默认</option><option value=1>红</option><option value=2>蓝</option></select> --><!-- <INPUT TYPE="checkbox" NAME="fawen">这是一个发文</input> --><input type="submit" value="发布文章"></div>
<?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = $sBasePath ;
$oFCKeditor->BasePath = "../admin/";
//if ( isset($_GET['Toolbar']) )
//	$oFCKeditor->ToolbarSet = htmlspecialchars($_GET['Toolbar']);
//改成basic
$oFCKeditor->ToolbarSet = htmlspecialchars('Default');//工具按钮 
//$oFCKeditor->ToolbarSet = htmlspecialchars('Basic');//工具按钮 
$oFCKeditor->Value = '' ;//;设置初始内容
$oFCKeditor->Width="100%";  //设置它的宽度
$oFCKeditor->Height="330px";  //设置它的高度 



$oFCKeditor->Create() ;
?>
			<br>
			<div align=right><span><a href=#><img border="0" src="image/sub.gif" alt='收起编辑器' align="absmiddle" onclick="resizeEditor(-100)"></a></span>&nbsp;&nbsp;&nbsp;<span><a href=#><img border="0" alt='加长编辑区' src="image/add.gif" align="absmiddle" onclick="resizeEditor(100)"></a></span></div>

	</form>	
	</body>
</html>