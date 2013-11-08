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
if (__FILE__ == '')
{
    die('Fatal error code: 0');
}
define('ROOT_PATH', str_replace('member/myindex.php', '', str_replace('\\', '/', __FILE__)));
include (dirname(__FILE__).'/../include/define.php');
include(ROOT_PATH.'/include/dbclass.php');
include(ROOT_PATH.'/include/session_mysql.php');
//require_once('.././include/ext_page.class.php');
//session_start();





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
$tpl->set_file("main", "$skinname/member/_myindex.html");
showheader($templatedir,$tpl,1);
showfooter($templatedir,$tpl);








$tpl->set_var("SITENAME",SITENAME);
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
flush();
?>