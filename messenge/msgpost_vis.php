<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<?php
//include("../include/checkpostandget.php");
include("../include/session_mysql.php");
//include("../fckeditor.php") ;
session_start();
if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
?>
<head>
		<title>发文</title>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<meta name="robots" content="noindex, nofollow">
			<link rel=stylesheet href="../css/css.css" type="text/css">
		<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
<!--
function alertx(){
if (document.getElementById("tit").value=="")
{
alert("主题不能为空！");
return false;
}

}
//-->
</SCRIPT>
<script type="text/javascript" src="../editor/ubb/ubbeditor.js"></script>
<script type="text/javascript" src="../js/static/browser.js"></script>
<script type="text/javascript">
function insertemot (emotcode) {
	var current=document.getElementById('content');
	var emot="[emot]"+emotcode+"[/emot]";
	if (current) {
		if (current.value!='' && current.value!=null) {
			current.value+=emot;
		}
		else {
			current.value=emot;
		}
	}
}

/*function insertemot (emotcode) {
	var emot="[emot]"+emotcode+"[/emot]";
	AddText(emot);
	document.getElementById('emotid').style.display='none';
}
*/
function showemot () {
	if (document.getElementById('emotid').style.display=='block') document.getElementById('emotid').style.display='none';
	else document.getElementById('emotid').style.display='block';
}
function toggle_upload() {
	var panelmoreless=document.getElementById('FrameUpload');
	if (is_moz) var htmlin="<iframe width=90% frameborder=0 height=95 frameborder=0 src='admin.php?act=upload'></iframe>";
	else htmlin="<iframe width=95% frameborder=0 height=120 frameborder=0 scrolling=no src='admin.php?act=upload'></iframe>";
    if(panelmoreless){
      if(panelmoreless.style.display=='none'){
        panelmoreless.style.display='block';
		panelmoreless.innerHTML=htmlin;
		} else{
			panelmoreless.style.display='none';
		}
    }
}
</script>
</head>
<BODY  topmargin=0 onload="init_ubb('content');">
<?php
$Recipientx=$_GET['Recipient'];
//回复标记
$ac=$_GET['action'];
//$replytitle=base64_decode($_GET['title']);//乱码问题未处理
$replytitle=$_GET['title'];
//echo $ac;
//echo "Recipientx是".$Recipientx;
include("../include/dbclass.php");
//根据昵称查处要发的人id
//$res=$db->query("select nickname from usr where id='{$Recipientx}';");
//$row=$db->getarray($res);
//$recid=$row[nickname];
echo "<form action=\"postresult_vis.php\" method=\"post\" target=\"_blank\" name=pstmsg id=pstmsg \n";
echo "onsubmit=\"javascript :return alertx();\">\n";
if(isset($_GET['Recipient'])){
echo "发给<INPUT TYPE=\"text\" NAME=\"Recipient\" readonly id=\"Recipient\" value= ".$Recipientx.">";}
else{//假如是发文
$Recipientx=$_POST['newRight'];
echo "<INPUT TYPE=\"text\" NAME=\"Recipient\" readonly id=\"Recipient\" value=".$Recipientx.">";
//$Recipientx = preg_split ("/[,]+/", $Recipientx);
//echo $v[2];
}
?>
重要性<INPUT TYPE="radio" NAME="lv" value="1">重要
<INPUT TYPE="radio" NAME="lv" value="0" checked>普通<br>
<A HREF="">从通讯录添加</A>  |  <A HREF="">添加抄送</A>  -  <A HREF="">添加密送</A><BR>
主题<INPUT TYPE="text" NAME="bt" size=70 maxlength=40 id = "tit" <?php if($ac=='reply'){echo "value=".$replytitle."[回复]";}?>>
<BR>
<a href="JavaScript: void(0); "><IMG border=0 onclick="bold()" title="粗体" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/bold.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="italicize()" title="斜体" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/italic.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="underline()" title="下划线" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/underline.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="strike()" title="删除线" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/strikethrough.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="subsup('sup')" title="上标" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/superscript.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="subsup('sub')" title="下标" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/subscript.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="center()" title="设置文字对齐方式" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/center.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="hyperlink()" title="插入超链接" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/url.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="email()" title="插入邮件地址" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/email.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="image()" title="插入图片" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/insertimage.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addmedia('swf');" title="插入Flash" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/swf.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addmedia('wmp');" title="插入Windows Media Player文件" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/wmp.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addmedia('real');" title="插入Real文件" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/real.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="showcode()" title="插入代码" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/code.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="quoteme()" title="插入引用文字" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/quote.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addacronym();" title="插入注释文字" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/acronym.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="AddText('[hr]')" title="插入分割线" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/line.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addfile();" title="插入普通文件下载" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/file.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addsfile();" title="插入注册会员才可下载的文件" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/sfile.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="showemot()" title="表情选择" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/insertsmile.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="AddText('[separator]')" title="插入截断符" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/separator.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="AddText('[newpage]')" title="插入分页符" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/newpage.gif" ></a>
<script type="text/javascript">
if (is_firefox) {
	document.write("<a href='JavaScript: void(0); '><IMG border=0 onclick='undo_fx();' title='挽回数据' src='<?php $DOCUMENT_ROOT?>/editor/ubb/images/undo.gif' ></a>");
}
</script>
<br>
<div id='emotid' style="display: none;">

<a href="javascript: insertemot('anger');"><img src="../image/emot/thumbnail/anger.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('bad');"><img src="../image/emot/thumbnail/bad.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('cool');"><img src="../image/emot/thumbnail/cool.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('cry');"><img src="../image/emot/thumbnail/cry.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('dog');"><img src="../image/emot/thumbnail/dog.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('envy');"><img src="../image/emot/thumbnail/envy.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('fear');"><img src="../image/emot/thumbnail/fear.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('grin');"><img src="../image/emot/thumbnail/grin.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('kill');"><img src="../image/emot/thumbnail/kill.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('love');"><img src="../image/emot/thumbnail/love.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('pig');"><img src="../image/emot/thumbnail/pig.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('puke');"><img src="../image/emot/thumbnail/puke.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('question');"><img src="../image/emot/thumbnail/question.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('shock');"><img src="../image/emot/thumbnail/shock.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('shuai');"><img src="../image/emot/thumbnail/shuai.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('shy');"><img src="../image/emot/thumbnail/shy.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('sleepy');"><img src="../image/emot/thumbnail/sleepy.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('smile');"><img src="../image/emot/thumbnail/smile.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('smoke');"><img src="../image/emot/thumbnail/smoke.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('stupid');"><img src="../image/emot/thumbnail/stupid.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('sweat');"><img src="../image/emot/thumbnail/sweat.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('thumbdown');"><img src="../image/emot/thumbnail/thumbdown.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('unhappy');"><img src="../image/emot/thumbnail/unhappy.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('uplook');"><img src="../image/emot/thumbnail/uplook.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('zan');"><img src="../image/emot/thumbnail/zan.gif" alt='emot' border='0'/></a><br/>
</div>
 字体： 
<select onChange=showfont(this.options[this.selectedIndex].value) name=font>
<option value="#define#" selected>请选择字体</option>
<option value="宋体">宋体</option>
<option value="楷体_GB2312">楷体_GB2312</option>
<option value="新宋体">新宋体</option>
<option value="黑体">黑体</option>
<option value="隶书">隶书</option>
<option value="仿宋_GB2312">仿宋_GB2312</option>
<option value=Arial>Arial</option>
<option value=Tahoma>Tahoma</option>
<option value=Verdana>Verdana</option>
<option value="Times New Roman">Times New Roman</option>
<option value="Bookman Old Style">Bookman Old Style</option>
<option value="Century Gothic">Century Gothic</option>
<option value="Comic Sans MS">Comic Sans MS</option>
<option value="Courier New">Courier New</option>
<option value="Wingdings">Wingdings</option>
<option value="#define#">自定义</option>
</select>
&nbsp;&nbsp;字号：
<select onChange=showsize(this.options[this.selectedIndex].value) name=size>
<option value="#define#" selected>请选择字号</option>
<option value=1>1</option>
<option value=2>2</option>
<option value=3>3</option>
<option value=4>4</option>
<option value=5>5</option>
<option value=6>6</option>
</select>
&nbsp;&nbsp;颜色： 
<select onChange=showcolor(this.options[this.selectedIndex].value) name=color>
<option value="#define#" selected>请选择颜色</option>
<option value="#87CEEB" style="color:#87CEEB">天蓝</option>
<option value="#4169E1" style="color:#4169E1">品蓝</option>
<option value="#0000FF" style="color:#0000FF">蓝</option>
<option value="#00008B" style="color:#00008B">暗蓝</option>
<option value="#FFA500" style="color:#FFA500">橙</option>
<option value="#FF4500" style="color:#FF4500">桔红</option>
<option value="#DC143C" style="color:#DC143C">深红</option>
<option value="#FF0000" style="color:#FF0000">红</option>
<option value="#B22222" style="color:#B22222">棕</option>
<option value="#8B0000" style="color:#8B0000">暗红</option>
<option value="#008000" style="color:#008000">绿色</option>
<option value="#32CD32" style="color:#32CD32">灰绿</option>
<option value="#2E8B57" style="color:#2E8B57">海绿</option>
<option value="#FF1493" style="color:#FF1493">粉</option>
<option value="#FF6347" style="color:#FF6347">西红柿色</option>
<option value="#FF7F50" style="color:#FF7F50">珊瑚色</option>
<option value="#800080" style="color:#800080">紫色</option>
<option value="#4B0082" style="color:#4B0082">靛青</option>
<option value="#DEB887" style="color:#DEB887">棕木</option>
<option value="#F4A460" style="color:#F4A460">沙褐</option>
<option value="#A0522D" style="color:#A0522D">土黄</option>
<option value="#D2691E" style="color:#D2691E">巧克力色</option>
<option value="#008080" style="color:#008080">土绿</option>
<option value="#C0C0C0" style="color:#C0C0C0">银</option>
<option value="#define#">自定义</option>
</select>
[<a href="javascript: toggle_upload();">上传文件管理器</a>]
<div id="FrameUpload" style="display: none;"></div>
<TABLE>
<TR>
<TD align=center><textarea name='content' id='content'      rows='10' cols='80' class='formtextarea'></textarea>
<input type=hidden id='content_old' value=''><BR>
<INPUT TYPE="hidden" name="uid" value="<?php echo $Recipientx;?>"></TD>
</TR>
<tr>
<td align=center><INPUT TYPE="submit" value="提交" class=mybutton>&nbsp;<INPUT TYPE="reset" value="重置" class=mybutton></td>
</tr>
</TABLE>
<br><ul>
<script type="text/javascript">
if (is_firefox) {	document.write("针对Mozilla/Firefox/Flock用户的特别提示：</B><BR>如果执行一个操作后编辑器发生意外（Gecko核心的一个问题，原因不明），清空了所有数据，请点击<img border=0 title='挽回数据' src='images/undo.gif'> 按钮，将挽回上一次编辑前的数据。正常情况下请勿使用。",
743=>"<B>如何只在首页显示一部分内容？</B><br>要在首页只显示一部分内容，并在点击“阅读全文”后才能看到完整内容，请在需要截断日志的地方插入<B>[separator]</B>标记。或者，您可以点击编辑栏上的 <IMG border=0 onclick=\"AddText('[separator]')\" title=\"插入截断符\" src=\"images/separator.gif\" > 按钮。");
}
</script>
</form>
</body>
</html>