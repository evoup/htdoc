<?php
  //���˵��
  //Author: Aigui.Liu@ihep.ac.cn
  //Date: 2006-05-14
  //Last modified: 2006-05-14
?>
<?php
  header("Content-type: text/html;charset=gb2312");
  include("general.php");
  html_header();
  print "<a href='$url'>���������ҳ</a>";
  print <<<HTML
  <pre>
  <center><h2>SPA(Simple PHP Album)���</h2></center>
  <hr size=1 color="#AAAAAA">
  .�����Ϊ����������ҿɸ���GPLʹ�úʹ�����

  .ϵͳĿǰֻ��GNU/LINUX�²��ԣ�Ҫ��װPHP����֧��GD�⣬������PHP����phpinfo()�鿴��

  .��ʹ��IE�����������ʱ����������ȷ��ʾͼƬ��������IEΪ����ʹ��UTF-8�������ݡ�
   
   ���÷�����IE-->����-->--�߼�>���һ�������ʹ��UTF-8�������ݡ�������

  .albumĿ¼Ϊ���Ŀ¼�������ÿһ����Ŀ¼Ϊһ��ᣬ����Ƭֱ��COPY����ӦĿ¼�¼��ɡ�

  .album��cacheĿ¼��������Ϊ777��

  .config.php����������������Ϣ���ɸ���ʵ������޸ġ�

  .general.php�Ǳ����ͺ����Ķ��壬�û�����Ҫ�޸ġ�

  .index.php��������б�album.php�����Ӧ���, showpic.php�鿴��Ƭ��

  .����Ϊgb2312,��������������������������ñ��뷽ʽΪgb2312��
  </pre>
HTML;
  html_copyright();
?>
