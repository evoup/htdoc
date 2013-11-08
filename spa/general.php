<?php
  //����ȫ�ֱ����ͺ���
  //Author: Aigui.Liu@ihep.ac.cn
  //Date: 2006-04-27
  //Last modified: 2006-04-28
?>
<?php
include("config.php");
  
$albumpath = "album/"; //���·��
$cachepath = "cache/"; //cache·��
$imagespath = "images/"; //images·��
$author = "Aigui.LIU(�׿�ˮ)"; //����
$author_homepage = "http://aigui.liu.googlepages.com"; //������ҳ���뱣��
$photos_per_line = 4; //ÿ����ʾ��΢ͼ��Ŀ
$percent_width_screen = 60; //�����ռ��Ļ�ٷֱ�

//���HTMLҳ��head
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
  
//���Copyright��Ϣ
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

//��ȡ�ͻ���IP
function get_client_ip()
{
    if (getenv("HTTP_CLIENT_IP"))
    	return getenv("HTTP_CLIENT_IP");
    elseif (getenv("HTTP_X_FORWARDED_FOR"))
        return getenv("HTTP_X_FORWARDED_FOR");
    else
        return getenv("REMOTE_ADDR");
}

//����makethumb������jpeg/jpg��ʽ��΢ͼ,֧��gif, jpg/jpeg,png��ʽ
//srcFile: Դͼ��
//dstFile: ����ͼ��
//ratio:   ��С����
//whereOutput: ������δ���FILE-�ļ���BROWSER-�����
function makethumb($srcFile, $dstFile, $ratio, $whereOutput)
{
  $data = getimagesize($srcFile);
  //����ͼ���ļ����ʹ���ͼ��
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
  {//������ļ�
    ImageJpeg($ni,$dstFile,100);  //100Ϊ����ͼ������(0-100,Ĭ��Ϊ75)���ɸ�����Ҫ�����޸�
    chmod($dstFile,0777);
  }
  elseif($whereOutput=="BROWSER")
  {//����������
    header("Content-Type:image/jpeg");  //��ƭ�����,^-^
    ImageJpeg($ni);
  }
  ImageDestroy($im);
  ImageDestroy($ni);
}

//����Ŀ¼��������JPG/JPEGͼ����΢ͼ��������ļ��������
function showalbum($album_path)
{
  global $cachepath, $photos_per_line, $url;
  global $percent_width_screen, $albumpath;

  html_header();
  print "<div align='center'><table width='$percent_width_screen%'><tr><td><a href='$url'>���������ҳ</a></td><td>��ǰ��᣺$album_path</td><td><a href='$url'>���������ҳ</a></td></tr></table><br>";
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
      //��ʽ�����
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
  print "<table width='$percent_width_screen%'><tr><td><a href=$url>���������ҳ</a></td></tr></table><br>";
  print "</div>";
  html_copyright();
}

//��ȡ��һ����Ƭ�ļ���
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

//��ȡ��һ����Ƭ�ļ���
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
