<?php
function showheader($templatedir,$tpl,$depth=0){
if(!is_string($templatedir)){
die;//不是字符串
}
if(!is_object($tpl)){die;}
$file_dir=$templatedir."header.html";
$fp=fopen($file_dir,"r");
$headercontent=fread($fp,filesize($file_dir));//读文件
fclose($fp);  
$tpl->set_var("header", $headercontent);
//$tpl->set_var("site_dir",$_SERVER['DOCUMENT_ROOT']);//当心这句容易暴库

/*for ($i=0;$i<$depth;$i++){//这部分算法移到footer.php了
$pdir=$pdir+'../';
}
$pdir='..';
$tpl->set_var("site_dir",$pdir);//解析掉，仅仅是为了做模板方便*/
}
?>