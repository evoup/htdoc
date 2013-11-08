if (document.getElementById) {
	var tree = new WebFXTree('网络办公系统');
//	tree.setBehavior('classic');
tree.setBehavior('explorer');
tree.icon = '../image/mytable.gif';
	var rcgl = new WebFXTreeItem('日程管理');rcgl.icon = webFXTreeConfig.rcglIcon;
	tree.add(rcgl);
	var b = new WebFXTreeItem('公司行事录','../calendar/large.php');b.target = 'main'; // set target
	rcgl.add(b);
	var b1= new WebFXTreeItem('最近安排');
	rcgl.add(b1);
	var b2= new WebFXTreeItem('物品申领','../store/store.php');b2.target='main';
	rcgl.add(b2);
	var b3= new WebFXTreeItem('办公用品台账','../store/store.php');b3.target='main';
	rcgl.add(b3);

		
	var xzgl = new WebFXTreeItem('行政管理');xzgl.icon = webFXTreeConfig.xzglIcon;
	tree.add(xzgl);
	var d = new WebFXTreeItem('部门管理','../addlist/depman.php');d.target='main';
	xzgl.add(d);
	var d1 = new WebFXTreeItem('人员管理','../addlist/admin.php');d1.target='main';
	xzgl.add(d1);	
	var d2 = new WebFXTreeItem('人员照片','../addlist/ablum.php');d2.target='main';
	xzgl.add(d2);	
	var d3 = new WebFXTreeItem('生成JS','/admin/makejs/makedepusr_transfer.php');d3.target='main';
	xzgl.add(d3);	
var gwgl = new WebFXTreeItem('公文管理');gwgl.icon = webFXTreeConfig.gwglIcon;
	tree.add(gwgl);
	var e = new WebFXTreeItem('发文起草','../document/draft.php');e.target='main';
	gwgl.add(e);
	var e1 = new WebFXTreeItem('我的申请');
	gwgl.add(e1);	
	var e2 = new WebFXTreeItem('文件搜索');
	gwgl.add(e2);	
var grgj = new WebFXTreeItem('个人工具');grgj.icon = webFXTreeConfig.grgjIcon;
	tree.add(grgj);
	var f = new WebFXTreeItem('短消息','../messenge/dispatch.php?type=ubb');f.target='main';
	grgj.add(f);
	var f1 = new WebFXTreeItem('通讯录','../addlist/addlist.php');f1.target='main';
	grgj.add(f1);	
	var f2 = new WebFXTreeItem('修改密码','../addlist/changepwd.php');f2.target='main';
	grgj.add(f2);		




	document.write(tree);
}
