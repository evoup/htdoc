<?php
//dl("phpcallATL.dll");
//$obj=new phpcallATL();

$com = new COM("phpcallATL.CFun") or die("�޷�����COM���");

echo $com->Show(1);
//echo show(1);

?>