<?php
  //子相册显示程序，缩微图浏览，点击查看原始图像
  //Author: Aigui.Liu@ihep.ac.cn
  //Date: 2006-04-27
  //Last modified: 2006-04-27
?>
<?php
  include("general.php");
  header("Content-type: text/html;charset=gb2312");

  $album = $_GET['albumname'];
  showalbum($album);
?>
