<html>
<head>
<title>测试</title></head>
<?php
function getremotepage($url,$cutlast=1)//针对有的URL要剪掉最后一部分的
{
  // 采集首页地址
  //$url = "http://cn.jokes.yahoo.com/jok/index1.html";

  // 获取页面代码
  $r = file_get_contents($url);
$cutlast=1?($url=$url):($url=$url);


  //$r = iconv("gb2312", "utf-8",$r);


  //echo $r;

  //连接是 http://cn.jokes.yahoo.com/07-08-/55/27ng4.html
  //源码是<img src="http://cn.yimg.com/i/cn/px_ar.gif" width=5 height=12 border=0 hspace=5><a href="http://cn.jokes.yahoo.com/07-08-/55/27ng4.html" class=list target=_blank><big>14类</big></a>
  //<br>&nbsp;&nbsp;<span class=gsbody>2007-08-08 7:49AM</span>
  //<a href="/html/12/2008-4-27/92740.shtml" target="_blank">551xx.com-4-27-清晰图 5</a>



  // 设置匹配正则
  $preg = '/hspace=5><a href="http:\/\/cn.jokes.yahoo.com\/(.*).html" class
    =list target=_blank>/isU';
  $preg = '/<a href="\/html\/(.*)\/(.*)\/(.*).shtml" target="_blank">/isU';
  // 进行正则搜索
  preg_match_all($preg, $r, $title);
//echo "title is".$title[1][2][24];
//die;




/*foreach ($title[1] as $KK => $vv){
  foreach($title[$KK] as $K => $v)
  {
  if ($K!='' || $v!=''){
    echo"<H3 color=red>".$K."</H3>";
    echo"<H3>".$v."</H3>";echo "K is".$K;
	}
	echo "KK is".$KK;
	echo "v is".$title[1][$KK][$k];
}echo "<br>";
echo "KK is".$KK;

echo "<hr>";*/

$x=count($title[2]);
for ($i=0;$i<$x;$i++){
 $subdir2=$title[2][$i];
 $subdir3=$title[3][$i];
//echo $jumpURL=$url."/".$subdir2."/".$subdir3.".shtml";
 $jumpURL=$url."/".$subdir2."/".$subdir3.".shtml";
echo "<br>";
$c=file_get_contents($jumpURL);


$p = '/<div class="content">(.*)<\/div>/isU';

if (preg_match($p, $c, $content)){
//echo $content[0];


$pp='<img (.*) />isU';
if (preg_match($pp, $content[0], $myimg)){
//echo "<";//不知道为什么少了<>
//echo $myimg[0];
//echo ">";
$myimg[0]="<".$myimg[0].">";
echo $myimg[0];
//$ppp= "/<img[^s]+src=([^\"]+)   /isU";   //提取图片地址正则
//$ppp= "/<img[^s]+src=([^\"]+)   /isU";   //提取图片地址正则
//	if (preg_match($ppp,$myimg[0],$myimgsrc)){
//	echo $myimgsrc[0];
//	}

}






}


//echo $c;
}




//http://192.168.1.101/html/12/2008-4-27/92591.shtml



    //iconv("gb2312", "utf-8","jumpURL是").$jumpURL;//jumpURL是搜索到的连接，就是点击后的能出现页面的HTML元素节点内容的连接

//    $c = file_get_contents($jumpURL);
    //echo $c=iconv("gb2312", "utf-8",$c);
   /// $c = iconv("gb2312", "utf-8", $c);
   // echo $c;
    //echo "<br>";
    // 设置内容页匹配正则
   /// $p = '/<div id="newscontent">(.*)<\/div>/isU';
    // 进行正则匹配搜索

   /* if (!preg_match($p, $c, $content))
    {
      echo iconv("gb2312", "utf-8",
        "<img src=image/liuhan2.gif><font color=red>没有匹配到!</font>");
      // 输出标题
    }
    else
    {
      // 输出内容
      $exp = '/<h1 id="heading">(.*)<\/h1>/isU';
      preg_match($exp, $c, $tit);
      //preg_replace($exp, $c, $tit);
      echo"<div style='border:1px dashed #336699;color:#0066CC'>";
      echo $tit[0];
      echo"</div><div style='color:gray'>";
      echo $content[0];
      echo"</div>";
    }*/
  //}
}

//getremotepage("http://1.97gao.com/html/14",0);
//getremotepage("http://1.97gao.com/html/12/12_2.shtml",1);
getremotepage("http://1.97gao.com/html/12/",0);
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
</html>