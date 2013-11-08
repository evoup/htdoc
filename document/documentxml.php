<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<title>公文管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<script type="text/javascript" src="../js/static/xtree.js"></script>

<link type="text/css" rel="stylesheet" href="../css/xtree.css" />

<script language="javascript">
function debug(){
	atree.reload();
}

function getSel(){
	var astr = tree.getSelectIds();
	alert(astr);
}
</script>
</head>
<body style="background:#CCCCCC;font-size:9pt" >

<a href="xtree.rar">下载</a>
<p><button onclick="debug();">重新加载异步树</button> &nbsp;
<button onclick="getSel();">查看选择节点值</button>
<br><br>
异步加载带选择框的树:<br>

<div style="background:#EEEEEE;width:200px;height:250px;overflow:auto">
<script type="text/javascript">
var atree = new WebFXLoadTree("公文管理系统","../req/document_general.xml");
document.write(atree);
</script>
</div>
<!-- <hr> -->
<!-- 普通树:
<script  language="javascript">

	var tree = new WebFXTree('Root');
	tree.setBehavior('classic');
	var a = new WebFXTreeItem('ffff');
	tree.add(a);
	var b = new WebFXTreeItem('1.1');
	a.add(b);
	b.add(new WebFXTreeItem('1.1.1'));
	var f = new WebFXTreeItem('1.1.4');
	b.add(f);
	f.add(new WebFXTreeItem('1.1.4.1'));
	var c = new WebFXTreeItem('1.2');
	a.add(c);
	c.add(new WebFXTreeItem('1.5.1'));
	a.add(new WebFXTreeItem('1.3'));

	var d = new WebFXTreeItem('2');
	tree.add(d);
	var e = new WebFXTreeItem('2.1');
	d.add(e);
	e.add(new WebFXTreeItem('2.1.1'));
	d.add(new WebFXTreeItem('2.2'));
	d.add(new WebFXTreeItem('2.3'));
	document.write(tree);

</script>	
 -->


</body>
</html>
