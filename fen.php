<?php
//为了便于理解和更快地应用到工作中去，我们以MS SQL Server的NorthWind数据库Customers表为例。 
$page=$_GET["page"];
//-p$page=2;
echo "page是$page";
$pageSize= 4; //每页显示的记录数 

//连接数据库 
$conn=mysql_connect("localhost","root","getter");

//选择数据库，为了方便，这里以MSSQL Server的pubs数据库为例 
$db=mysql_select_db("lz",$conn) or die("无法连接数据库！"); 


$sql="SELECT * FROM lz"; 

//执行查询语句 
$res = mysql_query($sql) or die("无法执行SQL：$sql"); 

//$page变量标示当前显示的页 
if(!isset($page)) $page=1; 
if($page==0) $page=1; 

//得到当前查询到的纪录数 $totalNum 
$totalNum= mysql_num_rows($res);
if($totalNum<=0)
{ 
echo "<p align=center>没有纪录"; 
exit; 
} 

//得到最大页码数maxPage 
$maxPage = (int)ceil($totalNum/$pageSize); 

if((int)$page > $maxPage) 
$page=$maxPage; 

?> 
<table align="center" width="90%" border="1" cellspacing="2" cellpadding="2"> 
<tr bgcolor="#F7F2ff"> 
<?php 
//显示表格头 
for($i = 0; $i < mysql_num_fields($res); $i++) 
{ 
echo "<td>".mysql_field_name($res,$i)."</td>" ; 
} 
?> 
<?php echo "</tr>";?> 
<?php
//根据偏移量($page - 1)*$pageSize,运用mysql_data_seek函数得到要显示的页面 
if(mysql_data_seek($res,($page-1)*$pageSize) ) 
{ 
$i=0; 
//循环显示当前纪录集 
for($i;$i< $pageSize;$i++){ 
echo "<tr>"; 

//得到当前纪录，填充到数组$row; 
$row= mysql_fetch_row($res); 
if($row) 
{ 
//循环显示当前纪录的所有字段值 
for($j = 0;$j <count($row);$j++) 
{ 
echo "<td>".$row[$j]."</td>"; 
} 
} 
echo "</tr>"; 
} 
} 
?> 
</table> 
<br> 
<hr size=1> 
<?php 
$style = "1"; 
switch($style) 
{ 
//格式: [首页] [上页] [下页] [末页] 
case "1": 
{ 
$out = "<div align=center>"; 
echo "[共".$maxPage."页]  [第".$page."页]  "; 

//首页和上页的链接 
if( $totalNum>1 && $page>1) 
{ 
$prevPage=$page-1; 
echo "<a href=$PHP_SELF?page=1>[首页]</a>"; 
echo "<a href=$PHP_SELF?page=$prevPage >[上页]</a>  "; 
} 

//下页和末页的链接 
if( $page>=1 && $page< $maxPage) 
{ 
$nextPage= $page+1; 
echo " <a href=$PHP_SELF?page=$nextPage >[下页]</a>  "; 
echo " <a href=$PHP_SELF?page=$maxPage>[末页]</a>"; 
} 
echo "</div>"; 
echo $out; 
} 
break; 

//格式: 1 2 3 4 5 
case "2": 
{ 
$linkNum = "4";//页面上显示连接的个数显示 
$out = "<div align=center>第 "; 
$start = ($page-round($linkNum/2))>0 ? ($page-round($linkNum/2)) : "1"; 
$end = ($page+round($linkNum/2))< $maxPage ? ($page+round($linkNum/2)) : $maxPage; 
if($page<>1) 
echo "<a href='?page=1' alt='首页'>1</a>  < <"; 
//for($t=1;$t< =$maxPage;$t++) 
for($t=$start;$t<=$end;$t++) 
{ 
echo ($page==$t) ? "<font color='red'><b>".$t."</b></font>  " : "<a href='?page=$t'>$t</a>  "; 
} 
if($page<>$maxPage) 
echo  ">>  <a href='?page=$maxPage' alt='末页'>$maxPage</a>"; 
echo " 页</div>"; 
echo $out; 
} 
break; 

//select下拉框直接跳转 
case "3": 
{ 
$out = "<div align=center>"; 
echo "第 <select onchange=\"location='?page='+this.options[this.selectedIndex].value\">"; 
for($i=1; $i<=$maxPage; $i++) { 
echo "<option value='$i'".(($i==$page) ? ' selected' : '').">$i</option>"; 
} 
echo "</select> 页"; 
echo "</div>"; 

} 
break; 
default: 
echo ""; 
break; 
} 

?> 
