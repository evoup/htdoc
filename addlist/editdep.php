<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 修改部门信息 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
<META HTTP-EQUIV="expires" CONTENT="0"> 

<META NAME="Description" CONTENT=""><link rel=stylesheet href="../css/css.css" type="text/css">

<style type="text/css">
<!--
#wrapper2{height:100%;width:100%;overflow:hidden;position:relative;background-color: #CCCCCC} 
#wrapper2[id]{display:table;} 
#mid{position: absolute;top:50%;left:50%;} 
#mid[id]{display:table-cell;left:0;vertical-align:middle;position:static;} 
#box{position:relative;top:-50%;left:-50%;z-index:9999;width:400px;font-size:14px;} 
#box[id]{left:0;margin:0 auto;} 
div.boxstyle{/*border:2px solid #000;*/text-align:center;padding:5px;} 


-->
</style>

</HEAD>
<body bgcolor="#CCCCCC"> 

<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");

include("../include/session_mysql.php");
include("../include/common.php");
include("../include/dbclass.php");
$editid=trim(safe_convert($_GET['id']));
//echo $editid;
$sql0="select * from department where id=$editid";
$rs0=$db->query($sql0);
$row0=$db->getarray($rs0);

//echo $row0[1];
//echo $row0[2];
//echo $row0[3];
//echo $row0[4];

echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo "<!--\n";
echo "function ck(){\n";
echo "	if(document.getElementById('depname').value=='')\n";
echo "{alert('请输入要添加的部门名称');return false;\n}";
echo "	return confirm('确实要修改吗?');\n";
echo "}\n";
echo "//-->\n";
echo "</SCRIPT>\n";
//这里注意要加好注册的正则，否则转化不匹配后将导致无法登陆
if ($_POST["actionsflag"]=="1")
{
	$depname=trim(safe_convert($_POST["depname"]));
	$mng=trim(safe_convert($_POST["mng"]));
	$tel=trim(safe_convert($_POST["tel"]));
	$tel1=trim(safe_convert($_POST["tel1"]));
	$tax=trim(safe_convert($_POST["tax"]));

	if (empty($depname))
	{
		echo "<script language='javascript'>alert('部门不能为空!');window.location.href='depman.php';</script>";
		exit;
	}
	elseif (empty($tel))
	{echo "<script language='javascript'>alert('电话1不能为空!');window.location.href='depman.php';</script>";
	exit;}
	elseif (empty($tel1))
	{echo "<script language='javascript'>alert('电话2不能为空!');window.location.href='depman.php';</script>";
	exit;}
	
	else{if (empty($tel1))
	{$type='--';}

		$sql="update department set depname='{$depname}',manager='{$mng}',tel='{$tel}',tel1='{$tel1}',tax='{$tax}' where id='{$editid}';";

		$db->query($sql);
		echo "<script language='javascript'>alert('部门信息修改成功!');</script>";
		if ($_POST['actionsflag2']=='go')
			echo "<script language='javascript'>window.location.href='editdep.php';</script>";
		/*elseif ($_POST['actionsflag2']=='back')
			echo "<script language='javascript'>window.location.href='depman.php';</script>";
	}*/
	elseif ($_POST['actionsflag2']=='close')
			echo "<script language='javascript'>window.close('editdep.php');</script>";
	}
}
?>
<div id="wrapper2"> 
<div id="mid"> 
<div id="box" class="boxstyle"> 
<h2>修改部门信息</h2><FORM METHOD=POST ACTION=""  name=form1 onsubmit="javascript :return ck();"  >
			<TABLE cellpadding=5 cellspacing=0 >
			<TR>
				<TD>部门</TD><TD><INPUT TYPE="text" NAME="depname" id ='depname' value=<?php echo $row0[1];?>></TD><TD>*（修改部门名称）</TD>
			</TR>
			<TR>
				<TD>主管</TD><TD><INPUT TYPE="text" NAME="mng" value=<?php echo $row0[2];?>></TD><TD>（修改主管姓名）</TD>
			</TR>
			<TR>
				<TD>电话1</TD><TD>
				<?php
				echo "<input type=text name=tel size=1 maxlength=12 style=\"width:124px;height=18px;\"onkeyup=\"if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');\"onbeforepaste=\"clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))\"  value=$row0[3]>";
?></TD><TD>*（修改电话号码1）</TD>
			</TR>
						<TR>
							<TD>电话2</TD><TD><INPUT TYPE="text" NAME="tel1"  maxlength=12 value=<?php echo $row0[4];?>></TD><TD>*（修改电话号码2）</TD>
						</TR>
						<TR>
							<TD>传真</TD><TD><INPUT TYPE="text" NAME="tax"  maxlength=12 value=<?php echo $row0[5];?>></TD><TD>*（修改传真号码）</TD>
						</TR>
							</TABLE><BR><BR>

<!-- <INPUT TYPE="reset" value="撤销修改"> --><!-- <INPUT TYPE="submit" value="添加继续" > --><input type="submit" value="保存修改" onClick="document.form1.actionsflag2.value='close'" />&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="button" onclick='javascript:dialogArguments.location="depman.php";window.close()' value='返回'>
<INPUT TYPE="hidden" id="actionsflag" name="actionsflag" value="1">
<INPUT TYPE="hidden" id="actionsflag2" name="actionsflag2" value="go">
</FORM>


</div> 
</div> 
</div> 
</BODY>
</HTML>