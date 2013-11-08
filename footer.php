<?php
function showfooter($templatedir,$tpl,$depth=0){
	if(!is_string($templatedir)){
	die;//不是字符串
	}
	if(!is_object($tpl)){die;}
$file_dir=$templatedir."footer.html";
$fp=fopen($file_dir,"r");
$footcontent=fread($fp,filesize($file_dir));//读文件
fclose($fp); 
$tpl->set_var("footer", $footcontent);
	for ($i=0;$i<$depth;$i++){
	$pdir=$pdir+'../';
	}
$pdir='..';
$tpl->set_var("site_dir",$pdir);//解析掉，仅仅是为了做模板方便

}
?>