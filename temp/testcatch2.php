<html>
<head>
<title>����</title></head>
<?php
function getremotepage($url,$cutlast=1)//����е�URLҪ�������һ���ֵ�
{
  // �ɼ���ҳ��ַ
  //$url = "http://cn.jokes.yahoo.com/jok/index1.html";

  // ��ȡҳ�����
  $r = file_get_contents($url);
$cutlast=1?($url=$url):($url=$url);


  //$r = iconv("gb2312", "utf-8",$r);


  //echo $r;

  //������ http://cn.jokes.yahoo.com/07-08-/55/27ng4.html
  //Դ����<img src="http://cn.yimg.com/i/cn/px_ar.gif" width=5 height=12 border=0 hspace=5><a href="http://cn.jokes.yahoo.com/07-08-/55/27ng4.html" class=list target=_blank><big>14��</big></a>
  //<br>&nbsp;&nbsp;<span class=gsbody>2007-08-08 7:49AM</span>
  //<a href="/html/12/2008-4-27/92740.shtml" target="_blank">551xx.com-4-27-����ͼ 5</a>



  // ����ƥ������
  $preg = '/hspace=5><a href="http:\/\/cn.jokes.yahoo.com\/(.*).html" class
    =list target=_blank>/isU';
  $preg = '/<a href="\/html\/(.*)\/(.*)\/(.*).shtml" target="_blank">/isU';
  // ������������
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
//echo "<";//��֪��Ϊʲô����<>
//echo $myimg[0];
//echo ">";
$myimg[0]="<".$myimg[0].">";
echo $myimg[0];
//$ppp= "/<img[^s]+src=([^\"]+)   /isU";   //��ȡͼƬ��ַ����
//$ppp= "/<img[^s]+src=([^\"]+)   /isU";   //��ȡͼƬ��ַ����
//	if (preg_match($ppp,$myimg[0],$myimgsrc)){
//	echo $myimgsrc[0];
//	}

}






}


//echo $c;
}




//http://192.168.1.101/html/12/2008-4-27/92591.shtml



    //iconv("gb2312", "utf-8","jumpURL��").$jumpURL;//jumpURL�������������ӣ����ǵ������ܳ���ҳ���HTMLԪ�ؽڵ����ݵ�����

//    $c = file_get_contents($jumpURL);
    //echo $c=iconv("gb2312", "utf-8",$c);
   /// $c = iconv("gb2312", "utf-8", $c);
   // echo $c;
    //echo "<br>";
    // ��������ҳƥ������
   /// $p = '/<div id="newscontent">(.*)<\/div>/isU';
    // ��������ƥ������

   /* if (!preg_match($p, $c, $content))
    {
      echo iconv("gb2312", "utf-8",
        "<img src=image/liuhan2.gif><font color=red>û��ƥ�䵽!</font>");
      // �������
    }
    else
    {
      // �������
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
</html>