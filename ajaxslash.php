<script language="JavaScript">
function GetResult()
{
/**--------------- 
GetResult() 
-----------------* 
GetResult() * 
����:ͨ��XMLHTTP��������,���ؽ��.* 
����:str,�ַ���,��������.*
ʵ��:GetResult();*---------------
GetResult() -----------------*/
var oBao = 
new ActiveXObject("Microsoft.XMLHTTP");
//�����ַ���+,%,&,=,?
�ȵĴ������취.�ַ�������escape�����.
//Update:2004-6-1 12:22oBao.open
("POST","Server.asp",false);oBao.send();
//�������˴����ص��Ǿ���escape
������ַ���.var 
strResult = unescape(oBao.responseText);
//���ַ����ֿ�.var arrResult = 
strResult.split("###");RemoveRow(); 
//ɾ����ǰ������.//��ȡ�õ��ַ����ֿ�,
��д������.for(var i=0;
i<arrResult.length;i++)
{
arrTmp = arrResult[i].split("@@@");
num1 = arrTmp[0]; 
//�ֶ�num1��ֵnum2 = arrTmp[1]; 
//�ֶ�num2��ֵrow1 = tb.insertRow();
cell1 = row1.insertCell();
cell1.innerText = num1;
cell2 = row1.insertCell();
cell2.innerText = num2;}
}function RemoveRow(){
//������һ�б�ͷ,�������ݾ�ɾ��
.var iRows = tb.rows.length;
for(var i=0;i<iRows-1;i++){tb.deleteRow(1);
}}function MyShow()
{
//2���Զ�ˢ��һ��,2��ȡ��һ������
.timer = window.setInterval
("GetResult()",2000);}
</script><body onload="MyShow()"
><p></p><table width="47%" 
height="23" border="0" 
cellpadding="1" cellspacing="0" 
id="tb"><tr><td>num1</td>
<td>num2</td></tr></table> 
Server.php ��̨��ȡ����
<?php
//�����ַ���+,%,&,=,?�ȵĴ������취.�ͻ����ַ��Ǿ���escape�����
//���Է���������Ҫ����unescape����.
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


?>{//һ����¼��"###"����.ÿ��������"@@@"����. ������ֻ�����������ݵ����.
sResult[sResult.length]= rs("num1").Value + "@@@" +rs("num2").Valuers.MoveNext();}
//escape�����XMLHTTP�����Ĵ��������.
Response.Write(escape(sResult.join("###")));