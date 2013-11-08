<?php

if($_SERVER['REQUEST_METHOD']=='POST') {
  move_uploaded_file($_FILES["test_file"]["tmp_name"], "/var/www/htdoc/progressbar4/" .iconv("utf-8","gb2312",$_FILES["test_file"]["name"]));
  echo "<p>File uploaded.  Thank you!</p>";
echo "<SCRIPT LANGUAGE=\"JavaScript\">
<!--
parent.document.getElementById(\"progressinner\").style.width = \"100%\";
parent.document.getElementById('uploadover').value=1;
//-->
</SCRIPT>";
}

?>