
<!-- saved from url=(0028)index.php -->
<HTML xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>������ҵ�ڲ��� - ׫д��Ϣ�ͷ���</TITLE>
<META http-equiv=content-type content="text/html; charset=gb2312">
<META content=jiayi name=description>
<META content=your,keywords,goes,here name=keywords>
<META content="jiayi / Design : evoup" name=author>
<LINK href="../css/css.css" type=text/css rel=stylesheet>
<LINK media=all href="../css/style_3div.css" type=text/css rel=stylesheet>
</HEAD>
<BODY  topmargin=0 onload="init_ubb('content');">

<DIV id=page-container><!-- HEADER --><!-- Global Navigation -->
<H3 class=hide>ȫվ����</H3>
<DIV class=nav-global-container>
<DIV class="nav-global nav-global-font">
<UL>
  <LI><A href="../index.php">��ҳ</A> </LI>
  <LI><A href="../index.php#">��ҵ����</A> </LI>
  <LI><A href="../index.php#">Impressum</A> </LI></UL></DIV></DIV><!-- Sitename and Banner -->
<DIV class=site-name>������ҵ�ڲ��� 
<DIV class=site-slogan>�����ڷɣ�ͨ����</DIV></DIV>
<DIV><IMG class=img-header alt="" src="../image/3divheader.jpg"></DIV><!-- Main Navigation -->
<H3 class=hide>Top Navigation</H3>
<DIV class="nav-main nav-main-font">
<UL>
  <LI><A href="../index.php">��ҳ</A> </LI>
  <LI><A class=selected href="../content.html">�ƶȹ涨</A> </LI>
  <LI><A href="../options.html">ѡ��</A> </LI></UL></DIV><!-- Sub-Navigation -->
<H3 class=hide>��Ŀ����</H3>
<DIV class="nav-sub nav-sub-font nav-sub-align">
<DIV class=buffer></DIV><!-- <iframe src="login.html" width="160px" frameborder="0"></iframe> -->
<SCRIPT language=JavaScript src=""></SCRIPT>
 <IMG alt="" src="../image/email.gif" border=0>����Ϣ<A 
href="msgview_i.php">[<SPAN id=msgunread 
style="DISPLAY: inline">0</SPAN>]</A>δ�� 
<DIV 
style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; LEFT: 0px; PADDING-BOTTOM: 5px; OVERFLOW: auto; WIDTH: 140px; PADDING-TOP: 5px; POSITION: absolute; TOP: 40px"></DIV>
<DIV id=leijia value="0"></DIV><IMG alt="" src="../image/sch.gif"></DIV><!-- WRAP CONTENT AND SIDEBAR -->
<DIV class=container-content-sidebar><!-- 	CONTENT -->
<H3 class=hide>Content</H3>
<DIV class="content content-font"><!-- Page title -->
<DIV class=content-pagetitle>
<P></P></DIV>
<!--code-->

<SCRIPT LANGUAGE="JavaScript">
<!--
//alert("-_-!!");
//alert(parent.main.document.getElementById("xx").value);
//-->
</SCRIPT>
<?php
//include("../include/checkpostandget.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
//include("../fckeditor.php") ;
session_start();
if (!isset($_SESSION ['name'])) 
{
die("��û��Ȩ�޽��뱾��Ŀ!");
}
?>

<?php
/**
 * Example file
 * 
 * @author   Marcos Thiago <fabismt@yahoo.com.br>
 * @version  1.0
 * @since    06/2004
 * @package  UPLOAD_FILES
 */

require_once("../include/class_UPLOAD.php");
$upload =& new UPLOAD_FILES();

if($_FILES){
  foreach($_FILES as $key => $file){

    $upload->set("name",$file["name"]); // Uploaded file name.

    $upload->set("type",$file["type"]); // Uploaded file type.
    
    $upload->set("tmp_name",$file["tmp_name"]); // Uploaded tmp file name.
    
    $upload->set("error",$file["error"]); // Uploaded file error.
    
    $upload->set("size",$file["size"]); // Uploaded file size.
    
    $upload->set("fld_name",$key); // Uploaded file field name.
    
    $upload->set("max_file_size",4096000); // Max size allowed for uploaded file in bytes = 4000 KB.
    
    $upload->set("supported_extensions",array("ppt"=>"application/powerpoint","bmp"=>"image/x-ms-bmp","xls" => "application/excel" ,"png" => "image/png" ,"zip" => "application/zip" ,"rar" => "file/rar" ,"doc" => "application/msword" ,"gif" => "image/gif" ,"jpg" => "image/pjpeg","jpeg" => "image/pjpeg" ,"png" => "image/x-png")); // Allowed extensions and types for uploaded file.
    
    $upload->set("randon_name",FALSE); // Generate a unique name for uploaded file? bool(true/false).

    $upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
    
    $upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).

    $upload->set("dst_dir",$_SERVER["DOCUMENT_ROOT"]."/upload_dir/attachments/"); // Destination directory for uploaded files.

    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
  }
}
?>



<?php
//require_once("../include/class_UPLOAD.php");
//include("../include/checkpostandget.php");
//include("../include/session_mysql.php");
include("../include/classdate.php");
include("../include/common.php");

//�����Զ����
$name=$_SESSION ['name'];
$Recipient=safe_convert($_POST['Recipient']);
$lv=safe_convert($_POST['lv']);
$bt=safe_convert($_POST['bt']);
if (isset($_POST['lv']))
{
if (ltrim(trim($bt))=='')
{echo "<script language='javascript'>alert('����գ�');window.close();</script>";}
else
{
//��hidden������sql��uid����
$rd=safe_convert($_POST['uid']);
$postedValue=safe_convert($_POST['content']);
$sqlx="select *  from usr  where id='{$rd}';";
$totlerows=$db->getcount($sqlx);
if($totlerows==0){
echo "û���Ǹ�Ա����";
}
}

$d = safe_convert(date("Y-m-d H:i"));
$ary = explode(",",$rd); 


for ($i=0;$i<sizeof($ary);$i++) {  $tmp=$ary[$i];
$sql="INSERT INTO msg(sender,inceptid,important,title,content,sendtime) VALUES('{$name}','{$tmp}','{$lv}','{$bt}','{$postedValue}','{$d}');";
//echo '<FONT SIZE=\"\" COLOR=\"#33FF66\">121212</FONT>';
if($result=$db->query($sql))
	{//echo "��Ϣ�Ѿ��ɹ����͵���$Recipient";
}
$attachmsg=$db->getid();
echo "attachmsg��".$attachmsg;

}

//echo "<script language='javascript'>alert('��Ϣ���ͳɹ���');window.close();</script>";
}
?>


<?php



    if($upload->succeed_files_track || $upload->fail_files_track){
      print "<pre>";
      print "<b>Succeed Files Track Array:<br></b>";
      print_r($upload->succeed_files_track); 
      print "<b>Fail Files Track Array:<br></b>";
      print_r($upload->fail_files_track); 
      print "</pre>";
	 if($upload->succeed_files_track){
	  $new_file=$upload->succeed_files_track[0]["new_file_name"];
	  if ($new_file!=''){
$sql2="INSERT INTO attachments(src,name,msgid) VALUES('{$new_file}','{$new_file}','{$attachmsg}')";
$db->query($sql2);}

	  $new_file=$upload->succeed_files_track[1]["new_file_name"];
	  if ($new_file!=''){
$sql2="INSERT INTO attachments(src,name,msgid) VALUES('{$new_file}','{$new_file}','{$attachmsg}')";
$db->query($sql2);}
	  $new_file=$upload->succeed_files_track[2]["new_file_name"];
	  if ($new_file!=''){
$sql2="INSERT INTO attachments(src,name,msgid) VALUES('{$new_file}','{$new_file}','{$attachmsg}')";
$db->query($sql2);}
	  $new_file=$upload->succeed_files_track[3]["new_file_name"];
	  if ($new_file!=''){
$sql2="INSERT INTO attachments(src,name,msgid) VALUES('{$new_file}','{$new_file}','{$attachmsg}')";
$db->query($sql2);}$sql3="update msg set withattach=1 where msgid=$attachmsg";
//echo $sql3;
$db->query($sql3);
}

    }
    ?>


		<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
<!--
function alertx(){
if (document.getElementById("tit").value=="")
{
alert("���ⲻ��Ϊ�գ�");
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
function showupload () {
	if (document.getElementById('uploadid').style.display=='block') document.getElementById('uploadid').style.display='none';
	else document.getElementById('uploadid').style.display='block';
}
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


<?php
$Recipientx=$_GET['Recipient'];
//�ظ����
$ac=$_GET['action'];
//$replytitle=base64_decode($_GET['title']);//��������δ����
$replytitle=$_GET['title'];
//echo $ac;
//echo "Recipientx��".$Recipientx;
//include("../include/dbclass.php");
//�����ǳƲ鴦Ҫ������id
//$res=$db->query("select nickname from usr where id='{$Recipientx}';");
//$row=$db->getarray($res);
//$recid=$row[nickname];
echo "<form action=\"msgpost_ubb.php\" enctype=\"multipart/form-data\" method=\"post\" target=\"_blank\" name=upload id=upload \n";
echo "onsubmit=\"javascript :return alertx();\">\n";
if(isset($_GET['Recipient'])){
echo "����<INPUT TYPE=\"text\" NAME=\"Recipient\" readonly id=\"Recipient\" value= ".$Recipientx.">";}
else{//�����Ƿ���
$Recipientx=$_POST['newRight'];
echo "<INPUT TYPE=\"text\" NAME=\"Recipient\" readonly id=\"Recipient\" value=".$Recipientx.">";
//$Recipientx = preg_split ("/[,]+/", $Recipientx);
//echo $v[2];
}
?><A HREF="#maodian"></A>
��Ҫ��<INPUT TYPE="radio" NAME="lv" value="1">��Ҫ
<INPUT TYPE="radio" NAME="lv" value="0" checked>��ͨ<br>
<A HREF="">��ͨѶ¼���</A>  |  <A HREF="">��ӳ���</A>  -  <A HREF="">�������</A><BR>
����<INPUT TYPE="text" NAME="bt" size=70 maxlength=40 id = "tit" <?php if($ac=='reply'){echo "value=".$replytitle."[�ظ�]";}?>>
<BR>
<a href="JavaScript: void(0); "><IMG border=0 onclick="bold()" title="����" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/bold.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="italicize()" title="б��" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/italic.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="underline()" title="�»���" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/underline.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="strike()" title="ɾ����" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/strikethrough.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="subsup('sup')" title="�ϱ�" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/superscript.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="subsup('sub')" title="�±�" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/subscript.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="center()" title="�������ֶ��뷽ʽ" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/center.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="hyperlink()" title="���볬����" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/url.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="email()" title="�����ʼ���ַ" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/email.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="image()" title="����ͼƬ" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/insertimage.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addmedia('swf');" title="����Flash" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/swf.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addmedia('wmp');" title="����Windows Media Player�ļ�" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/wmp.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addmedia('real');" title="����Real�ļ�" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/real.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="showcode()" title="�������" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/code.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="quoteme()" title="������������" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/quote.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addacronym();" title="����ע������" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/acronym.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="AddText('[hr]')" title="����ָ���" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/line.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addfile();" title="������ͨ�ļ�����" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/file.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="addsfile();" title="����ע���Ա�ſ����ص��ļ�" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/sfile.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="showemot()" title="����ѡ��" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/insertsmile.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="AddText('[separator]')" title="����ضϷ�" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/separator.gif" ></a>
<a href="JavaScript: void(0); "><IMG border=0 onclick="AddText('[newpage]')" title="�����ҳ��" src="<?php $DOCUMENT_ROOT?>/editor/ubb/images/newpage.gif" ></a>
<script type="text/javascript">
if (is_firefox) {
	document.write("<a href='JavaScript: void(0); '><IMG border=0 onclick='undo_fx();' title='�������' src='<?php $DOCUMENT_ROOT?>/editor/ubb/images/undo.gif' ></a>");
}
</script>
<br>
<div id='emotid' style="display: none;">

<a href="javascript: insertemot('anger');"><img src="../image/emot/thumbnail/anger.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('bad');"><img src="../image/emot/thumbnail/bad.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('cool');"><img src="../image/emot/thumbnail/cool.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('cry');"><img src="../image/emot/thumbnail/cry.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('dog');"><img src="../image/emot/thumbnail/dog.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('envy');"><img src="../image/emot/thumbnail/envy.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('fear');"><img src="../image/emot/thumbnail/fear.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('grin');"><img src="../image/emot/thumbnail/grin.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('kill');"><img src="../image/emot/thumbnail/kill.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('love');"><img src="../image/emot/thumbnail/love.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('pig');"><img src="../image/emot/thumbnail/pig.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('puke');"><img src="../image/emot/thumbnail/puke.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('question');"><img src="../image/emot/thumbnail/question.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('shock');"><img src="../image/emot/thumbnail/shock.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('shuai');"><img src="../image/emot/thumbnail/shuai.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('shy');"><img src="../image/emot/thumbnail/shy.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('sleepy');"><img src="../image/emot/thumbnail/sleepy.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('smile');"><img src="../image/emot/thumbnail/smile.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('smoke');"><img src="../image/emot/thumbnail/smoke.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('stupid');"><img src="../image/emot/thumbnail/stupid.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('sweat');"><img src="../image/emot/thumbnail/sweat.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('thumbdown');"><img src="../image/emot/thumbnail/thumbdown.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('unhappy');"><img src="../image/emot/thumbnail/unhappy.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('uplook');"><img src="../image/emot/thumbnail/uplook.gif" alt='emot' border='0'/></a><a href="javascript: insertemot('zan');"><img src="../image/emot/thumbnail/zan.gif" alt='emot' border='0'/></a><br/>
</div>
 ���壺 
<select onChange=showfont(this.options[this.selectedIndex].value) name=font>
<option value="#define#" selected>��ѡ������</option>
<option value="����">����</option>
<option value="����_GB2312">����_GB2312</option>
<option value="������">������</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="����_GB2312">����_GB2312</option>
<option value=Arial>Arial</option>
<option value=Tahoma>Tahoma</option>
<option value=Verdana>Verdana</option>
<option value="Times New Roman">Times New Roman</option>
<option value="Bookman Old Style">Bookman Old Style</option>
<option value="Century Gothic">Century Gothic</option>
<option value="Comic Sans MS">Comic Sans MS</option>
<option value="Courier New">Courier New</option>
<option value="Wingdings">Wingdings</option>
<option value="#define#">�Զ���</option>
</select>
&nbsp;&nbsp;�ֺţ�
<select onChange=showsize(this.options[this.selectedIndex].value) name=size>
<option value="#define#" selected>��ѡ���ֺ�</option>
<option value=1>1</option>
<option value=2>2</option>
<option value=3>3</option>
<option value=4>4</option>
<option value=5>5</option>
<option value=6>6</option>
</select>
&nbsp;&nbsp;��ɫ�� 
<select onChange=showcolor(this.options[this.selectedIndex].value) name=color>
<option value="#define#" selected>��ѡ����ɫ</option>
<option value="#87CEEB" style="color:#87CEEB">����</option>
<option value="#4169E1" style="color:#4169E1">Ʒ��</option>
<option value="#0000FF" style="color:#0000FF">��</option>
<option value="#00008B" style="color:#00008B">����</option>
<option value="#FFA500" style="color:#FFA500">��</option>
<option value="#FF4500" style="color:#FF4500">�ۺ�</option>
<option value="#DC143C" style="color:#DC143C">���</option>
<option value="#FF0000" style="color:#FF0000">��</option>
<option value="#B22222" style="color:#B22222">��</option>
<option value="#8B0000" style="color:#8B0000">����</option>
<option value="#008000" style="color:#008000">��ɫ</option>
<option value="#32CD32" style="color:#32CD32">����</option>
<option value="#2E8B57" style="color:#2E8B57">����</option>
<option value="#FF1493" style="color:#FF1493">��</option>
<option value="#FF6347" style="color:#FF6347">������ɫ</option>
<option value="#FF7F50" style="color:#FF7F50">ɺ��ɫ</option>
<option value="#800080" style="color:#800080">��ɫ</option>
<option value="#4B0082" style="color:#4B0082">����</option>
<option value="#DEB887" style="color:#DEB887">��ľ</option>
<option value="#F4A460" style="color:#F4A460">ɳ��</option>
<option value="#A0522D" style="color:#A0522D">����</option>
<option value="#D2691E" style="color:#D2691E">�ɿ���ɫ</option>
<option value="#008080" style="color:#008080">����</option>
<option value="#C0C0C0" style="color:#C0C0C0">��</option>
<option value="#define#">�Զ���</option>
</select>
<!-- [<a href="javascript: toggle_upload();">�ϴ��ļ�������</a>] -->
<div id="FrameUpload" style="display: none;"></div>
<TABLE>
<TR>
<TD align=center><textarea name='content' id='content'      rows='10' cols='80' class='formtextarea'></textarea>
<input type=hidden id='content_old' value=''><BR>
<INPUT TYPE="hidden" name="uid" value="<?php echo $Recipientx;?>"></TD>
</TR>
<tr><td><!--�ϴ�����-->
<div id="uploadid" style="display: none;">

<TABLE>
<TR>
<a name=maodian></a><TD vAlign=top align=middle width="25%" >ѡ���ļ�</TD>
<TD width="60%"><INPUT type=file name="file" id="file"><BR><INPUT type=file name="file_1" id="file_1"><BR><INPUT type=file name="file_2" id="file_2"><BR><INPUT type=file name="file_3" id="file_3"><BR></TD></TR>
</TABLE>


</div>
</td></tr>

<tr>
<td align=center><INPUT TYPE="submit" value="�ύ" class=mybutton>&nbsp;<INPUT TYPE="reset" value="����" class=mybutton><INPUT TYPE="button" NAME="" value="�ϴ�����" onclick="showupload()"></td>
</tr>
</TABLE>
<br><ul>
<!-- <script type="text/javascript">
if (is_firefox) {	document.write("���Mozilla/Firefox/Flock�û����ر���ʾ��</B><BR>���ִ��һ��������༭���������⣨Gecko���ĵ�һ�����⣬ԭ��������������������ݣ�����<img border=0 title='�������' src='../editor/ubb/images/undo.gif'> ��ť���������һ�α༭ǰ�����ݡ��������������ʹ�á�",
"<B>���ֻ����ҳ��ʾһ�������ݣ�</B><br>Ҫ����ҳֻ��ʾһ�������ݣ����ڵ�����Ķ�ȫ�ġ�����ܿ����������ݣ�������Ҫ�ض���־�ĵط�����<B>[separator]</B>��ǡ����ߣ������Ե���༭���ϵ� <IMG border=0 onclick=\"AddText('[separator]')\" title=\"����ضϷ�\" src=\"../editor/ubb/images/separator.gif\" > ��ť��");
}
</script> -->
</form>




<!--code-->
</DIV>
<!-- SIDEBAR -->
<H3 class=hide>Sidebar</H3>
<DIV class="sidebar sidebar-font">
<DIV class="sidebarbox-border bg-yellow03">
<DIV class="sidebarbox-title-shading bg-yellow07">����</DIV>
<P><INPUT style="WIDTH: 100px"> <IMG height=22 alt="" 
src="../image/search02.jpg" width=80 align=right></P>
<P>������</P></DIV>
<DIV class="sidebarbox-border bg-blue02">
<DIV class="sidebarbox-title-shading bg-blue05 txt-white">���ʹ�������</DIV>
<P>ҵ��������ʵʩϸ�����۸壩</P></DIV>
<DIV class="sidebarbox-border bg-green02">
<DIV class="sidebarbox-title-shading bg-green05 txt-white">��������</DIV>
<P>���ս���ӯ��������1�������ԣ�</P></DIV>
<DIV class="sidebarbox-border bg-red02">
<DIV class="sidebarbox-title-shading bg-red05 txt-white">��Ϣ������</DIV>
<P>������Ϣ����ĿͶ����2��...</P></DIV><A href="admin/admin_login.php" 
target=_blank>�����½</A> </DIV><!-- END WRAP CONTENT AND SIDEBAR --></DIV><!-- FOOTER -->
<H3 class=hide>Footer</H3>
<DIV class="footer footer-font">Copyright &copy; 2006 ������ҵ�ڲ��� | All Rights 
Reserved<BR>Design: Made in Jiading | Author: <A 
href="mailto:gw@actamail.com">evoup</A> | <A 
title="Validate code as W3C XHTML 1.1 Strict Compliant" 
href="http://validator.w3.org/check?uri=referer">W3C XHTML 1.1</A> | <A 
title="Validate Style Sheet as W3C CSS 2.0 Compliant" 
href="http://jigsaw.w3.org/css-validator/">W3C CSS 2.0</A> 
</DIV></DIV></BODY></HTML>
