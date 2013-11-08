<?PHP
/* -----------------------------------------------------
Bo-Blog 2 : The Blog Reloaded.
<<A Bluview Technology Product>>
PHP+MySQL blog system under GNU Licence.
Code: Bob Shen <bob.shen@gmail.com>
Offical site: http://www.bo-blog.com
Copyright (c) Bob Shen 中国－上海
In memory of my university life
------------------------------------------------------- */

//if (!defined('VALIDREQUEST')) die ('Access Denied.');
//evoupV1.1 请先调用common.js
function convert_ubb ($str, $advanced=0, $inrss=0) {
	global $logstat, $template, $mbcon, $lnc;
	$basicubb_search=array('[hr]', '<br>');
	$basicubb_replace=array('<hr/>', '<br/>');
	$str=str_replace($basicubb_search, $basicubb_replace, $str);
$str=str_replace(array('{','}'), array('&#123;', '&#125;'), $str);
	//[IMG]
	if ($advanced==1) {
		$str=preg_replace("/\[img( align=L| align=M| align=R)?( width=[0-9]+)?( height=[0-9]+)?\]\s*(\S+?)\s*\[\/img\]/ise","makeimg('\\1', '\\2', '\\3', '\\4', {$inrss})",$str);
	} else {
		$str=preg_replace("/\[img( align=L| align=M| align=R)?( width=[0-9]+)?( height=[0-9]+)?\]\s*(\S+?)\s*\[\/img\]/ise","makeimginrss('\\4')",$str);
	}

	if ($inrss==0) {
		if ($logstat==1) $str=preg_replace("/\[sfile\]\s*(\S+?)\s*\[\/sfile\]/is","<div class=\"quote\"><div class=\"quote-title\"><img src=\"{$template['images']}/download.gif\" alt=\"\"/>{$lnc[232]}</div><div class=\"quote-content\"><a href=\"\\1\">{$lnc[233]}</a></div></div>",$str);
		else  $str=preg_replace("/\[sfile\]\s*(\S+?)\s*\[\/sfile\]/is","<div class=\"quote\"><div class=\"quote-title\"><img src=\"{$template['images']}/download.gif\" alt=\"\"/>{$lnc[232]}</div><div class=\"quote-content\">{$lnc[234]} <a href=\"login.php?job=register\">{$lnc[79]}</a> {$lnc[235]} <a href=\"login.php\">{$lnc[89]}</a> </div></div>",$str);
		$str=preg_replace("/\[file\]\s*(\S+?)\s*\[\/file\]/is","<div class=\"quote\"><div class=\"quote-title\"><img src=\"{$template['images']}/download.gif\" alt=\"\"/>{$lnc[232]}</div><div class=\"quote-content\"><a href=\"\\1\">{$lnc[233]}</a></div></div>",$str);
	} else {
		$str=preg_replace("/\[sfile\]\s*(\S+?)\s*\[\/sfile\]/is","{$lnc[234]} <a href=\"login.php?job=register\">{$lnc[79]}</a> {$lnc[235]} <a href=\"login.php\">{$lnc[89]}</a>",$str);
		$str=preg_replace("/\[file\]\s*(\S+?)\s*\[\/file\]/is","<a href=\"\\1\">{$lnc[233]}</a>",$str);
	}

	//Auto add url link
	if ($mbcon['autoaddlink']==1) $str=preg_replace("/(?<=[^\]a-z0-9-=\"'\\/])((https?|ftp|gopher|news|telnet|rtsp|mms|callto|ed2k):\/\/|www\.)([a-z0-9\/\-_+=.~!%@?#%&;:$\\()|]+)/i", "[url]\\1\\3[/url]", $str);

	
	$regubb_search = array(
				"/\s*\[quote\][\n\r]*(.+?)[\n\r]*\[\/quote\]\s*/is",
				"/\s*\[quote=(.+?)\][\n\r]*(.+?)[\n\r]*\[\/quote\]\s*/is",
				"/\s*\[code\][\n\r]*(.+?)[\n\r]*\[\/code\]\s*/ie",
				"/\s*\[ccode\][\n\r]*(.+?)[\n\r]*\[\/ccode\]\s*/ie",
				"/\s*\[jscode\][\n\r]*(.+?)[\n\r]*\[\/jscode\]\s*/ie",
				"/\s*\[javacode\][\n\r]*(.+?)[\n\r]*\[\/javacode\]\s*/ie",
				"/\s*\[perlcode\][\n\r]*(.+?)[\n\r]*\[\/perlcode\]\s*/ie",
				"/\s*\[pycode\][\n\r]*(.+?)[\n\r]*\[\/pycode\]\s*/ie",
				"/\[url\]([^\[]*)\[\/url\]/ie",
				"/\[url=www.([^\[\"']+?)\](.+?)\[\/url\]/is",
				"/\[url=([^\[]*)\](.+?)\[\/url\]/is",
				"/\[acronym=([^\[]*)\](.+?)\[\/acronym\]/is",
				"/\[color=([^\[\<]+?)\](.+?)\[\/color\]/i",
				"/\[size=([^\[\<]+?)\](.+?)\[\/size\]/ie",
				"/\[font=([^\[\<]+?)\](.+?)\[\/font\]/i",
				"/\[p align=([^\[\<]+?)\](.+?)\[\/p\]/i",
				"/\[b\](.+?)\[\/b\]/i",
				"/\[i\](.+?)\[\/i\]/i",
				"/\[u\](.+?)\[\/u\]/i",
				"/\[strike\](.+?)\[\/strike\]/i",
				"/\[sup\](.+?)\[\/sup\]/i",
				"/\[sub\](.+?)\[\/sub\]/i"
	);
	$regubb_replace =  array(
				"<br/><div class=\"quote\"><div class=\"quote-title\">{$lnc[265]}</div><div class=\"quote-content\">\\1</div></div>",
				"<br/><div class=\"quote\"><div class=\"quote-title\">{$lnc[266]} \\1</div><div class=\"quote-content\">\\2</div></div>",
				"makecode('\\1')",
				"makeccode('\\1')",
				"makejscode('\\1')",
				"makejavacode('\\1')",
				"makeperlcode('\\1')",
				"makepycode('\\1')",
				"makeurl('\\1')",
				"<a href=\"http://www.\\1\" target=\"_blank\">\\2</a>",
				"<a href=\"\\1\" target=\"_blank\">\\2</a>",
				"<acronym title=\"\\1\">\\2</acronym>",
				"<span style=\"color: \\1;\">\\2</span>",
				"makefontsize('\\1', '\\2')",
				"<span style=\"font-family: \\1;\">\\2</span>",
				"<p align=\"\\1\">\\2</p>",
				"<strong>\\1</strong>",
				"<em>\\1</em>",
				"<u>\\1</u>",
				"<del>\\1</del>",
				"<sup>\\1</sup>",
				"<sub>\\1</sub>"				
	);
	$str=preg_replace($regubb_search, $regubb_replace, $str);

	//Multimedia Objects, dangerous, so visitors shall never be allowed to post such an object directly
//evoupV1，1下面inrss是控制显示的方法，要么折叠要么新网页
	if ($advanced==1) {
		$str =($inrss==0) ?  preg_replace("/\[(wmp|swf|real)=([^\[\<]+?),([^\[\<]+?)\]\s*([^\[\<\r\n]+?)\s*\[\/(wmp|swf|real)\]/ies", "makemedia('\\1', '\\4', '\\2', '\\3')", $str) : preg_replace("/\[(wmp|swf|real)=([^\[\<]+?),([^\[\<]+?)\]\s*([^\[\<\r\n]+?)\s*\[\/(wmp|swf|real)\]/is", "<br/>此处包含一个多媒体文件，请用网页方式查看。<br/>", $str);
	}

	return $str;
}

function makeurl($url) {
	global $mbcon;
	$urllink="<a href=\"".(substr(strtolower($url), 0, 4) == 'www.' ? "http://$url" : $url).'" target="_blank">';
	if($mbcon['shortenurl']=='1' && strlen($url) > $mbcon['urlmaxlen']) {
		$url = substr($url, 0, $mbcon['urlmaxlen']).'...';
	}
	$urllink .= $url.'</a>';
	return $urllink;
}

function makefontsize ($size, $word) {
	$sizeitem=array (0, 8, 10, 12, 14, 18, 24, 36); 
	$size=$sizeitem[$size];
	return "<span style=\"font-size: {$size}px;\">{$word}</span>";
}

function makemedia ($mediatype, $url, $width, $height) {
	global $template, $lnc;
	//
	$template['images']=$DOCUMENT_ROOT.'/image';
	$mediatype=strtolower($mediatype);
	$id=rand(1000, 99999);
	$typedesc=array('wmp'=>'Windows Media Player', 'swf'=>'Flash Player', 'real'=>'Real Player');
	$str="<div class=\"quote\"><div class=\"quote-title\"><img src=\"{$template['images']}/{$mediatype}.gif\" alt=\"\"/>{$typedesc[$mediatype]}文件</div><div class=\"quote-content\"><a href=\"javascript: playmedia('player{$id}', '{$mediatype}', '{$url}', '{$width}', '{$height}');\">点击打开/折叠播放器</a><div id='player{$id}' style='display:none;'></div></div></div>";
	return $str;
}

function makecode ($str) {
	return "<div style='font-family:Verdana,Courier New,Courier,mono;width:600px;font-weight:bold;font-size:0.88em' align = 'left'>php代码:</div><div class=\"code\">{$str}</div>";
}

function makeccode ($str) {
	return "<div style='font-family:Verdana,Courier New,Courier,mono;width:600px;font-weight:bold;font-size:0.88em' align = 'left'>C/C++代码:</div><div class=\"ccode\">{$str}</div>";
}
function makejscode ($str) {
	return "<div style='font-family:Verdana,Courier New,Courier,mono;width:600px;font-weight:bold;font-size:0.88em' align = 'left'>javascript代码:</div><div class=\"ccode\">{$str}</div>";
}
function makejavacode ($str) {
	return "<div style='font-family:Verdana,Courier New,Courier,mono;width:600px;font-weight:bold;font-size:0.88em' align = 'left'>java代码:</div><div class=\"ccode\">{$str}</div>";
}
function makeperlcode ($str) {
	return "<div style='font-family:Verdana,Courier New,Courier,mono;width:600px;font-weight:bold;font-size:0.88em' align = 'left'>perl代码:</div><div class=\"ccode\">{$str}</div>";
}
function makepycode ($str) {
	return "<div style='font-family:Verdana,Courier New,Courier,mono;width:600px;font-weight:bold;font-size:0.88em' align = 'left'>python代码:</div><div class=\"ccode\">{$str}</div>";
}

function makeimg ($aligncode, $widthcode, $heightcode, $src, $inrss=0) {
	global $lnc, $mbcon, $config;
	$align=str_replace(' align=', '', strtolower($aligncode));
	if ($align=='l') $show=' align="left"';
	elseif ($align=='r') $show=' align="right"';
	else $alignshow='';
	$width=str_replace(' width=', '', strtolower($widthcode));
	if (!empty($width)) $show.=" width=\"{$width}\"";
	$height=str_replace(' height=', '', strtolower($heightcode));
	if (!empty($height)) $show.=" height=\"{$height}\"";
	if ($inrss==1) $src=(substr(strtolower($src), 0, 4) == 'http') ? $src : $config['blogurl'].'/'.$src;
	$onloadact=($inrss==0 && !empty($mbcon['autoresizeimg'])) ? " onload=\"if(this.width>{$mbcon['autoresizeimg']}) {this.resized=true; this.width={$mbcon['autoresizeimg']};}\"" : '';
	$code="<a href=\"{$src}\" target=\"_blank\"><img src=\"{$src}\" alt=\"{$lnc[231]}\" title=\"{$lnc[231]}\" border=\"0\"{$onloadact}{$show}/></a>";
	return $code;
}

function makeimginrss($src) {
	global $config, $lnc, $template;
	$src=(substr(strtolower($src), 0, 4) == 'http') ? $src : $config['blogurl'].'/'.$src;
	$str="<br/><img src=\"{$template['images']}/viewimage.gif\" alt=\"\"/><a href=\"{$src}\" target=\"_blank\">{$lnc[231]}</a><br/>[url]{$src}[/url]<br/>";
	return $str;
}

function xhtmlHighlightString($str) {
	if (PHP_VERSION<'4.2.0') return $str;
	$hlt = highlight_string($str, true);
	if (PHP_VERSION>'5') return $hlt;
	$fon = str_replace(array('<font ', '</font>'), array('<span ', '</span>'), $hlt);
	$ret = preg_replace('#color="(.*?)"#', 'style="color: \\1"', $fon);
	return $ret;
}




/*echo 'dd';

$urlx='12121212[hr]';
echo $urlx=convert_ubb($urlx,'0','0');

$x='<?php echo \'ddd\';?>';
echo $x=xhtmlHighlightString($x);


$i='http://www.baidu.com/img/logo.gif';
echo $i=makeimginrss($i);


$u='www.baidu.com';
echo $u=makeurl($u);*/