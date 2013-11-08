<?php
define('IN_EVP', true);
/*# 让它在过去就“失效”
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

# 永远是改动过的
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

# HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

# HTTP/1.0
header("Pragma: no-cache");*/
if (__FILE__ == ''){die('Fatal error code: 0');}
define('ROOT_PATH', str_replace('reg1/reg.php', '', str_replace('\\', '/', __FILE__)));
include(ROOT_PATH.'/include/dbclass.php');
include(ROOT_PATH.'/include/session_mysql.php');
session_start();
//注册开始
include(ROOT_PATH."/include/class_access_user/access_user_class.php"); 
$new_member = new Access_user;
// $new_member->language = "de"; // use this selector to get messages in other languages
if (isset($_POST['Submit'])) { // the confirm variable is new since ver. 1.84
		//add by evoup,先检查验证码
		/* 检查验证码是否正确 */
		include(ROOT_PATH . 'include/cls_captcha.php');
        $validator = new captcha();
        if (!empty($_POST['captcha']) && !$validator->check_word($_POST['captcha']))
        {
		die("验证码错误");
        //    sys_msg($_LANG['captcha_error'], 1);
        }
		else if (!isset($_POST['captcha']) || empty($_POST['captcha'])){//注意在前台写好空验证码的脚本
		die("没有填写验证码!");
		}

	// if you don't like the confirm feature use a copy of the password variable
	$new_member->register_user($_POST['login'], $_POST['password'], $_POST['confirm'], $_POST['name'], $_POST['info'], $_POST['email']); // the register method
} 
$error = $new_member->the_msg; // error message



if (!isset($_POST['Submit'])) { 
	if ($_REQUEST['act'] == 'captcha')
	{
		include(ROOT_PATH . 'include/cls_captcha.php');
		$img = new captcha(ROOT_PATH.'/data/captcha/');
		@ob_end_clean(); //清除之前出现的多余输入
		$img->generate_image();
		exit;
	}
}


ob_start('ob_gzhandler');

//include(ROOT_PATH."/include/cls_captcha.php");
$evp_root_path = (defined('EVP_ROOT_PATH')) ? EVP_ROOT_PATH : './';
include("../include/common.php");
include_once(dirname(__FILE__)."/../header.php");
include_once(dirname(__FILE__)."/../footer.php");
require "../inc/template.inc";
$skinname="skin9";
$tpl = new Template("../template/");
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[[["; //修改左边界符为[##
$tpl->right_delimiter = "]]]"; //修改右边界符##]
$templatedir=ROOT_PATH."/template/$skinname/";
$tpl->set_file("main", "$skinname/reg/_reg.html");
showheader($templatedir,$tpl,1);
showfooter($templatedir,$tpl);
if (isset($_POST['login'])){//用户名
$tpl->set_var("_login",$_POST['login']);
}
else{
$tpl->set_var("_login","");
}
if (isset($_POST['password'])){//密码
$tpl->set_var("_password",$_POST['password']);
}
else{
$tpl->set_var("_password","");
}

if (isset($_POST['confirm'])){//密码确认
$tpl->set_var("_confirm",$_POST['confirm']);
}
else{
$tpl->set_var("_confirm","");
}


if (isset($_POST['email'])){//电子邮件
$tpl->set_var("_email",$_POST['email']);
}
else{
$tpl->set_var("_email","");
}



$tpl->set_var("actionurl",$_SERVER['PHP_SELF']);
$tpl->set_var("_error",$error);
//$tpl->set_var("_session",session_id());
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
flush();
?>