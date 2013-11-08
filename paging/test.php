<?
	//create database test and run given sql file db.sql
	//connect your host
	mysql_connect("localhost",'root','getter');
	mysql_query("SET NAMES 'gbk'");
	//your database name
	mysql_select_db("jzoa");
	include("paging.php");
?>
<html>
<head>
<title>Test Paging</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
	$Obj=new Paging("select * from msg");
	$Obj->setLimit(10);
	$limit=$Obj->getLimit();
	$offset=$Obj->getOffset($_GET["page"]);
	//$Obj->setParameter("&name=Test&address=India");
	//set link css
	$Obj->setStyle("redheading");
	$Obj->setActiveStyle("smallheading");
	$Obj->setButtonStyle("boldcolor");
?>
<table border="1">
  <?
	$sql="select * from msg";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_array($rs)) {
?>
  <tr> 
    <td class="bodytext"> 
      <?=$row['title']?>
    </td>
  </tr>
  <?
	}
?>
</table>
<?
	//get page links
	$Obj->getPageNo();
?>
</body>
</html>