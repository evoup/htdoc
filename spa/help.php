<?php
  //相册说明
  //Author: Aigui.Liu@ihep.ac.cn
  //Date: 2006-05-14
  //Last modified: 2006-05-14
?>
<?php
  header("Content-type: text/html;charset=gb2312");
  include("general.php");
  html_header();
  print "<a href='$url'>返回相册首页</a>";
  print <<<HTML
  <pre>
  <center><h2>SPA(Simple PHP Album)相册</h2></center>
  <hr size=1 color="#AAAAAA">
  .本软件为免费软件，大家可根据GPL使用和传播。

  .系统目前只在GNU/LINUX下测试，要求安装PHP，且支持GD库，可用在PHP中用phpinfo()查看。

  .当使用IE浏览器浏览相册时，若不能正确显示图片，请设置IE为‘不使用UTF-8传输数据’
   
   设置方法：IE-->工具-->--高级>最后一项，将‘总使用UTF-8传输数据’勾掉。

  .album目录为相册目录，里面的每一个子目录为一相册，将照片直接COPY至相应目录下即可。

  .album和cache目录属性设置为777。

  .config.php定义了相册的配置信息，可根据实际情况修改。

  .general.php是变量和函数的定义，用户不需要修改。

  .index.php产生相册列表，album.php浏览相应相册, showpic.php查看照片。

  .编码为gb2312,如果浏览器不能正常浏览，请设置编码方式为gb2312。
  </pre>
HTML;
  html_copyright();
?>
