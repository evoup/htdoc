<?php
include("../include/checkpostandget.php");
include('../include/dbclass.php');
include("../include/common.php");
require "../inc/template.inc";
$tpl = new Template("../template/admin");
//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //�޸���߽��Ϊ[##
$tpl->right_delimiter = "##]"; //�޸��ұ߽��##]
$tpl->set_file("main", "admin_login.html");
$tpl->set_var("fromto", "2006-2007");
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>