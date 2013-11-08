<?php
  //定义全局变量和函数
  //Author: Aigui.Liu@ihep.ac.cn
  //Date: 2006-04-27
  //Last modified: 2006-04-28
?>
<?php
include("config.php");
  
$albumpath = "album/"; //相册路径
$cachepath = "cache/"; //cache路径
$imagespath = "images/"; //images路径
$author = "Aigui.LIU(白开水)"; //作者
$author_homepage = "http://aigui.liu.googlepages.com"; //作者主页，请保留
$photos_per_line = 4; //每行显示缩微图数目
$percent_width_screen = 60; //表格宽度占屏幕百分比

//输出HTML页面head
function html_header()
{
    global $title;
    print <<<HTML
    <head>
    <meta content="text/html; charset=gb2312" http-equiv="Content-Type">
    <title>$title</title>
    <link rel="stylesheet" href="main.css">
    </head>
HTML;
}
  
//输出Copyright信息
function html_copyright()
{
  global $author, $author_homepage;
  print <<<HTML
      <br>
      <center>
      <hr size=1 color="#AAAAAA"><br>
      <span>CopyRight 2006 <a href=$author_homepage>$author</a> All Rights Reserved</span>
      <p>SPA(Simple PHP album) version 1.0 <a href="help.php">Help?</a></p>
      </center>
      </body>
      </html>
HTML;
}

//获取客户端IP
function get_client_ip()
{
    if (getenv("HTTP_CLIENT_IP"))
    	return getenv("HTTP_CLIENT_IP");
    elseif (getenv("HTTP_X_FORWARDED_FOR"))
        return getenv("HTTP_X_FORWARDED_FOR");
    else
        return getenv("REMOTE_ADDR");
}

//函数makethumb：生成jpeg/jpg格式缩微图,支持gif, jpg/jpeg,png格式
//srcFile: 源图像
//dstFile: 生成图像
//ratio:   大小比例
//whereOutput: 输出到何处，FILE-文件，BROWSER-浏览器
function makethumb($srcFile, $dstFile, $ratio, $whereOutput)
{
  $data = getimagesize($srcFile);
  //根据图像文件类型创建图像
  switch ($data[2])
  {
  case 1:
    $im = imagecreatefromgif($srcFile);
    break;
  case 2:
    $im = imagecreatefromjpeg($srcFile);
    break;
  case 3:
    $im = imagecreatefrompng($srcFile);
    break;
  default:
    exit;
  }
  $srcW = imagesx($im);
  $srcH = imagesy($im);
  //$dstW = $srcW * $ratio;
  //$dstH = $srcH * $ratio;
  if($srcW < $srcH)
  {
    $dstH = 96;
    $dstW = $srcW * (96/$srcH);
  }
  else
  {
    $dstW = 128;
    $dstH = $srcH * (128/$srcW);
  }
  $ni=ImageCreateTrueColor($dstW,$dstH);
  ImageCopyResized($ni,$im,0,0,0,0,$dstW,$dstH,$srcW,$srcH);
  if($whereOutput=="FILE")
  {//输出至文件
    ImageJpeg($ni,$dstFile,100);  //100为生成图像质量(0-100,默认为75)，可根据需要自行修改
    chmod($dstFile,0777);
  }
  elseif($whereOutput=="BROWSER")
  {//输出至浏览器
    header("Content-Type:image/jpeg");  //欺骗浏览器,^-^
    ImageJpeg($ni);
  }
  ImageDestroy($im);
  ImageDestroy($ni);
}

//遍历目录生成所有JPG/JPEG图像缩微图，输出至文件和浏览器
function showalbum($album_path)
{
  global $cachepath, $photos_per_line, $url;
  global $percent_width_screen, $albumpath;

  html_header();
  print "<div align='center'><table width='$percent_width_screen%'><tr><td><a href='$url'>返回相册首页</a></td><td>当前相册：$album_path</td><td><a href='$url'>返回相册首页</a></td></tr></table><br>";
  print "<table width='$percent_width_screen%'>";

  $dir = opendir("$albumpath/$album_path");
  $photo_count = 0;
  while($file = readdir($dir))
  {
    if(ereg("^(.*).(jpg|JPG|jpeg|JPEG|tif|TIF|png|PNG)$", $file))
    {
      $whereOutput = "FILE";
      $ratio = 0.1;
                                                                                                   
      $newname = "$cachepath/$album_path"."_".$file;
      $oldname = "$albumpath/$album_path/$file";
      if(file_exists($newname) == false)
      {
        makethumb($oldname, $newname, $ratio, $whereOutput);
      }
      //格式化输出
      if($photo_count % $photos_per_line == 0)
      {
         print "<tr>";
      }
      
      $linkurl = "showpic.php?album=$album_path&pic=$file&index=$photo_count";
      print "<td><a href='$linkurl'><img src='$newname'></a><br>";
      print "<a href='$linkurl'>$file</a></td>";
      
      if(($photo_count+1) % $photos_per_line == 0)
      {
         print "</tr>";
      }
      $photo_count ++;
    }
  }
  while(($photo_count+1) % $photos_per_line != 0)
  {
    print "<td></td>";
    $photo_count ++;
    $flag = 1;
  }
  if($flag == 1)
  {
    print "</tr>";
  }
  closedir($dir);
  print "</table><br>";
  print "<table width='$percent_width_screen%'><tr><td><a href=$url>返回相册首页</a></td></tr></table><br>";
  print "</div>";
  html_copyright();
}

//获取上一张照片文件名
function get_previous_image($album, $picture)
{
  global $albumpath;
  $dir = opendir("$albumpath/$album");
  $previous_image = $picture;
  while ($file = readdir($dir)) {
    if(ereg("^(.*).(jpg|JPG|jpeg|JPEG|tif|TIF|png|PNG)$", $file)) {
  	if ($file == $picture) {
		break;
	}
	$previous_image = $file;
    }
  }
  closedir($dir);
  return $previous_image; 
}

//获取下一张照片文件名
function get_next_image($album, $picture)
{
  global $albumpath;
  $dir = opendir("$albumpath/$album");
  $next_image = $picture;
  while ($file = readdir($dir)) {
     if(ereg("^(.*).(jpg|JPG|jpeg|JPEG|tif|TIF|png|PNG)$", $file)) {
        if ($file == $picture) {
                $next_image = readdir($dir);
                break;
        }
    }
  }
  closedir($dir); 
  if ($next_image == ""){
     $next_image = $picture;
  }
  return $next_image;
}
?>
