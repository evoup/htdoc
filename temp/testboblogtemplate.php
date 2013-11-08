<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?php
class template {
	function template() {
		global $elementfile, $elements;
		if (empty($elements)) {
			global $lnc;
			if (empty($elementfile) || !file_exists($elementfile)) $elementfile='template/default/elements.php';
			if (!file_exists($elementfile)) die ("Cannot find template. You may need to reinstall the program.");
			global $template;
			include_once($elementfile);
		}
	}

	function set($elementname, $array, $inherit=0) {
		global $elements;
		if ($inherit==1) global $content;
		$content[$elementname]=$elements[$elementname];
		while (@list($parser, $value) = @each ($array)) {
			$content[$elementname]=str_replace("{".$parser."}", $value, $content[$elementname]);
		}
		if ($inherit==0) return (@implode('', $content));
	}
}

echo "bk";
$footmenu=$t->set('displayfooter', array('section_foot_components'=>$section_foot_components));
echo $footmenu;
?>










</BODY>
</HTML>
