<?php 

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");


include("../fckeditor.php") ;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>add_bulletin.php</title>
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

//-->
</SCRIPT>

	</head>
	<body>
		<div style='text-align:center;letter-spacing: 3px'><h3>添加公告</h3></div><div style='font:12px;padding:0;margin:0;'>提示：如果下拉列表中没出现组设置里的部门，请在该页面右键点击刷新</div>
		<form action="admin_post_article.php" method="post" target="_blank" onsubmit="javascript :return alertx();">
		公告标题<INPUT TYPE="text" NAME="bt" id='bt' style='padding-top:0px;font: 12px Tahoma, Verdana; color: #333333; font-weight: normal; background-color: white '>发布部门<!--JS下拉开始  -->
<SCRIPT LANGUAGE="JavaScript" src='../js/dep_s_article.js' charset="gb2312"></script><!-- JS下拉完成 -->
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
$oFCKeditor->ToolbarSet = htmlspecialchars('Default');
//$oFCKeditor->ToolbarSet = htmlspecialchars('Basic');
$oFCKeditor->Value = '' ;
$oFCKeditor->Create() ;
?>
			<br>
			<input type="submit" value="发布"><INPUT TYPE="hidden" name='article_or_bulletin' value=1>
	</form>	
	</body>
</html>