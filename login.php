<?php
define('IN_EVP', true);
include("include/session_mysql.php");
header("Expires: " .gmdate ("D, d M Y H:i:s", time() + 3600 * 24 * 30). " GMT");//一直使用缓存，如果缓存系统有的话
ob_start('ob_gzhandler');
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
	$my_access->login_user($_POST['logname'], $_POST['password']); // call the login method
} 
$error = $my_access->the_msg; 




$postlogname=(isset($_POST['logname'])) ? $_POST['logname'] : $my_access->user;
$postpassword=(isset($_POST['password'])) ? $_POST['password'] : $my_access->user_pw;
$checkit=($my_access->is_cookie == true) ? " checked" : "";
$forgotURL="./forgot_password.php";
$loginerr="<b>".(isset($error)) ? $error : "&nbsp;"."</b>";
$actionURL=$_SERVER['PHP_SELF'];




require_once "inc/template.inc";
$tpl = new Template("template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //�޸���߽��Ϊ[##
$tpl->right_delimiter = "##]"; //�޸��ұ߽��##]
$tpl->set_file("main", "skin9/loginbox_new.html");
$templatedir="template/skin9/";


//$tpl->set_var("nowtime", $nowt);



$tpl->set_var("postlogname",$postlognname);
$tpl->set_var("postpassword",$postpassword);
$tpl->set_var("checkit",$checkit);
$tpl->set_var("forgotURL",$forgotURL);
$tpl->set_var("loginerr",$loginerr);
$tpl->set_var("actionURL",$actionURL);

$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");

ob_end_flush();
?>
