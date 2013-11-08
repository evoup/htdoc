<?php

function safe_convert_old($string, $html = 0)//如果发生不兼容使用这个版本的
{
  //Words Filter
  if ($html == 0)
  {
    $string = htmlspecialchars($string, ENT_QUOTES);
    $string = str_replace("<", "&lt;", $string);
    $string = str_replace(">", "&gt;", $string);
    $string = str_replace("\\", '&#92;', $string);
  }
  else
  {
    $string = addslashes($string);
    $string = str_replace("\\\\", '&#92;', $string);
  }
  //CAUTION!!这里我做了很大改动以适合自己的系统
  //$string=str_replace("\r","<br/>",$string);
  //$string=str_replace("\n","",$string);
  //$string=str_replace("\t","&nbsp;&nbsp;",$string);
  //$string=str_replace("  "," &nbsp;",$string);
  //$string=str_replace('|', '&#124;', $string);
  //$string=str_replace("&amp;#96;","&#96;",$string);
  //$string=str_replace("&amp;#92;","&#92;",$string);
  return $string;
}


function safe_convert($string, $html=0, $filterslash=0) { //Words Filter//来自boblog2.X版本的
	if ($html==0) {
		$string=htmlspecialchars($string, ENT_QUOTES);
		$string=str_replace("<","&lt;",$string);
		$string=str_replace(">","&gt;",$string);
		if ($filterslash==1) $string=str_replace("\\", '&#92;', $string);
	} else {
		$string=addslashes($string);
		if ($filterslash==1) $string=str_replace("\\\\", '&#92;', $string);
	}
	//$string=str_replace("\r","<br/>",$string);
	$string=str_replace("\n","",$string);
	$string=str_replace("\t","&nbsp;&nbsp;",$string);
	$string=str_replace("  ","&nbsp;&nbsp;",$string);
	$string=str_replace('|', '&#124;', $string);
	$string=str_replace("&amp;#96;","&#96;",$string);
	$string=str_replace("&amp;#92;","&#92;",$string);
	$string=str_replace("&amp;#91;","&#91;",$string);
	$string=str_replace("&amp;#93;","&#93;",$string);
	return $string;
}

function safe_invert($string, $html=0) { //Transfer the converted words into editable characters
	if ($html==0) {
	$string = str_replace("<br/>","\r",$string);
	} else {
	$string = str_replace("<br/>","\r",$string);
	$string = str_replace("&nbsp;"," ",$string);
	$string = str_replace("&","&amp;",$string);
	$string=preg_replace("/\[code\](.+?)\[\/code\]/ise", "'[code]'.str_replace('&amp;', '&', '\\1').'[/code]'", $string);
	$string=preg_replace("/\[ccode\](.+?)\[\/ccode\]/ise", "'[ccode]'.str_replace('&amp;', '&', '\\1').'[/ccode]'", $string);
	$string=preg_replace("/\[perlcode\](.+?)\[\/perlcode\]/ise", "'[perlcode]'.str_replace('&amp;', '&', '\\1').'[/perlcode]'", $string);
	$string=preg_replace("/\[javacode\](.+?)\[\/javacode\]/ise", "'[javacode]'.str_replace('&amp;', '&', '\\1').'[/javacode]'", $string);
	$string = str_replace("&amp;rsquo;","’",$string);//add 2008-08-02
	$string = str_replace("&rsquo;","’",$string);//add 2008-08-02
		
	}
$string = str_replace("&nbsp;"," ",$string);
return $string;
}


function rexp($filename)
{
  while (1)
  {
    $flag = preg_match("/\.(.*)/i", $filename, $matches);
    if ($flag == "")
    {
      return $filename;
    }
    else
    {
      $filename = $matches[1];
    }
  }
}



function extdiff($flag)
{
  $flag = strtolower(strval($flag));
  switch ($flag)
  {
    case "xls":
      return '微软电子表格文件';
      break;
    case "doc":
      return '微软文档处理文件';
      break;
    case "jpg":
      return '联合图像专家组';
    case "jpeg":
      return '联合图像专家组';
      break;
    case "gif":
      return '图像互换格式';
      break;
    case "zip":
      return 'Zip文件';
      break;
    case "rar":
      return 'RAR压缩档案';
      break;
    case "mht":
      return '单个网页文件';
      break;
    case "htm":
      return 'HTML 超文本文档';
      break;
    case "html":
      return 'HTML 超文本文档';
      break;
    case "html":
      return '网页文件';
      break;
    case "cad":
      return 'Softdek的Drafix CAD文件';
      break;
    case "chm":
      return '编译过的HTML文件';
      break;
    case "dwg":
      return 'AutoCAD工程图文件';
      break;
    case "dxf":
      return '可进行互交换的绘图文件格式';
      break;
    case "exe":
      return '可执行文件';
      break;
    case "fla":
      return 'Macromedia Flash电影';
      break;
    case "gz":
      return 'UNIX gzip压缩文件';
      break;
    case "mdb":
      return '微软Access数据库';
      break;
    case "mde":
      return '微软Access MDE文件';
      break;
    case "mid":
      return 'MIDI音乐';
      break;
    case "eml":
      return '电子邮件文件';
      break;
    case "mms":
      return '微软流式媒体';
      break;

  }
}








//字符串截取
//参数含义及用法同substr()完全相同。中文长度为2

function csubstr($str, $start, $len = 0xFFFFFFFF)
{
  if ($start < 0)
  {
    $start = strlen($str) + $start;
  }
  if ($len < 0)
  {
    $len = strlen($str) - $start + $len;
  }
  $tmp = "";

  $strlen = strlen($str);
  $begin = 0;
  $subLen = 0;
  for ($i = 0; $i < $start + $len && $i < $strlen; $i++)
  {
    if ($i < $start)
    {
      if (ord($str[$i]) >= 161 && ord($str[$i]) <= 247 && ord($str[$i + 1]) >=
        161 && ord($str[$i + 1]) <= 254)
        $i++;
    }
    else
    {
      $begin = $i;
      for (; $i < $start + $len && $i < $strlen; $i++)
      {
        if (ord($str[$i]) >= 161 && ord($str[$i]) <= 247 && ord($str[$i + 1])
          >= 161 && ord($str[$i + 1]) <= 254)
          $i++;
      }
      return substr($str, $begin, $i - $begin);
    }
  }
} //end

function cutchs($str)
{
  //用来返回包括中文在内的字数统计数值
  $result = "";
  $result = strlen(preg_replace("/[\x80-\xff]./", "*", strval($str)));
  return $result;
}


//来自global.php from bbg,还要把放到通用层用来经常引用
function getemot($matches)
{
  //Emot
  global $myemots;
  $currentemot = $matches[1];
  $emotimage = $myemots[$currentemot]['image'];
  return
    "<img src=\"../image/emot/{$currentemot}.gif\" border=\"0\" alt=\"$currentemot\" />";
}


function getcontent($content, $html = 1, $ubb = 1, $emot = 1, $advanced = 1)
{
  $content = str_replace('[separator]', '', $content);
  $content = str_replace('[newpage]', '', $content);
  if ($emot == 1)
  {
    $content = preg_replace_callback("/\[emot\]([^ ]+?)\[\/emot\]/is",'getemot', $content);
  }
  if ($ubb == 1)
  {
    include_once("../include/ubb.php");
    $content = convert_ubb($content, $advanced);
  }
  return $content;
}



function output_utf8htmltop()
{
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head><body>";
}
function output_utf8htmlbottom()
{echo "</body></html>";
}

function killsession_go_index($flag)//flag为0不跳转了，为1跳转到首页
{
  output_utf8htmltop();
  echo"<br><h2>登陆超时,请重新登陆...</h2>";//这个h2有样式的
  // 这种方法是将原来注册的某个变量销毁
  unset($_SESSION['name']);
  unset($_SESSION['staff']);
  // 这种方法是销毁整个 Session 文件
  session_destroy();
  if ($flag==0){}

  else if ($flag==1){
  //停留几秒
      echo
      //"<br>将于3秒跳返回<br><A HREF=../index.html>如果要重新登陆，请单击这里</A>\n";

    header("refresh:3;url=../index.html");

  //跳出frame
  echo"<SCRIPT LANGUAGE=JAVASCRIPT>\n";
  echo"<!-- \n";
  echo"if (top.location !== self.location) {\n";
  echo"top.location=self.location;\n";
  echo"}\n";
  echo"</SCRIPT>\n";}
  output_utf8htmlbottom();
}

function Decode($str){
$str = str_replace("<br>","\r\n",$str);
$str = str_replace("<br>","\r",$str);
$str = str_replace("<br>","\n",$str);
$str = str_replace("<","&lt;",$str);
$str = str_replace(">","&gt;",$str);
$str = str_replace("’","'",$str);
return $str;
}

#############I needed a function to interlace two arrays ([a,b,c] + [d,e,f] = [a,d,b,e,c,f]) and came up with the following. This function works for arrays of varying lengths and keeps the keys sequenced properly.#################
######it will work like this##########
#a = array ('a', 'b', 'c');
#$b = array ('d', 'e', 'f', 'g', 'h', 'i');
#$c = array_interlace ($a, $b);
/*
Array
(
    [0] => a
    [1] => d
    [2] => b
    [3] => e
    [4] => c
    [5] => f
    [6] => g
    [7] => h
    [8] => i
)*/
function array_interlace ($a, $b)
{
    $c = array();
    $shorty = (count($a) > count($b)) ? $b : $a;
    $biggy = (count($a) > count($b)) ? $a : $b;   
    $slen = count($shorty);
    $blen = count($biggy);

    for ($i = 0; $i < $slen; ++$i){
        $c[$i * 2] = $a[$i];
        $c[$i * 2 + 1] = $b[$i];
    }
    
    for ($i = $slen; $i < $blen; ++$i)
    {
        $c[] = $biggy[$i];
    }    
    return $c;
}

///////////anti CSRF函数开始/////////
//生成防止CSRF攻击的一次性的令牌的方法
	function gen_token() {
	// Generate the md5 hash of a randomized uniq id
	$hash = md5(uniqid(rand(), true));
	// Select a random number between 1 and 24 (32-8)
	$n = rand(1, 24);
	// Generate the token retrieving a part of the hash starting from
	// the random N number with 8 of lenght
	$token = substr($hash, $n, 8);
	return $token;
	}
	
	//生成SESSION令牌方法
	function gen_stoken() {
	// Call the function to generate the token
	$token = gen_token();
	// Destroy any eventually Session Token variable
	destroy_stoken();
	// Create the Session Token variable
	//session_register(STOKEN_NAME);
	$_SESSION['STOKEN_NAME'] = $token;
	}
	
	//生成前台HTML令牌隐藏域的方法
	function gen_input() {
	// Call the function to generate the Session Token variable
	gen_stoken();
	// Generate the form input code
	/*echo "<input type=\"hidden\" name=\"".FTOKEN_NAME."\"
	 value=\"".$_SESSION[STOKEN_NAME]."\">";*/
	 return "<input type=\"hidden\" name=\"".FTOKEN_NAME."\" value=\"".$_SESSION[STOKEN_NAME]."\">";
	}
	
	//实现对隐藏域中提交的Session令牌的检测的函数
	function token_check() {
	// Check if the Session Token exists
	//if(is_stoken()) {
		if(1==1) {
		// Check if the request has been sent
			if(isset($_REQUEST[FTOKEN_NAME])) {
			// If the Form Token is different from Session Token
			// it’s a malicious request
				if($_REQUEST[FTOKEN_NAME] != $_SESSION[STOKEN_NAME]) {
				gen_error(1);
				destroy_stoken();
				exit();
				} 
				else {
				destroy_stoken();
				}
			// If it isn’t then it’s a malicious request
			}
			 else {
			gen_error(2);
			destroy_stoken();
			exit();
			}
		// If it isn’t then it’s a malicious request
		}
		else {
		gen_error(3);
		destroy_stoken();
		exit();
		}
	}
	
	//销毁一次性令牌
	function destroy_stoken(){
	
	}
	
	function gen_error($i){
	if ($i==1) die('非法请求1');
	if ($i==2) die('非法请求2');
	if ($i==3) die('非法请求3');	
	}
///////////anti CSRF函数结束/////////









//############完美截取中文字符############
function c_substr($string, $from, $length = null){
    preg_match_all('/[x80-xff]?./', $string, $match);
    if(is_null($length)){
        $result = implode('', array_slice($match[0], $from));
    }else{
        $result = implode('', array_slice($match[0], $from, $length));
    }
    return $result;
}
//还有utf-8的
/*
Regarding windix's function to handle UTF-8 strings:
one can use the "u" modifier on the regular expression so that the pattern string is treated as UTF-8
(available from PHP 4.1.0 or greater on Unix and from PHP 4.2.3 on win32).
This way the function works for other encodings too (like Greek for example).
The modified function would read like this:
*/
function utf8_substr($str,$start,$end) {
$null = "";
   preg_match_all("/./u", $str, $ar);
   if(func_num_args() >= 3) {
       $end = func_get_arg(2);
       return join($null, array_slice($ar[0],$start,$end));
   } else {
       return join($null, array_slice($ar[0],$start));
   }
}


// 说明：获取 _SERVER['REQUEST_URI'] 值的通用解决方案
// 来源：drupal-5.1 bootstrap.inc

function request_uri(){
	  if (isset($_SERVER['REQUEST_URI'])){
	  $uri = $_SERVER['REQUEST_URI'];
	  }
	  else{
		  if (isset($_SERVER['argv'])){
		  $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
		  }
		  else{
		  $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
		  }
	  }
	  return $uri;
}
?>