<?php
// #######################写入文件 #######################
function write_file($filename,$contents) 
{
      if ($fp=fopen($filename,"w")) 
      { 
          fwrite($fp,stripslashes($contents)); 
          fclose($fp); 
          return true; 
      } else {
          return false; 
      } 
 } 
// ####################### 检查目录是否存在，不存在则建立 #######################
function createdir($dir)
  {
          if (!is_dir($dir))
          {
                  $temp = explode('/',$dir);
                  $cur_dir = "";
                  for($i=0;$i<count($temp);$i++)
                  {
                          $cur_dir .= $temp[$i]."/";
                          if (!is_dir($cur_dir))
                          {
                              @mkdir($cur_dir,0777);
                          }
                  }
          }
  }


// #######################以下是生成滚动新闻的js #######################

class evp_makejs
{
	function makes(){//PHP4构造函数
	$db=new dbClass("root","jysysadmin","jyit","localhost",1);
	$db->connect();
	mysql_query("SET NAMES 'utf8'");
	$db->select();
	}
#生成滚动公告JS的方法
	function make_announce_js($content,$sort=''){//sort暂时没用到
	global $db;
	$jsfile = "../js/rollnews_1.js";
	$temp=$content;
	$jscontent=$temp;
	$result=$db->query("select * from bulletin group by id");	
	while($row=$db->getarray($result)){	
	$annstr.="<span style='margin-right:270px;'><a href=bulletin/readbulletin.php?id=$row[id]>".$row['anncontent']."</a></span>";	
	$out="function marquee1() \n";
	$out.="{ \n";
	$out.="document.write(\"<marquee behavior=scroll direction=l  scrollamount=3 scrolldelay=60 ";
	$out.="onmouseover='this.stop()' onmouseout='this.start()'>\") \n";
	$out.="} \n";
	$out.="function marquee2() \n";
	$out.="{ \n";
	$out.="document.write(\"</marquee>\") \n";
	$out.="} \n";
	$out.="document.writeln(\"<SCRIPT language=JavaScript>marquee1();</SCRIPT> \");\n";
	$out.="document.writeln(\"".$annstr."\");\n";
	$out.="document.writeln(\"<SCRIPT language=JavaScript>marquee2();</SCRIPT> \");\n";
	$rs = write_file($jsfile,$out); 
		if ($rs) {
				return true;
				} else {
				return false;
				}
		}
	}
#生成文章页TAG的JS的方法
	function make_articleTag_js($content,$sort=''){//sort暂时没用到
	global $db;
	$jsfile = "../js/arttag.js";
	$temp=$content;
	$jscontent=$temp;
	$result=$db->query("select * from kword order by id");	
	$out="function tagshowword(){};tagshowword.prototype.tagstr=\"";
	while($row=$db->getarray($result)){	
	$out.="(".$row['id'].")".$row['keyvalue']."|";
	}
	$out.="\";";
	/*echo "<script>alert('$out')</script>";
	exit();*/
	$rs = write_file($jsfile,$out); 
		if ($rs) {
				return true;
				} else {
				return false;
				}
		}
		
//生成用添加分类用的下拉列表JS V1 没有rootid的方法
	function make_catelog_Dropdownlist_js(){
	global $db;
	$jsfile="../js/catelog_Dropdownlist.js";
	$sql='select * from article where grade=1';
	$result=$db->query($sql);
	//循环输出out开始
	while($row=$db->getarray($result)){//最外层,就是指根栏目
	
	$out.="document.writeln('<option value=$row[0]>$row[1]</option>');";
	$sql2="select * from article where superior='$row[0]'";	
	$result2=$db->query($sql2);
		while($row2=$db->getarray($result2)){//第二层，就是二级栏目，依此类推
		$out.="document.writeln('<option value=$row2[0]>&nbsp;&nbsp;&nbsp;&nbsp;$row2[1]</option>');";
		$sql3="select * from article where superior='$row2[0]'";	
		$result3=$db->query($sql3);
			while($row3=$db->getarray($result3)){//第三层
			$out.="document.writeln('<option value=$row3[0]>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row3[1]</option>');";
			$sql4="select * from article where superior='$row3[0]'";
				$result4=$db->query($sql4);
				while($row4=$db->getarray($result4)){//第四层
				$out.="document.writeln('<option value=$row4[0]>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row4[1]</option>');";
				$sql5="select * from article where superior='$row4[0]'";
					$result5=$db->query($sql5);
					while($row5=$db->getarray($result5)){//第五层
					$out.="document.writeln('<option value=$row5[0]>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row5[1]</option>');";
					}
				}
			}
		}
	}
	//循环输出out结束
	//global $out;
	//die($out);
	/*echo "<script>alert('".$out."')</script>";*/
	//生成开始
	$rs = write_file($jsfile,$out); 
		if ($rs) {
		
				return true;
				} else {
				return false;
				}
		}
	//生成结束

//生成用添加分类用的下拉列表JS V2 有个rootid,用'/'撇开给添加文章用
	function make_catelog_Dropdownlist_js2(){
	global $db;
	$jsfile="../js/catelog_Dropdownlist_article.js";
	$sql='select * from article where grade=1';
	$result=$db->query($sql);
	//循环输出out开始
	while($row=$db->getarray($result)){//最外层,就是指根栏目
	
	$out.="document.writeln('<option value=$row[0]/$row[5]>$row[1]</option>');";
	$sql2="select * from article where superior='$row[0]'";	
	$result2=$db->query($sql2);
		while($row2=$db->getarray($result2)){//第二层，就是二级栏目，依此类推
		$out.="document.writeln('<option value=$row2[0]/$row2[5]>&nbsp;&nbsp;&nbsp;&nbsp;$row2[1]</option>');";
		$sql3="select * from article where superior='$row2[0]'";	
		$result3=$db->query($sql3);
			while($row3=$db->getarray($result3)){//第三层
			$out.="document.writeln('<option value=$row3[0]/$row3[5]>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row3[1]</option>');";
			$sql4="select * from article where superior='$row3[0]'";
				$result4=$db->query($sql4);
				while($row4=$db->getarray($result4)){//第四层
				$out.="document.writeln('<option value=$row4[0]/$row4[5]>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row4[1]</option>');";
				$sql5="select * from article where superior='$row4[0]'";
					$result5=$db->query($sql5);
					while($row5=$db->getarray($result5)){//第五层
					$out.="document.writeln('<option value=$row5[0]/$row5[5]>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row5[1]</option>');";
					}
				}
			}
		}
	}
	//循环输出out结束
	//global $out;
	//die($out);
	/*echo "<script>alert('".$out."')</script>";*/
	//生成开始
	$rs = write_file($jsfile,$out); 
		if ($rs) {
		
				return true;
				} else {
				return false;
				}
		}
	//生成结束	
}
?>
