<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>
<TITLE> 添加物品 </TITLE>

<META NAME="Generator" CONTENT="EditPlus">
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT=""><link rel=stylesheet href="../css/css.css" type="text/css">
</HEAD>
<BODY>
<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");

include("../include/session_mysql.php");
include("../include/common.php");
echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo "<!--\n";
echo "function ck(){\n";
echo "	if(document.getElementById('itname').value=='')\n";
echo "{alert('请输入要添加的办公用品名称');return false;\n}";
echo "	return confirm('确实要修改吗?');\n";
echo "}\n";
echo "//-->\n";
echo "</SCRIPT>\n";
//这里注意要加好注册的正则，否则转化不匹配后将导致无法登陆
if ($_POST["actionsflag"]=="1")
{
	$itname=trim(safe_convert($_POST["itname"]));
	$type=trim(safe_convert($_POST["type"]));
	$jihuanum=trim(safe_convert($_POST["jihuanum"]));
	$unit=trim(safe_convert($_POST["unit"]));
	if (empty($itname))
	{
		echo "<script language='javascript'>alert('物品名称不能为空!');window.location.href='additem.php';</script>";
		exit;
	}
	elseif (empty($jihuanum))
	{echo "<script language='javascript'>alert('计划数量不能为空!');window.location.href='additem.php';</script>";
	exit;}
	elseif (empty($unit))
	{echo "<script language='javascript'>alert('单位不能为空!');window.location.href='additem.php';</script>";
	exit;}
	
	else{if (empty($type))
	{$type='--';}
include("../include/dbclass.php");
		$sql="insert into store(item,standards,plannum,unit) values('{$itname}','{$type}','{$jihuanum}','{$unit}') ";

		$db->query($sql);
		echo "<script language='javascript'>alert('新办公用品添加成功!');</script>";
		if ($_POST['actionsflag2']=='go')
			echo "<script language='javascript'>window.location.href='additem.php';</script>";
		elseif ($_POST['actionsflag2']=='back')
			echo "<script language='javascript'>window.location.href='store.php';</script>";
	}
}
?>
<div style='margin-top:10px;'><b>添加新办公物品</b></div><FORM METHOD=POST ACTION=""  name=form1 onsubmit="javascript :return ck();"  >
			<TABLE cellpadding=5 cellspacing=0>
			<TR>
				<TD>品名</TD><TD><INPUT TYPE="text" NAME="itname" id ='itname'></TD><TD>*（输入用品名称,如文件夹）</TD>
			</TR>
			<TR>
				<TD>规格</TD><TD><INPUT TYPE="text" NAME="type" ></TD><TD>（输入产品规格，可不填）</TD>
			</TR>
			<TR>
				<TD>计划数量</TD><TD>
				<?php
				echo "<input type=text name=jihuanum size=1 maxlength=3 style=\"width:124px;height=18px;\"onkeyup=\"if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');\"onbeforepaste=\"clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))\"  >";
?></TD><TD>*(请输入计划数量，最多999)</TD>
			</TR>
						<TR>
							<TD>单位</TD><TD><INPUT TYPE="text" NAME="unit"  maxlength=8></TD><TD>*（请输入数量单位：如：本、只、支等）</TD>
						</TR>
							</TABLE>


<div align=center><div id =buttonset><INPUT TYPE="reset" value=" 清 除 " class=inp2></div><div id =buttonset><INPUT TYPE="submit" value="添加继续" class=inp2></div><div id =buttonset><input type="submit" value="添加返回" onClick="document.form1.actionsflag2.value='back'" class=inp2 />
</div><div id = buttonset><INPUT TYPE="button" value=' 返 回 ' onclick='history.go(-1)' class=inp2></div></div><INPUT TYPE="hidden" id="actionsflag" name="actionsflag" value="1">
<INPUT TYPE="hidden" id="actionsflag2" name="actionsflag2" value="go">
</FORM>
</BODY>
</HTML>