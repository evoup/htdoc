<?php     
function getremotepage($url){
 // �ɼ���ҳ��ַ     
 //$url = "http://cn.jokes.yahoo.com/jok/index1.html";     
 // ��ȡҳ�����     
 $r = file_get_contents($url);   
 
 $r = iconv("gb2312", "utf-8",$r);
 
 
 //echo $r;  
 
//������ http://cn.jokes.yahoo.com/07-08-/55/27ng4.html
//Դ����<img src="http://cn.yimg.com/i/cn/px_ar.gif" width=5 height=12 border=0 hspace=5><a href="http://cn.jokes.yahoo.com/07-08-/55/27ng4.html" class=list target=_blank><big>14��Ů���׷���������</big></a>
//<br>&nbsp;&nbsp;<span class=gsbody>2007-08-08 7:49AM</span>

 // ����ƥ������     
 $preg = '/hspace=5><a href="http:\/\/cn.jokes.yahoo.com\/(.*).html" class=list target=_blank>/isU';     
 // ������������     
 preg_match_all($preg, $r, $title); 

 foreach ($title[1] as $K=>$v){
 echo "<H3 color=red>".$K."</H3>";
 echo "<H3>".$v."</H3>";
 
 
  $jumpURL="http://cn.jokes.yahoo.com/".$v.".html";
  //iconv("gb2312", "utf-8","jumpURL��").$jumpURL;//jumpURL�������������ӣ����ǵ������ܳ���ҳ���HTMLԪ�ؽڵ����ݵ�����
  
  $c = file_get_contents($jumpURL); 
  //echo $c=iconv("gb2312", "utf-8",$c);
  $c=iconv("gb2312", "utf-8",$c);
  //echo $c;
  //echo "<br>";
  // ��������ҳƥ������     
  $p = '/<div id="newscontent">(.*)<\/div>/isU';     
  // ��������ƥ������     
  
  if (!preg_match($p, $c, $content))    {
  echo iconv("gb2312","utf-8","<img src=image/liuhan2.gif><font color=red>û��ƥ�䵽!</font>");
  // �������     
  }
  else{
  // �������     
    $exp = '/<h1 id="heading">(.*)<\/h1>/isU';  
  preg_match($exp, $c, $tit);
  //preg_replace($exp, $c, $tit);
echo "<div style='border:1px dashed #336699;color:#0066CC'>";
  echo $tit[0];
echo "</div><div style='color:gray'>";  
  echo $content[0]; 
  echo "</div>";
  }
 }
 }
getremotepage("http://cn.jokes.yahoo.com/jok/index.html");  
getremotepage("http://cn.jokes.yahoo.com/adult/index.html"); 
getremotepage("http://cn.jokes.yahoo.com/adult/index1.html");
getremotepage("http://cn.jokes.yahoo.com/adult/index2.html");
getremotepage("http://cn.jokes.yahoo.com/adult/index3.html");
die;

 
 
 
 
 //���µĳ���������
 /*
 // �����������     
 $count = count($title[1]);     
 // ͨ�����������������ݲɼ�     
 for($i=0;$i<$count;$i++) {     
   // ��������ҳ��ַ     
  $jurl = '<a href="http:\/\/cn.jokes.yahoo.com\/\">http://cn.jokes.yahoo.com/</a>' . $title[1][$i] . '.html'; 
print_r("<font color=red>".$jurl."</font>")    ;//������·��
  // ��ȡ����ҳ����     
  $c = file_get_contents($jurl);     
  
echo ("<h2 color=green>".$c."</h2>"  );
  
  // ��������ҳƥ������     
  $p = '/<div id="newscontent">(.*)</div>/isU';     
  // ��������ƥ������     
  preg_match($p, $c, $content);     
  // �������     
  echo $title[1][$i] . "<br>";     
  // �������     
  echo $content[$i];     
 } */   
 
 
 
 
 
 
 

  
 ?>   
