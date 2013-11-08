<?php
  //相册主界面程序
  //Author: Aigui.Liu@ihep.ac.cn
  //Date: 2006-04-27
  //Last modified: 2006-04-28
?>
<?php
  include("general.php");
  header("Content-type: text/html;charset=gb2312");

  html_header();
  print "<div align='center'><table width='$percent_width_screen%'><tr><td><a href=$url>$welcomeMsg</a></td></tr></table><br>";

  print "<table width='$percent_width_screen%'>";
  $dir = opendir($albumpath);
  $album_count = 0;
  while(false!=($album = readdir($dir)))
  {
    if(!($album=="." || $album==".."))
    {
       if($album_count % $photos_per_line == 0)
       {
         print "<tr>";
       }
       print "<td>";
       $cover_image = "$imagespath/default.jpg";
       if (file_exists("$imagespath/$album.jpg")) {
       		$cover_image = "$imagespath/$album.jpg";
       }
       print "<p><a href=album.php?albumname=$album><img src=$cover_image></a></p>";
       print "<p><a href=album.php?albumname=$album>$album</a></p>";
       print "</td>";
       if(($album_count+1) % $photos_per_line == 0)
       {
         print "</tr>";
       } 
       $album_count ++;
    }
  }

  while(($album_count) % $photos_per_line != 0 && $album_count > $photos_per_line)
  {
    print "<td></td>";
    $album_count ++;
    $flag = 1;
  }
  if($flag == 1)
  {
    print "</tr>";
  }
  
  closedir($dir);
  print "</table></div>";

  $ip = get_client_ip();
  print "<br><div align='center'>欢迎来自 $ip 的朋友</div>";
  html_copyright();
?>
