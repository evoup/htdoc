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

function open_ann(){
/*if (document.getElementById('textareaann').style.display=='none'){alert('gg')}*/
}
//-->
</SCRIPT>
<style type="text/css">
<!--
#textareaann{
display:block;
}
body{font:12px;}
-->
</style>
<body> 

	</head>
	<body>
		<div style='text-align:center;letter-spacing: 3px'><h3>添加公告</h3></div>
		<form action="admin_post_article.php" method="post" target="_blank" onSubmit="javascript :return alertx();">
		  <div align="center">公告标题
		    <INPUT TYPE="text" NAME="bt" id='bt' style='padding-top:0px;font: 12px Tahoma, Verdana; color: #333333; font-weight: normal; background-color: white '>
		    <span style='margin-left:10px;'>发布部门
		    <!--JS下拉开始  -->
            <SCRIPT LANGUAGE="JavaScript" src='../js/dep_s_article.js' charset="utf8"></script>
            <!-- JS下拉完成 name=a1 -->
		    </span>
		    <!-- 滚动新闻判断开始 -->
		    <span style='margin-left:10px;'>是否加入滚动新闻
		    <INPUT TYPE="checkbox" NAME="ck_announce" value='1' onclick='open_ann'>
		    </span>
		    <!-- 滚动新闻判断结束 -->
            <br>
		  </div>
		  <div style='text-align:center;margin-top:10px;'><div id=textareaann >滚动新闻显示<textarea  name=tx_ann style='width:590px;height:40pt;background:#DEEFFF'></textarea></div>
公告文章内容<textarea  name=input_bulletin style='width:590px;height:80pt;background:#DEEFFF'></textarea><p>   （支持UBB语法,如果你要加超链接，可以这样	[url]www.sina.com[/url]	）</p>
</div>


</div>
			<div style='text-align:center;margin-top:10px'><input type="submit" value="发布" ><INPUT TYPE="hidden" name='article_or_bulletin' value=1>
	</form>	
</body>
</html>