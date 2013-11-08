<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>查看/编辑信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="local/webfxlayout.js"></script>

<SCRIPT LANGUAGE="JavaScript">
<!--

function isemail(s)//验证E-MAIL格式函数
{

	if (s.length > 100)
	{
		window.alert("email地址长度不能超过100位!");
		return false;
	}

	var regu = "^(([0-9a-zA-Z]+)|([0-9a-zA-Z]+[_.0-9a-zA-Z-]*[0-9a-zA-Z]+))@([a-zA-Z0-9-]+[.])+([a-zA-Z]{2}|net|NET|com|COM|gov|GOV|mil|MIL|org|ORG|edu|EDU|int|INT)$"
	var re = new RegExp(regu);
	if (s.search(re) != -1) {
		return true;
	} else {
		window.alert ("请输入有效合法的E-mail地址 ！")
		return false;
	}
}



function ck(){
	if(!isemail(document.getElementById('email').value))
	{
		return false;
	}
	else
	{return confirm('确实要修改吗?');}


}




//-->
</SCRIPT>
<link id="webfx-tab-style-sheet" type="text/css" rel="stylesheet" href="css/tab.webfx.css" disabled="disabled" />

<style type="text/css">
.pic {
 position:relative;
 background:#CCC;
 margin:10px;
 }
.pic span {
display:block;
border:1px solid #CCCCCC;
background:#FFF;
position:relative;
padding: 3px;
}
.dynamic-tab-pane-control .tab-page {
	height:		400px;
}
.dynamic-tab-pane-control .tab-page .dynamic-tab-pane-control .tab-page {
	height:		100px;
}
html, body {
	background:	ThreeDFace;
}
form {
	margin:		0;
	padding:	0;
}
/* over ride styles from webfxlayout */
body {
	margin-left:		10px;
	width:		auto;
	height:		auto;
}
.dynamic-tab-pane-control h2 {
	text-align:	center;
	width:		auto;
}
.dynamic-tab-pane-control h2 a {
	display:	inline;
	width:		auto;
}
.dynamic-tab-pane-control a:hover {
	background: transparent;
}
</style>
<script type="text/javascript" src="js/tabpane.js"></script>
</head>
<body topmargin = 0 leftmargin = 0>
<script type="text/javascript">
//<![CDATA[
function setLinkSrc( sStyle ) {
	document.getElementById( "webfx-tab-style-sheet" ).disabled = sStyle != "webfx"
	document.documentElement.style.background =
	document.body.style.background = sStyle == "webfx" ? "white" : "ThreeDFace";
}
setLinkSrc( "webfx" );
//]]>
</script>

<div class="tab-pane" id="tabPane1">
<script type="text/javascript">
tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
//tp1.setClassNameTag( "dynamic-tab-pane-control-luna" );
//alert( 0 )
</script>
<?php
define('IN_EVP', true);
include("../include/dbclass.php");
include("../include/ck_email.php");//这个可以检测实际地址是否存在，等等再说
include("../include/common.php");
//假如未提交表单
if (!isset($action))
{
	$id=$_GET['id'];
	//echo "id是".$id;
	//	session_start();
	//if (isset($_SESSION['id']) )
	//    {unset($_SESSION['id']);}
	//$_SESSION['id']=$id;
	$sql="select t1.logname,t2.nickname,t2.email,t2.telm,t2.code,t2.sex,t3.depname,t3.tel,t3.tel1 from login AS t1 ,usr AS t2,department AS t3 where t1.id='{$id}' AND t2.id='{$id}' AND t2.department=t3.id";
	$result=$db->query($sql);
	while($row=$db->getarray($result))
	{
		$logname=$row[logname];
		$nickname=$row[nickname];
		$email=$row[email];
		//echo $row[depname];
		$depname=$row[depname];
		$mob=$row[telm];
		$code=$row[code];
		$sex=$row[sex];
		$tel=$row[tel];
		$tel1=$row[tel1];
		//echo $tel;
		//echo $sex;
	}
}
?>
	<div class="tab-page" id="tabPage1">
		<h2 class="tab">基本信息</h2>		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>	
		<!-- form -->
		<FORM METHOD=POST ACTION="<?php echo $PHP_SELF."?action=edit&id=".$id;?>" onsubmit="javascript :return ck();">
<?php 
$action=$_GET['action'];
//echo "action的值为".$action;
//echo $_POST['dep'];
if (isset($action)&&$action=="edit"){

	//下面这个配置好SMTP后查看下include里的ck_email.php再验证是否有这个EMAIL地址
	//if(!SnowCheckMail($_POST['email']))
	//{die('地址有误');}

	//暂时先用本文件中的js验证EMAIL好了，等等再加上PHP的

	//echo "修改成功!";
	echo "<script language='javascript'>alert('修改成功！');window.close();</script>";
	$_POST['dep']=safe_convert($_POST['dep']);
	$_POST['xb']=safe_convert($_POST['xb']);
	$_POST['email']=safe_convert($_POST['email']);
	$_POST['tel']=safe_convert($_POST['tel']);
	$_POST['tel1']=safe_convert($_POST['tel1']);
	$_POST['mob']=safe_convert($_POST['mob']);
	$_POST['nickname']=safe_convert($_POST['nickname']);
	$_POST['code']=safe_convert($_POST['code']);
	$_POST['logname']=safe_convert($_POST['logname']);
	
	
	
	$sql1="UPDATE department AS t1,usr AS t2,login AS t3 SET t2.department='{$_POST['dep']}',  t2.sex='{$_POST['xb']}',t2.email='{$_POST['email']}', t1.tel='{$_POST['tel']}',t1.tel1='{$_POST['tel1']}',t2.telm='{$_POST['mob']}',t2.nickname='{$_POST['nickname']}',t2.code='{$_POST['code']}',t3.logname='{$_POST['logname']}' where t1.id=t2.department and t2.id='{$id}' and t3.id=t2.id and t3.id='{$id}';";
	//$sql2="UPDATE usr SET nickname='{$_POST['nickname']}' where id='{$_POST['id']}'";
	$result=$db->query($sql1);
	//$result=$db->query($sql2);
	//假如提交表单后的显示数据
	$id=$_GET['id'];
	$sql="select t1.logname,t2.nickname,t2.email,t2.telm,t2.code,t2.sex,t3.depname,t3.tel,t3.tel1 from login AS t1 ,usr AS t2,department AS t3 where t1.id='{$id}' AND t2.id='{$id}' AND t2.department=t3.id";
	$result1=$db->query($sql);
	while($row=$db->getarray($result1)){
		$logname=$row[logname];
		$nickname=$row[nickname];
		$email=$row[email];
		//echo $row[depname];
		$depname=$row[depname];
		$mob=$row[telm];
		$code=$row[code];
		$sex=$row[sex];
		$tel=$row[tel];
		$tel1=$row[tel1];
	}
}
?>



<?php
//输出照片文件名
$sql4="select t2.src from usr AS t1, usrimg AS t2 where t1.usrimg = t2.id and t1.id='{$id}'";
$result4=$db->query($sql4);

while($row4=$db->getarray($result4)){
	//echo $row4[src];
	$imgsrc= $row4[src];
}
?>
		<TABLE cellpadding=0 cellspacing=0 border=0>
		<TR>
			<TD>
			<TABLE cellpadding=5 cellspacing=0>
			<TR>
				<TD>登陆帐号</TD><TD><INPUT TYPE="text" NAME="logname" value=<?php echo $logname;?>></TD>
			</TR>
			<TR>
				<TD>人员姓名</TD><TD><INPUT TYPE="text" NAME="nickname" value=<?php echo $nickname;?>></TD>
			</TR>
			<TR>
				<TD>电子邮件</TD><TD><INPUT TYPE="text" NAME="email" id=email value=<?php echo $email;?>></TD>
			</TR>
			<TR>
				<TD>厂电</TD><TD><INPUT TYPE="text" NAME="tel" value=<?php echo $tel;?>            maxlength=12></TD>
			</TR>
			<TR>
							<TD>宅电</TD><TD><INPUT TYPE="text" NAME="tel1" value=<?php echo $tel1;?> maxlength=12></TD>
						</TR>
						<TR>
							<TD>移动电话</TD><TD><INPUT TYPE="text" NAME="mob" value=<?php echo $mob;?>></TD>
						</TR>
						<TR>
							<TD>部&nbsp;&nbsp;门</TD><TD><!-- <INPUT TYPE="text" NAME="" value=<?php echo $depname;?>> -->
<?php
//上面匹配的depname
//echo "depname是".$depname;
$result3=$db->query("select id,depname from department");
echo "<select name=dep>";
while($row=$db->getarray($result3)){
	if ($row[depname]==$depname)
	{
		//echo "break ok";
		echo "<option  value=\"$row[id]\" selected>$row[depname]</option>";
	}
	else
	{echo "<option  value=".$row[id].">".$row[depname]."</option>";}
}
echo "</select>";
?>
							</TD>
						</TR>
			</TABLE>
			</TD>
			<TD ><TABLE cellpadding=5>
			<TR>
				<TD colspan=2 align=center><TABLE border=0>
				<TR>
					<TD><?php //echo $imgsrc;?>
					<div class="pic"><span><?php echo"<img src=../upload_dir/".$imgsrc." width=110 height=136>";?></span></div>
					<!-- <div class="pic"><span><IMG SRC="../addlist/image/admin.gif" WIDTH="62" HEIGHT="62" BORDER="0" ALT="照片" title="照片"></span></div> --></TD>
				</TR>
				</TABLE></TD>
			</TR><TR>
				<TD colspan=2 align=center><A HREF="upload_photo.php?id=<?php echo $id;?>">上传人员照片</A></TD>
			</TR>
			<TR>
				<TD>人员编码</TD><TD><INPUT TYPE="text" NAME="code" value=<?php echo $code;?>></TD>
			</TR>
			<TR>
				<TD>性别</TD><TD><INPUT TYPE="radio" NAME="xb" value=0 <?php if ($sex=="0") {echo "checked";}?>>男<INPUT TYPE="radio" NAME="xb" value=1 <?php if ($sex=="1") {echo "checked";}?>>女</TD>
			</TR>
			<!-- <TR>
				<TD>职务</TD><TD><SELECT NAME=""></SELECT></TD>
			</TR> -->
			</TABLE></TD>
		</TR>
		</TABLE><TABLE>
		<TR>
			<TD><INPUT TYPE="submit" value="保存继续" class=inp2></TD>
			<TD><INPUT TYPE="submit" value="保存退出" class=inp2></TD>
			<TD><INPUT TYPE="button" value="退出" class=inp2 onclick='location.href="../addlist/admin.php"'></TD>
		</TR>
		</TABLE>
		<!--注意form一定要放到submit的里面-->
		</FORM>
	</div>
	<div class="tab-page" id="tabPage2">
		<h2 class="tab">个人信息</h2>	
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>
		<TABLE >
		<TR>
			<TD><TABLE cellpadding=5><TR><TD align=right>住址-省</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>-市</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>-区县</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>-街道</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>-邮编</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>出生日期</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			</TABLE></TD><TD><TABLE cellpadding=5><TR><TD align=right>身份证号码</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>民族</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>籍贯</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>家庭电话1</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>家庭电话2</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			<TR><TD align=right>政治面貌</TD><TD><INPUT TYPE="text" NAME=""></TD></TR>
			</TABLE></TD>
					</TR>
		</TABLE>
		<TABLE cellpadding=2>
		<TR><TD align=right>备注</TD><TD><TEXTAREA NAME="" ROWS="4" COLS="70%"></TEXTAREA></TD></TR>
		</TABLE>
		<TABLE>
		<TR>
			<TD><INPUT TYPE="submit" value="保存继续"></TD>
			<TD><INPUT TYPE="submit" value="保存退出"></TD>
			<TD><INPUT TYPE="submit" value="退出"></TD>
		</TR>
		</TABLE>
	</div>
	<div class="tab-page" id="tabPage3">
		<h2 class="tab">福利待遇</h2>		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage3" ) );</script>
		建设中
	</div>
	<div class="tab-page" id="tabPage4">
		<h2 class="tab">学历信息</h2>		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage4" ) );</script>		
		<fieldset>
			<legend>Content</legend>
建设中
		</fieldset>
	</div>
	<div class="tab-page" id="tabPage5">
			<h2 class="tab">履历信息</h2>			
			<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage5" ) );</script>
			建设中
		</div>
		<div class="tab-page" id="tabPage6">
			<h2 class="tab">档案信息</h2>
			<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage6" ) );</script>
			建设中
		</div>
		<div class="tab-page" id="tabPage7">
			<h2 class="tab">合同信息</h2>
			<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage7" ) );</script>
			建设中
		</div>
</div>
<script type="text/javascript">
//<![CDATA[
setupAllTabs();
//]]>
</script>
</body>
</html>
