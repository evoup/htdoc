<?php /* Smarty version 2.6.19, created on 2008-07-13 05:12:19
         compiled from login.htm */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>网站后台管理系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8"><LINK 
href="images/general.css" type=text/css rel=stylesheet><LINK 
href="images/main.css" type=text/css rel=stylesheet>
<STYLE type=text/css>BODY {
	COLOR: white
}
</STYLE>

<SCRIPT src="images/utils.js" type=text/javascript></SCRIPT>

<SCRIPT src="images/validator.js" type=text/javascript></SCRIPT>

<SCRIPT language=JavaScript>
<!--
// 这里把JS用到的所有语言都赋值到这里
var process_request = "正在处理您的请求...";
var todolist_caption = "记事本";
var todolist_autosave = "自动储存";
var todolist_save = "存档";
var todolist_clear = "清除";
var todolist_confirm_save = "是否将更改储存到记事本？";
var todolist_confirm_clear = "是否移除内容？";
var user_name_empty = "管理者使用者名称不能为空!";
var password_invaild = "密码必须同时包含字母及数字且长度不能小于6!";
var email_empty = "Email地址不能为空!";
var email_error = "Email地址格式不正确!";
var password_error = "两次输入的密码不一致!";
var captcha_empty = "您没有输入验证码!";

if (window.parent != window)
{
  window.top.location.href = location.href;
}

//-->
</SCRIPT>

<META content="MSHTML 6.00.2900.3268" name=GENERATOR></HEAD>
<BODY style="BACKGROUND: #278296">
<FORM name=theForm onSubmit="return validate()" action=privilege.php 
method=post>
<TABLE style="MARGIN-TOP: 100px" cellSpacing=0 cellPadding=0 align=center>
  <TBODY>
  <TR>
    <TD><IMG height=256 alt=EVPCMS src="images/login.png" width=178 
      border=0></TD>
    <TD style="PADDING-LEFT: 50px">
      <TABLE>
        <TBODY>
        <TR>
          <TD>管理者姓名：</TD>
          <TD><INPUT name=username></TD></TR>
        <TR>
          <TD>管理者密码：</TD>
          <TD><INPUT type=password name=password></TD></TR>
        <TR>
          <TD>验证码：</TD>
          <TD><INPUT class=capital name=captcha></TD></TR>
        <TR>
          <TD align=right colSpan=2><img src="admin.php?act=captcha&{$random}" width="145" height="20" alt="CAPTCHA" border="1" onclick= this.src="admin.php?act=captcha&"+Math.random() style="cursor: pointer;border:1px solid #FFFFFF" title="看不清？点击更换另一个验证码。" /> </TD></TR>
        <TR>
          <TD colSpan=2><LABEL><INPUT type=checkbox value=1 
            name=remember>在这台电脑上记住我。</LABEL></TD></TR>
        <TR>
          <TD>&nbsp;</TD>
          <TD><INPUT class=button type=submit value=进入管理中心></TD></TR>
        <TR>
          <TD align=right colSpan=2>» <A style="COLOR: white" 
            href="../">返回首页</A> » <A 
            style="COLOR: white" 
            href="get_password.php?act=forget_pwd">您忘记了密码吗?</A></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><INPUT 
type=hidden value=signin name=act> </FORM>
<SCRIPT language=JavaScript>
<!--
  document.forms['theForm'].elements['username'].focus();
  
  /**
   * 检查表单输入的内容
   */
  function validate()
  {
    var validator = new Validator('theForm');
    validator.required('username', user_name_empty);
    //validator.required('password', password_empty);
    if (document.forms['theForm'].elements['captcha'])
    {
      validator.required('captcha', captcha_empty);
    }
    return validator.passed();
  }
  
//-->
</SCRIPT>
</BODY></HTML>