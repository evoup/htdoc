<?php
function showfooter($templatedir,$tpl,$depth=0){
	if(!is_string($templatedir)){
	die;//�����ַ���
	}
	if(!is_object($tpl)){die;}
$file_dir=$templatedir."footer.html";
$fp=fopen($file_dir,"r");
$footcontent=fread($fp,filesize($file_dir));//���ļ�
fclose($fp); 
$tpl->set_var("footer", $footcontent);
	for ($i=0;$i<$depth;$i++){
	$pdir=$pdir+'../';
	}
$pdir='..';
$tpl->set_var("site_dir",$pdir);//��������������Ϊ����ģ�巽��

}
?>