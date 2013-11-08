<?
//abitwhizzy.php - whizzywig web page editor, demonstrating whizzywig.js
//Copyright © 2005, John Goodman - john.goodman(at)unverse.net  *date 060904 
//This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. A copy of the GNU General Public License can be obtained at: http://www.gnu.org/licenses/gpl.html

if (!isset($_SERVER))
{
   $_GET    = &$HTTP_GET_VARS;
   $_POST    = &$HTTP_POST_VARS;
   $_ENV    = &$HTTP_ENV_VARS;
   $_SERVER  = &$HTTP_SERVER_VARS;
   $_COOKIE  = &$HTTP_COOKIE_VARS;
   $_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
}
$f = $_REQUEST['f'];
$t = $_REQUEST['t'];

//CONFIGURE HERE ====================================================================
if (!$password) $password= ""; //can leave password as "" if you are using .htaccess to protect abitwhizzy
if (!$whizzywig) $whizzywig = "whizzery/whizzywig.js"; //path to whizzywig.js required
if (!$cssFile) $cssFile= "whizzery/simple.css"; //choose your stylesheet, or set to ""
if (!$buttonPath) $buttonPath = "whizzery/buttons/"; //toolbar images live here. "" for text buttons
if (!$imageBrowse) $imageBrowse = "whizzery/whizzypic.php"; // "" for no image browser
if (!$linkBrowse) $linkBrowse = "whizzery/whizzylink.php"; // "" for no link browser
if (!$toolbar) $toolbar = "formatblock bold italic color bullet number image link table clean html"; //try "all" if you need more
if (!$editarea) $editarea = "width:100%; height:75%";
if (!$xhtml) $xhtml = ""; //path to xhtml converter, or set to "" for HTML 4.01. Use appropriate header in $top.
if (!$extensions) $extensions = "/(html|htm)$/"; //file extensions to consider for edit (in the brackets|to separate)
//LEAVE THESE
if ($xhtml) $doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
 else $doctype = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>';
//HTML TEMPLATE: Use these 2 variables ($top and $tail) to wrap the generated HTML in your own template.
if (!$top) $top = "$doctype\n<head>\n<title>$t</title>\n<link rel='stylesheet' type='text/css' href='$cssFile' >\n</head>\n<body>";
if (!$tail) $tail = "<form style='float:right' action='".$_SERVER['SCRIPT_NAME']."'><input type='hidden' name='f' value='$f'><input type='submit' style='font-size:xx-small' value='Edit'></form></body>\n</html>";
//END CONFIG ========================================================================

if ($_REQUEST['save']) { //write page and go there
 if ($_REQUEST['p'] != $password) die ("<h1>Wrong password: not saved.</h1>Click the Back button to try again. ");
 if (!strpos($f,'.')) $f = $f.'.html';
 $edited = $_REQUEST['edited'];
 if ($f == "top.shtml" || $f == "tail.shtml") $html = stripslashes($edited);
 else {
  $html = $top."<!--#include virtual='top.shtml'-->"; 
  $html .= stripslashes($edited);
  $html .= "<!--#include virtual='tail.shtml'-->".$tail; 
 }
 $fsave = fopen($f, 'w');  //save the edited file
 fwrite($fsave, $html);
 fclose($fsave); 
 header("Location: $f");
} else if (file_exists($f)) {
 $fedit = fopen($f, 'r');  //open the file for edit
 $content = fread($fedit, filesize($f));
 $start = strpos($content,"<!--#include virtual='top.shtml'-->") ? "/.*<!--#include virtual='top.shtml'-->/" : "|.*<body[^>]*>|iU";
 $stop = strpos($content,"<!--#include virtual='tail.shtml'-->") ? "/<!--#include virtual='tail.shtml'-->.*/" : "|</body>.*$|iU";
 $content = preg_replace($start,'',$content);
 $content = preg_replace($stop,'',$content);
 fclose($fedit); 
 preg_match('|<title>(.*)</title>|i',$content, $match);
 $t = $match[1];  //grab the title
} //now show form
//===================================================================================
?>
<html>
<head>
 <title>aBitWhizzy: the Whizzywig page editor v5</title>
 <script language="JavaScript" type="text/javascript" src="<?= $whizzywig ?>"></script>
 <? if ($xhtml) echo '<script language="JavaScript" type="text/javascript" src="'.$xhtml.'>"></script>'; ?>
 <script language="JavaScript" type="text/javascript">
 function insistF() { //check filename given before save
  if (document.getElementById("f").value == "") {
   alert("Please supply a filename"); 
   document.getElementById("f").style.backgroundColor="yellow";
   document.getElementById("f").focus();
   return false;
  }else return true;
 }
 </script>
 <meta name="robots" content="noindex,nofollow">
</head>
<body>
<form name="Whizzy" action="<? $_SERVER['SCRIPT_NAME']; ?>" method="post" onsubmit="return insistF()">
<label for="f">Filename: </label><input name="f" id="f" type="text" value="<?=$f;?>">
<select onchange="document.getElementById('f').value=this.options[this.selectedIndex].value;" style="vertical-align:middle">
 <option value="">or choose:</option>
<?
$dir = opendir('./');
while ($fil = readdir($dir)){
  $files[] = $fil;
}
closedir($dir);
sort($files);
foreach ($files as $fil){
 if (preg_match($extensions,$fil)){
  echo "<option value='$fil'>$fil</option>\n"; //it's a potential link
 }
}
?>
</select>
<input type="submit" name="open" value="Open">
<label for="t">Title: </label><input id="t" name="t" type="text" size="30" value="<?=$t;?>">
<? if ($password) { ?>
 <br><label for="p">Password: </label><input id="p" name="p" type="password" size="8" onkeypress="document.getElementById('save').style.display='inline'">
 <input type="submit" name="save" id="save" value="Save" style="display:none">
<? } else echo '<input type="submit" name="save" value="Save">'; ?>
<textarea name="edited" id="edited" rows="25" cols="70" style="<?=$editarea;?>">
<?=$content;?>
</textarea>
<script language="JavaScript" type="text/javascript">
 buttonPath = "<?=$buttonPath;?>";
 cssFile = "<?=$cssFile;?>"
 imageBrowse = "<?=$imageBrowse;?>";
 linkBrowse = "<?=$linkBrowse;?>";
 makeWhizzyWig("edited", "<?=$toolbar;?>");
</script>
</form>
<p style="font-size:xx-small">
<a href="http://www.unverse.net/abitwhizzy">aBitWhizzy</a>: 
More about this free editor from <a href="http://www.unverse.net">unverse.net</a>
</p>
</body>
</html>