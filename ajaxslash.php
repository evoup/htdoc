<script language="JavaScript">
function GetResult()
{
/**--------------- 
GetResult() 
-----------------* 
GetResult() * 
功能:通过XMLHTTP发送请求,返回结果.* 
参数:str,字符串,发送条件.*
实例:GetResult();*---------------
GetResult() -----------------*/
var oBao = 
new ActiveXObject("Microsoft.XMLHTTP");
//特殊字符：+,%,&,=,?
等的传输解决办法.字符串先用escape编码的.
//Update:2004-6-1 12:22oBao.open
("POST","Server.asp",false);oBao.send();
//服务器端处理返回的是经过escape
编码的字符串.var 
strResult = unescape(oBao.responseText);
//将字符串分开.var arrResult = 
strResult.split("###");RemoveRow(); 
//删除以前的数据.//将取得的字符串分开,
并写入表格中.for(var i=0;
i<arrResult.length;i++)
{
arrTmp = arrResult[i].split("@@@");
num1 = arrTmp[0]; 
//字段num1的值num2 = arrTmp[1]; 
//字段num2的值row1 = tb.insertRow();
cell1 = row1.insertCell();
cell1.innerText = num1;
cell2 = row1.insertCell();
cell2.innerText = num2;}
}function RemoveRow(){
//保留第一行表头,其余数据均删除
.var iRows = tb.rows.length;
for(var i=0;i<iRows-1;i++){tb.deleteRow(1);
}}function MyShow()
{
//2秒自动刷新一次,2秒取得一次数据
.timer = window.setInterval
("GetResult()",2000);}
</script><body onload="MyShow()"
><p></p><table width="47%" 
height="23" border="0" 
cellpadding="1" cellspacing="0" 
id="tb"><tr><td>num1</td>
<td>num2</td></tr></table> 
Server.php 后台读取数据
<?php
//特殊字符：+,%,&,=,?等的传输解决办法.客户端字符是经过escape编码的
//所以服务器端先要经过unescape解码.
//Update:2004-6-1 12:22var sql = 
$link = mysql_connect('localhost','root','getter');
mysql_select_db('jzoa',$link);
$query="select num1,num2 from ajaxslash order by id";
$result=mysql_query($query);
while ($row=mysql_fetch_array($result))
//{echo $row[0];}
//echo 'breakok';
{

echo 'breakok';}


?>{//一条记录用"###"隔开.每列数据用"@@@"隔开. 这是以只有两个列数据的情况.
sResult[sResult.length]= rs("num1").Value + "@@@" +rs("num2").Valuers.MoveNext();}
//escape解决了XMLHTTP。中文处理的问题.
Response.Write(escape(sResult.join("###")));