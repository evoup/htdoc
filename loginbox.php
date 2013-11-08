<?php 

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



////////////////////////////////////////////////////////////

$tpl->set_file("loginex", "skin9/loginbox_new.html");


$postlogname=(isset($_POST['login'])) ? $_POST['login'] : $my_access->user;
$postpassword=(isset($_POST['password'])) ? $_POST['password'] : $my_access->user_pw;
$checkit=($my_access->is_cookie == true) ? " checked" : "";
$forgotURL="./forgot_password.php";
$loginerr="<b>".(isset($error)) ? $error : "&nbsp;"."</b>";
$actionURL=$_SERVER['PHP_SELF'];

$tpl->set_var("postlogname",$postlognname);
$tpl->set_var("postpassword",$postpassword);
$tpl->set_var("checkit",$checkit);
$tpl->set_var("forgotURL",$forgotURL);
$tpl->set_var("loginerr",$loginerr);
$tpl->set_var("actionURL",$actionURL);

$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
//注意还要防止表单外部提交
?>