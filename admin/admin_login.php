<?php
include("../include/checkpostandget.php");
include('../include/dbclass.php');
include("../include/common.php");
require "../inc/template.inc";
$tpl = new Template("../template/admin");
//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "admin_login.html");
$tpl->set_var("fromto", "2006-2007");
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>