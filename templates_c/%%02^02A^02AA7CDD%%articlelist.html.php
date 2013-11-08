<?php /* Smarty version 2.6.19, created on 2008-07-31 14:19:28
         compiled from skin9/articlelist.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cn"><head>
<title><?php echo $this->_tpl_vars['node']; ?>
_文章列表_<?php echo $this->_tpl_vars['SITENAME']; ?>
</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css"  href="<?php echo $this->_tpl_vars['site_dir']; ?>
css/gen2.css">
<link rel="stylesheet" type="text/css"  href="<?php echo $this->_tpl_vars['site_dir']; ?>
css/list.css">
<link rel="stylesheet" type="text/css"  href="<?php echo $this->_tpl_vars['site_dir']; ?>
css/footer.css" />
<style type="text/css">
<!--
#artcontent_i ul{MARGIN: 0 0 0 11px;
PADDING: 0px;
BORDER: medium none; /*不显示边框*/
LINE-HEIGHT: normal;
LIST-STYLE-TYPE: none;
}
#artcontent_i li{ list-style: none;
 width: 100%;
 border-bottom: 1px dotted #CCC;
 line-height: 31px;
 /*height: 31px;*/  }
#artcontent_i a {
color: #000000;
 display: block;
 padding: 0px 0px 0px 15px;
background: url(../image/dot.gif)
 no-repeat 0 7px;
}
#artcontent_i li span {
 float: right;/*使span元素浮动到右面*/
 text-align: right;/*日期右对齐*/
}
#artcontent_i li a:hover { color: #369;
 background: url(../image/dot2.gif) no-repeat 0 6px;} 
-->
</style>
</head><body class="www">
<!--UdmComment-->
 <div id="container">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'skin9/header.html', 'smarty_include_vars' => array('site_dir' => $this->_tpl_vars['site_dir'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--<div style="clear: both;"></div>-->

<!-- Main content -->
<div id="page">
<table style="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr valign="top">
		<td style="margin: 0px; width: 200px;" width="200">
	<!--UdmComment-->
	<div id="submenu" style="margin-top: 0px;">					
	</div> 
	<div id="submenu" style="margin-top: -2px;">	
	<div id="leftmenutd"><span>访问过的连接</span></div>
	<div id="leftmenuout"><div id="leftmenuin"><ul><!-- BEGIN list0 --><li><?php echo $this->_tpl_vars['lastb']; ?>
</li><!-- END list0 --></ul>
</div></div>
					
	</div>
	<div id="submenu" style="margin-top: -2px;">	
	<div id="leftmenutd"><span>新雇员须知</span></div>
	<div id="leftmenuout"><div id="leftmenuin"><ul><li><a href="readarticle.php?id=56">职工加班的有关规定</a></li><li><a href="readarticle.php?id=68">关于工、量具管理的规定</a></li><li><a href="readarticle.php?id=72">员工手册</a></li><li><a href="readarticle.php?id=150">计算机使用管理规定</a></li></ul>
</div></div>
	

<div id="submenu" style="margin-top: 0px;">	
	<div id="leftmenutd"><span>未登陆人员</span></div>
	<div id="leftmenuout"><div id="leftmenuin"><p>&nbsp;</p><p>张三(2天)</p><p>李四(54天)</p>
</div></div>		


		
					
	</div>	


	<div class="prpromo">
			
<div class="promo">
<a href="/awards/"></a></div>
	</div>
	
	</td> 
		<td style="padding: 4px; height: 230px;" height="230" width="556">		 
		<div class="mbanner" style="border: 1px solid rgb(187, 187, 187); padding: 0px; background: #ffffff url(/common/promo/fp_ent_launch-c3.png) no-repeat scroll -8px -4px; height: 230px; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
			
			<div style="margin: 0px 8px 0px 0px;"></div>
		    <div id="arrangement"><h3><?php echo $this->_tpl_vars['node']; ?>
-文章列表</h3><span></span></div>
<div id="artcontent_i"><ul>
<?php unset($this->_sections['article']);
$this->_sections['article']['name'] = 'article';
$this->_sections['article']['loop'] = is_array($_loop=$this->_tpl_vars['artid']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['article']['show'] = true;
$this->_sections['article']['max'] = $this->_sections['article']['loop'];
$this->_sections['article']['step'] = 1;
$this->_sections['article']['start'] = $this->_sections['article']['step'] > 0 ? 0 : $this->_sections['article']['loop']-1;
if ($this->_sections['article']['show']) {
    $this->_sections['article']['total'] = $this->_sections['article']['loop'];
    if ($this->_sections['article']['total'] == 0)
        $this->_sections['article']['show'] = false;
} else
    $this->_sections['article']['total'] = 0;
if ($this->_sections['article']['show']):

            for ($this->_sections['article']['index'] = $this->_sections['article']['start'], $this->_sections['article']['iteration'] = 1;
                 $this->_sections['article']['iteration'] <= $this->_sections['article']['total'];
                 $this->_sections['article']['index'] += $this->_sections['article']['step'], $this->_sections['article']['iteration']++):
$this->_sections['article']['rownum'] = $this->_sections['article']['iteration'];
$this->_sections['article']['index_prev'] = $this->_sections['article']['index'] - $this->_sections['article']['step'];
$this->_sections['article']['index_next'] = $this->_sections['article']['index'] + $this->_sections['article']['step'];
$this->_sections['article']['first']      = ($this->_sections['article']['iteration'] == 1);
$this->_sections['article']['last']       = ($this->_sections['article']['iteration'] == $this->_sections['article']['total']);
?>
<?php echo $this->_tpl_vars['artid'][$this->_sections['article']['index']]; ?>

<?php endfor; endif; ?></ul>
		</div>		


		</td>
		
		<td style="padding-top: 4px;background-color:#CCCCCC" width="240">
			
			<div style="padding: 4px 0px 10px; background: transparent url(/common/images/ent_comm_banner_bg-B.gif) no-repeat scroll 0%; float: right; width: 240px; height: 320px; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; margin-left: 10px;">
	<div style="padding-left: 10px;">
		<h2 class="mbanner"><a href="#"><!--稍后推出--></a></h2> 
		<div style="margin-right: 10px;" id="cal">
			
			<!-- <img src="template/skin7/img/calendar.gif" width="249" height="220" /> --><p></p>
			<p><img src="../../image/mrshhh_sky160_enews&amp;eware.jpg" width="160" height="240" /></p>
			<p><img src="../../image/hp_sky160.hd1220.jpg" width="160" height="240" /></p>
		</div>
		<br>
		<br>
	</div>
			</div><div style="text-align: center; padding-left: 8px;">
<a href="#"></a></div>
		</td>
	</tr>	
</tbody></table>
</div> </div> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'skin9/footer.html', 'smarty_include_vars' => array('site_dir' => $this->_tpl_vars['site_dir'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body></html>