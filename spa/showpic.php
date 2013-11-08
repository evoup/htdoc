<?php
  //照片显示程序
  //Author: Aigui.Liu@ihep.ac.cn
  //Date: 2006-04-28
  //Last modified: 2006-05-15
?>
<?php
  header("Content-type: text/html;charset=gb2312");
  include("general.php");
                                                                                                   
  $album = $_GET['album'];
  $pic = $_GET['pic'];
  $no = intval($_GET['index']);

  //fetch all picture names and save them into cookies.
  $count = 0;
  $dir = opendir("$albumpath/$album/");
  echo <<<HTML
  <SCRIPT LANGUAGE='JavaScript' type='text/JavaScript'>
  <!--
 	var slide_flag = 0;
        var interval = 2000;
        var oInterval = "";
        var pic_array = new Array();
        var tempPic = new Image;
        var count, i, index = $no;
HTML;
  while ($file = readdir($dir)) {
        if (ereg("^(.*).(jpg|JPG|jpeg|JPEG|tif|TIF|png|PNG)$", $file)) { 
  		$pics[$count] = $file;
                print "pic_array[$count]='$file';";
		$count ++;
	}
  }
  closedir($dir);
  echo <<<HTML
  //-->
  </SCRIPT>
HTML;
?>

<SCRIPT LANGUAGE="JavaScript" type="text/JavaScript">
<!--
	tempPic.src = pic_array[0];
        count = '<? echo $count;?>';

function getCookie (name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = window.document.cookie.length;
	var i = 0;
	while (i < clen) {
		var j = i + alen;
		if (window.document.cookie.substring(i, j) == arg) return getCookieVal (j);
		i = window.document.cookie.indexOf(" ", i) + 1;
		if (i == 0) break;
	}
	return null;
}

function getCookieVal (offset) {
	var endstr = window.document.cookie.indexOf (";", offset);
	if (endstr == -1) endstr = window.document.cookie.length;
	return unescape(window.document.cookie.substring(offset, endstr));
}

function slide_show() {
        var oImg = document.getElementById("my.pic"); 
	var oImghref = document.getElementById("img.href");
	if (document.all) {
		oImg.filters.blendTrans.apply();
        	oImg.filters.blendTrans.play();
	}
        bestFit(true);
	oImg.src = "<?=$albumpath?>/<?=$album?>/" + pic_array[index];
	oImghref.href = "<?=$albumpath?>/<?=$album?>/" + pic_array[index];
        document.all.picName.innerHTML = "图片名称：" + pic_array[index] + " (第" + (index+1) +"/" + count +"张) ";
}

function next_image() {
        index = (index < count-1)?index+1: 0;
        slide_show();
}

function pre_image() {
        index = (index > 0)?index-1 : count-1;
	slide_show();
}

function startSlide() {
	next_image();
        if (oInterval=="") {
        	oInterval = setInterval("startSlide()", interval);
        }
}

function stopSlide() {
	window.clearInterval(oInterval);
	oInterval = "";
}

function bstartSlide() {
	document.all.slideSpan.innerHTML = "<input type='button' id='slide_b' value='停止浏览' onclick='bstopSlide()'>";
	startSlide();
}

function bstopSlide() {
        document.all.slideSpan.innerHTML = "<input type='button' id='slide_b' value='自动浏览' onclick='bstartSlide()'>";
        stopSlide();
}

function chgInterval(inv) {
        bstopSlide();
        inv = parseFloat(inv);
        if(inv && (inv >0)) {
                interval = inv* 1000;
        }
	bstartSlide();
}

function bestFit(chg) {
	var fited = false;
	var oImg = document.getElementById("my.pic");
	var bWidth, bHeight;
	 bWidth = screen.availWidth * "<?=$percent_width_screen?>" /100 * 0.9;
	 bHeight = screen.availHeight-300;
	var nWidth, bHeight;
	tempPic.src = "<?=$albumpath?>/<?=$album?>/" + pic_array[index];
	nWidth = tempPic.width;
	nHeight = tempPic.height;
	picRate = nWidth/nHeight;
	if(chg) {
		if(nWidth > bWidth){
			oImg.width = bWidth;
			oImg.height = bWidth / picRate;
			fited = true;
		} else if(nHeight > bHeight) {
			oImg.height = bHeight;
			oImg.width = bHeight * picRate;
			fited = true;
		}
		if (nWidth == 0 ||nHeight == 0) {
			oImg.width = bWidth;
			//oImg.height = bHeight;		
			fited = true;
		}
	}
	if(fited == false) {
		oImg.width = nWidth;
		oImg.height = nHeight;
	}
}

function keyUp(){
        switch(window.event.keyCode) {
                case 33://PageUP
		case 37://LeftArrow
		case 38://UpArrow
		case 16://shift
			pre_image();
			break;
                case 34://PageDown
		case 39://RightArrow
		case 40://DownArrow
		case 17://Ctrl
			next_image();
			break;
        }
}
//-->
</SCRIPT>

<?php
  html_header();
  print <<<HTML
    <body onkeyup="keyUp()" onload="bestFit(true)">
    <div align='center'>
    <table width='$percent_width_screen%'>
    <tr><td id="AlbumName">当前相册：<a href="album.php?albumname=$album">$album</a>($count 张)</td></tr>
    </table>
    <table width='$percent_width_screen%'>  
    <tr>
    <td><input type="button" value=" 上一张 PageUp " onclick="pre_image()"></td>
    <td>
       间隔<input type="text" name="inv" size="2" value="2" onchange="chgInterval(this.value)">秒
        <span id="slideSpan"><input type='button' id='slide_b' value='自动浏览' onclick='bstartSlide()'></span>
    </td>
    <td><input type="button" value=" 下一张 PageDown " onclick="next_image()"></td>
    </tr>
    </table><br>
    <table width='$percent_width_screen%'><tr><td id="picArea">
    <a href="$albumpath/$album/$pic" id="img.href">
    <img id="my.pic" style="filter:blendTrans(duration=1)" src='$albumpath/$album/$pic' width='90%'></img></a>
    </td>
    <tr><td id="picName">图片名称：$pic</td></tr>
    </table><br>
    <table width='$percent_width_screen%'><tr><td><a href='album.php?albumname=$album'>返回相册</a></td></tr></table><br>
    </div></body>
HTML;
  html_copyright();
?>
