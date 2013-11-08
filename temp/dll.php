<?php
//dl("phpcallATL.dll");
//$obj=new phpcallATL();

$com = new COM("phpcallATL.CFun") or die("无法建立COM组件");

echo $com->Show(1);
//echo show(1);

?>