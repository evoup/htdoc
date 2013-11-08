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

//PHP后退页面过期或不存在问题的解决：
//post后或使用了使用了session都有可能引起这种情况
//解决办法，在开头加入如下代码即可：
//header("Cache-control: private");

//避免‘不会自动再次提交您的信息，要放在session_start前面’
session_cache_limiter('private,must-revalidate');   

if (__FILE__ == '')
{
    die('Fatal error code: 0');
}
define('ROOT_PATH', str_replace('reg1/login.php', '', str_replace('\\', '/', __FILE__)));
include (dirname(__FILE__).'/../include/define.php');
include(ROOT_PATH.'/include/dbclass.php');
include(ROOT_PATH.'/include/session_mysql.php');
//require_once('.././include/ext_page.class.php');
//session_start();





$evp_root_path = (defined('EVP_ROOT_PATH')) ? EVP_ROOT_PATH : './';
include("../include/common.php");

if (isset($_GET['password']))
checktoken();//判断是否伪造FORM外部提交

include_once(dirname(__FILE__)."/../header.php");
include_once(dirname(__FILE__)."/../footer.php");
require "../inc/template.inc";
$skinname="skin9";
$tpl = new Template("../template/");
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[[["; //修改左边界符为[##
$tpl->right_delimiter = "]]]"; //修改右边界符##]
$templatedir=ROOT_PATH."/template/$skinname/";
$tpl->set_file("main", "$skinname/reg/_login.html");
showheader($templatedir,$tpl,1);
showfooter($templatedir,$tpl);














include($_SERVER['DOCUMENT_ROOT']."/include/class_access_user/access_user_class.php"); 

$my_access = new Access_user;
$my_access->login_reader();
// $my_access->language = "de"; // use this selector to get messages in other languages
if (isset($_GET['activate']) && isset($_GET['ident'])) { // this two variables are required for activating/updating the account/password
	//$my_access->auto_activation = false; // use this (true/false) to stop the automatic activation
	$my_access->activate_account($_GET['activate'], $_GET['ident']); // the activation method 
}
if (isset($_GET['validate']) && isset($_GET['id'])) { // this two variables are required for activating/updating the new e-mail address
	$my_access->validate_email($_GET['validate'], $_GET['id']); // the validation method 
}
if (isset($_POST['Submit'])) {
	$my_access->save_login = (isset($_POST['remember'])) ? $_POST['remember'] : "no"; // use a cookie to remember the login
	$my_access->count_visit = true; // if this is true then the last visitdate is saved in the database
	$my_access->login_user($_POST['login'], $_POST['password']); // call the login method
} 
$error = $my_access->the_msg; 
(isset($_POST['login'])) ? $tpl->set_var("out_login",$_POST['login']) : $tpl->set_var("out_login",$my_access->user);
(isset($_POST['password'])) ? $tpl->set_var("out_password",$_POST['password']) : $tpl->set_var("out_password",$my_access->user_pw);
($my_access->is_cookie == true) ? $tpl->set_var("out_checked","checked") : $tpl->set_var("out_checked","");
$tpl->set_var("out_action",$_SERVER['PHP_SELF']);

(isset($error)) ? $tpl->set_var("out_error",$error) : $tpl->set_var("out_error","&nbsp;");
$tpl->set_var("SITENAME",SITENAME);


$tpl->set_var("gen_input",gen_input());//生成htmltoken
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
flush();
?>