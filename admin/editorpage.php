<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
include('../include/session_mysql.php');
session_start();
if (!isset($_SESSION['admin_id'])) die('没有权限');

include("../fckeditor.php") ;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>编辑器</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex, nofollow">
<link href="sample.css" rel="stylesheet" type="text/css" />
<style type="text/css">
		.editspan{
		border:1px solid  #666666; background-color: #CCCCCC; padding:2px; cursor:pointer;
		}
		</style>
<script type="text/javascript">

function FCKeditor_OnComplete( editorInstance )
{
	var oCombo = document.getElementById( 'cmbToolbars' ) ;
	oCombo.value = editorInstance.ToolbarSet.Name ;
	oCombo.style.visibility = '' ;
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
<body style="margin-left:20px; padding:0px;">
<div align="center">
  <form action="admin_post_article.php" method="post" target="_blank" >
    <?php
error_reporting(7);
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
$oFCKeditor->ToolbarSet = htmlspecialchars('mytoolbar');//工具按钮 
//$oFCKeditor->ToolbarSet = htmlspecialchars('Basic');//工具按钮 
$oFCKeditor->Value = '' ;//;设置初始内容
$oFCKeditor->Width="100%";  //设置它的宽度
$oFCKeditor->Height="270px";  //设置它的高度 
$oFCKeditor->Create() ;
?>
    <br>
    <div align=right><span><a href=#><img border="0" src="image/sub.gif" alt='收起编辑器' align="absmiddle" onClick="resizeEditor(-100)"></a></span>&nbsp;&nbsp;&nbsp;<span><a href=#><img border="0" alt='加长编辑区' src="image/add.gif" align="absmiddle" onClick="resizeEditor(100)"></a></span></div>
  </form>
  <script>function getEditorHTMLContents(EditorName){//获取编辑器中HTML内容
	  var oEditor = FCKeditorAPI.GetInstance(EditorName); 
	  return(oEditor.GetXHTML(true)); 
  }
function SetEditorContents(EditorName, ContentStr){//设置编辑器中内容
	var oEditor = FCKeditorAPI.GetInstance(EditorName); 
	oEditor.SetHTML(ContentStr) ; 
}

/*function getEditorTextContents(EditorName)
{ 
    var oEditor = FCKeditorAPI.GetInstance(EditorName); 
    return(oEditor.EditorDocument.body.innerText); 
}*/
//为编辑时候传递从数据库过来的content值


function FCKeditor_OnComplete( editorInstance )//FCK的回调函数，让他传递父框架的隐藏frame到里面
{
    //alert( editorInstance.Name ) ;
	parent.document.getElementById('hidval2editor_btn').click();
}
/*FCKeditor_OnComplete(FCKeditor1)*/
</script>
<!--<input type="button" id="ceshi" value="ceshi" onClick="alert(getEditorHTMLContents('FCKeditor1'))">-->
</div><!--<label>
                <input type="button" name="Submit3" value="test" onClick="SetEditorContents('FCKeditor1','me,me,me')">
                </label>-->
</body>
</html>
