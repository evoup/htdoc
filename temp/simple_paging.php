<?php
//Ϊ�˱������͸����Ӧ�õ�������ȥ��������MS SQL Server��NorthWind���ݿ�Customers��Ϊ���� 
$page=$_GET["page"];
//-p$page=2;
echo "page��$page";
$pageSize= 4; //ÿҳ��ʾ�ļ�¼�� 

//�������ݿ� 
$conn=mysql_connect("localhost","root","getter");

//ѡ�����ݿ⣬Ϊ�˷��㣬������MSSQL Server��pubs���ݿ�Ϊ�� 
$db=mysql_select_db("lz",$conn) or die("�޷��������ݿ⣡"); 


$sql="SELECT * FROM lz"; 

//ִ�в�ѯ��� 
$res = mysql_query($sql) or die("�޷�ִ��SQL��$sql"); 

//$page������ʾ��ǰ��ʾ��ҳ 
if(!isset($page)) $page=1; 
if($page==0) $page=1; 

//�õ���ǰ��ѯ���ļ�¼�� $totalNum 
$totalNum= mysql_num_rows($res);
if($totalNum<=0)
{ 
echo "<p align=center>û�м�¼"; 
exit; 
} 

//�õ����ҳ����maxPage 
$maxPage = (int)ceil($totalNum/$pageSize); 

if((int)$page > $maxPage) 
$page=$maxPage; 

?> 
<table align="center" width="90%" border="1" cellspacing="2" cellpadding="2"> 
<tr bgcolor="#F7F2ff"> 
<?php 
//��ʾ���ͷ 
for($i = 0; $i < mysql_num_fields($res); $i++) 
{ 
echo "<td>".mysql_field_name($res,$i)."</td>" ; 
} 
?> 
<?php echo "</tr>";?> 
<?php
//����ƫ����($page - 1)*$pageSize,����mysql_data_seek�����õ�Ҫ��ʾ��ҳ�� 
if(mysql_data_seek($res,($page-1)*$pageSize) ) 
{ 
$i=0; 
//ѭ����ʾ��ǰ��¼�� 
for($i;$i< $pageSize;$i++){ 
echo "<tr>"; 

//�õ���ǰ��¼����䵽����$row; 
$row= mysql_fetch_row($res); 
if($row) 
{ 
//ѭ����ʾ��ǰ��¼�������ֶ�ֵ 
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
//��ʽ: [��ҳ] [��ҳ] [��ҳ] [ĩҳ] 
case "1": 
{ 
$out = "<div align=center>"; 
echo "[��".$maxPage."ҳ]  [��".$page."ҳ]  "; 

//��ҳ����ҳ������ 
if( $totalNum>1 && $page>1) 
{ 
$prevPage=$page-1; 
echo "<a href=$PHP_SELF?page=1>[��ҳ]</a>"; 
echo "<a href=$PHP_SELF?page=$prevPage >[��ҳ]</a>  "; 
} 

//��ҳ��ĩҳ������ 
if( $page>=1 && $page< $maxPage) 
{ 
$nextPage= $page+1; 
echo " <a href=$PHP_SELF?page=$nextPage >[��ҳ]</a>  "; 
echo " <a href=$PHP_SELF?page=$maxPage>[ĩҳ]</a>"; 
} 
echo "</div>"; 
echo $out; 
} 
break; 

//��ʽ: 1 2 3 4 5 
case "2": 
{ 
$linkNum = "4";//ҳ������ʾ���ӵĸ�����ʾ 
$out = "<div align=center>�� "; 
$start = ($page-round($linkNum/2))>0 ? ($page-round($linkNum/2)) : "1"; 
$end = ($page+round($linkNum/2))< $maxPage ? ($page+round($linkNum/2)) : $maxPage; 
if($page<>1) 
echo "<a href='?page=1' alt='��ҳ'>1</a>  < <"; 
//for($t=1;$t< =$maxPage;$t++) 
for($t=$start;$t<=$end;$t++) 
{ 
echo ($page==$t) ? "<font color='red'><b>".$t."</b></font>  " : "<a href='?page=$t'>$t</a>  "; 
} 
if($page<>$maxPage) 
echo  ">>  <a href='?page=$maxPage' alt='ĩҳ'>$maxPage</a>"; 
echo " ҳ</div>"; 
echo $out; 
} 
break; 

//select������ֱ����ת 
case "3": 
{ 
$out = "<div align=center>"; 
echo "�� <select onchange=\"location='?page='+this.options[this.selectedIndex].value\">"; 
for($i=1; $i<=$maxPage; $i++) { 
echo "<option value='$i'".(($i==$page) ? ' selected' : '').">$i</option>"; 
} 
echo "</select> ҳ"; 
echo "</div>"; 

} 
break; 
default: 
echo ""; 
break; 
} 

?> 
