<?php     
function getremotepage($url){
 // 采集首页地址     
 //$url = "http://cn.jokes.yahoo.com/jok/index1.html";     
 // 获取页面代码     
 $r = file_get_contents($url);   
 
 $r = iconv("gb2312", "utf-8",$r);
 
 
 //echo $r;  
 
//连接是 http://cn.jokes.yahoo.com/07-08-/55/27ng4.html
//源码是<img src="http://cn.yimg.com/i/cn/px_ar.gif" width=5 height=12 border=0 hspace=5><a href="http://cn.jokes.yahoo.com/07-08-/55/27ng4.html" class=list target=_blank><big>14类女性易发生婚外情</big></a>
//<br>&nbsp;&nbsp;<span class=gsbody>2007-08-08 7:49AM</span>

 // 设置匹配正则     
 $preg = '/hspace=5><a href="http:\/\/cn.jokes.yahoo.com\/(.*).html" class=list target=_blank>/isU';     
 // 进行正则搜索     
 preg_match_all($preg, $r, $title); 

 foreach ($title[1] as $K=>$v){
 echo "<H3 color=red>".$K."</H3>";
 echo "<H3>".$v."</H3>";
 
 
  $jumpURL="http://cn.jokes.yahoo.com/".$v.".html";
  //iconv("gb2312", "utf-8","jumpURL是").$jumpURL;//jumpURL是搜索到的连接，就是点击后的能出现页面的HTML元素节点内容的连接
  
  $c = file_get_contents($jumpURL); 
  //echo $c=iconv("gb2312", "utf-8",$c);
  $c=iconv("gb2312", "utf-8",$c);
  //echo $c;
  //echo "<br>";
  // 设置内容页匹配正则     
  $p = '/<div id="newscontent">(.*)<\/div>/isU';     
  // 进行正则匹配搜索     
  
  if (!preg_match($p, $c, $content))    {
  echo iconv("gb2312","utf-8","<img src=image/liuhan2.gif><font color=red>没有匹配到!</font>");
  // 输出标题     
  }
  else{
  // 输出内容     
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

 
 
 
 
 //以下的程序有问题
 /*
 // 计算标题数量     
 $count = count($title[1]);     
 // 通过标题数量进行内容采集     
 for($i=0;$i<$count;$i++) {     
   // 设置内容页地址     
  $jurl = '<a href="http:\/\/cn.jokes.yahoo.com\/\">http://cn.jokes.yahoo.com/</a>' . $title[1][$i] . '.html'; 
print_r("<font color=red>".$jurl."</font>")    ;//这是子路径
  // 获取内容页代码     
  $c = file_get_contents($jurl);     
  
echo ("<h2 color=green>".$c."</h2>"  );
  
  // 设置内容页匹配正则     
  $p = '/<div id="newscontent">(.*)</div>/isU';     
  // 进行正则匹配搜索     
  preg_match($p, $c, $content);     
  // 输出标题     
  echo $title[1][$i] . "<br>";     
  // 输出内容     
  echo $content[$i];     
 } */   
 
 
 
 
 
 
 

  
 ?>   
