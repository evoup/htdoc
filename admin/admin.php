<?php
define('IN_EVP', true);
error_reporting(E_ALL   ^   E_NOTICE);
require_once("../include/global.php");//干掉全局变量
include ('../include/session_mysql.php');

//ob_start('ob_gzhandler');
//session_start();
//session_regenerate_id();//这里遇到问题，session超时了怎么办？http://hi.baidu.com/%CB%EF%D0%C2/blog/item/1a3348fb1e5bfc67034f5692.html
//To do add a overtime session_regenerate_id() function,or add time?

//die($_SESSION[admin_id]);
//$_SESSION['admin_id']='1';//现在关键就是适时的加入这个session变量,测试

//if (isset($_SESSION['admin_id']))
//{
/*	//检查超时开始(never worked!)
	//$timeout=1200;      //超时时间,单位:秒,这里设为20分钟. 
	$timeout=20;      //超时时间,单位:秒,这里设为20秒. 
	$now=time(); 
	if(($now-$_SESSION[ "session_time"]) > $timeout) 
	{ 
	     //超时了. 
	     foreach ($_SESSION as $key=>$value){
	     unset($_SESSION[$key]);
	     }
	     //session_regenerate_id();//如果超时就再设置一个新的ID
	     die(" <script>alert( \"超时了. \"); </script>"); 
	}else{ 
	     //还没超时. 
	     $_SESSION[ "session_time"]=time(); 
	}	
	//检查超时结束	*/
	
//如果登入了再加时间
//$_SESSION['session_time']=now();不需要加的，自己会加的

	
//	foreach ($_SESSION as $key=>$value)
//{
//echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
//}
//}

include_once(dirname(__FILE__) ."/../include/define.php");
require(dirname(__FILE__) . '/includes/init.php');

//if ((DEBUG_MODE & 2) != 2)//这行没效果的
//{
//    $smarty->caching = true;
//}
//include ("../include/define.php");
?>
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">-->
<HTML>
<HEAD>
<TITLE>网站后台管理 v1.0</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META content= name=Keywords>
<META content= name=description>
<LINK href="css/Skin2.css" 
type=text/css rel=stylesheet>
<SCRIPT language=JavaScript type=text/JavaScript>
//改变图片大小
function resizepic(thispic)
{
if(thispic.width>700) thispic.width=700;
}
//无级缩放图片大小
function bbimg(o)
{
if(!event.ctrlKey)return true;
var zoom=parseInt(o.style.zoom, 10)||100;zoom+=event.wheelDelta/12;if (zoom>0) o.style.zoom=zoom+'%';
return false;
}
//双击鼠标滚动屏幕的代码
var currentpos,timer;
function initialize()
{
timer=setInterval ("scrollwindow ()",30);
}
function sc()
{
clearInterval(timer);
}
function scrollwindow()
{
currentpos=document.body.scrollTop;
window.scroll(0,++currentpos);
if (currentpos !=document.body.scrollTop)
sc();
}
document.onmousedown=sc
document.ondblclick=initialize

//更改字体大小
var status0='';
var curfontsize=10;
var curlineheight=18;
function fontZoomA(){
  if(curfontsize>8){
    document.getElementById('fontzoom').style.fontSize=(--curfontsize)+'pt';
	document.getElementById('fontzoom').style.lineHeight=(--curlineheight)+'pt';
  }
}
function fontZoomB(){
  if(curfontsize<64){
    document.getElementById('fontzoom').style.fontSize=(++curfontsize)+'pt';
	document.getElementById('fontzoom').style.lineHeight=(++curlineheight)+'pt';
  }
}
</SCRIPT>
</HEAD>
<BODY leftMargin=0 topMargin=0>
<DIV align=center>
  <!-- ********网页顶部代码开始******** -->
  <TABLE height=33 cellSpacing=0 cellPadding=0 width="100%" border=0>
    <TBODY>
      <TR>
        <TD class=WEB_Distance></TD>
        <TD width=190><A title='<?php echo SITENAME;?>' href="admin_index.php" target="if"><IMG height=33 
      src="image/backstagelogo.gif" width=180 border=0></A></TD>
        <TD vAlign=bottom align=right height=33><FONT color=#ffffff>| <A 
      class=top_link_w href="javascript:void(0)"><FONT 
      color=#ffff00>控制面板</FONT></A> |帮助</FONT> </TD>
        <TD class=WEB_Distance></TD>
      </TR>
  </TABLE>
  <TABLE height=24 cellSpacing=0 cellPadding=0 width="100%" border=0>
    <TBODY>
      <TR>
        <TD class=WEB_Distance></TD>
        <TD align=middle width=191 bgColor=#000000><FONT 
      color=#ffffff><?php echo SITENAME."后台管理系统";?></FONT></TD>
        <TD class=top_Channel align=right>&nbsp;&nbsp;·&nbsp;<A class=Channel title="" 
      href="javascript:void(0)">option</A>&nbsp;·&nbsp;</TD>
        <TD class=WEB_Distance></TD>
      </TR>
    </TBODY>
  </TABLE>
  <!-- ********网页中部代码开始******** -->
  <TABLE class=center_tdbgall cellSpacing=0 cellPadding=0 width="100%" border=0 height=91%>
    <TBODY>
      <TR>
        <TD class=WEB_Distance width=13 rowSpan=5><DIV style="WIDTH: 13px"></DIV></TD>
        <TD class=WEB_left_all vAlign=top width=190 rowSpan=5><DIV id=aboutbox>
            <DL>
              <DT class=dt2 id=dt1 onclick=showsubmenu(1) onmouseover=showbg(1) 
        onmouseout=showoutbg(1)><strong><img src="image/copy_f2.png" width="22" height="22">&nbsp;&nbsp;&nbsp;栏目管理</strong>
              <DD id=submenu1>
                <UL>
                  <LI><A href="admin_class_edit.php?action=list" target="if">·栏目分类管理</A> </LI>
                </UL>
              </DD>
            </DL>
            <DL>
              <DT class=dt2 id=dt2 onmouseover=showbg(2) onclick=showsubmenu(2) 
        onmouseout=showoutbg(2)><img src="image/edit_f2.png"width='22' height="22">&nbsp;&nbsp;&nbsp;<B>文章管理</B>
              <DD id=submenu2>
                <UL>
                  <LI><A href="article.php?action=list" target="if">·文章管理</A></LI>
                  <LI><A href="article.php?action=add" target="if">·新加文章</A></LI>
                  <LI><A href="add_bulletin1.php" target="if">·公告管理</A></LI>
                  <LI><A href="#">·回收区</A></LI>
                </UL>
              </DD>
            </DL>
           <DL>
        <DT class=dt2 id=dt3 onmouseover=showbg(3) onclick=showsubmenu(3) 
        onmouseout=showoutbg(3)><img src="image/config.png" width="22"  height="22">&nbsp;&nbsp;&nbsp;<B>系统设置</B> 
        <DD id=submenu3>
        <UL>
          <LI><A 
          href="#">·敏感字符过滤</A></LI>
          <!--<LI><A 
          href="#">·上传限制</A></LI>-->
          <LI><A 
          href="#">·下载管理</A></LI>
          </UL></DD></DL>
            <DL>
        <DT class=dt2 id=dt4 onmouseover=showbg(4) onclick=showsubmenu(4) 
        onmouseout=showoutbg(4)><img src="image/user.png" width="22" height="22">&nbsp;&nbsp;&nbsp;<B>用户设置</B> 
        <DD id=submenu4>
        <UL>
          <LI><A href="user.php?action=list" target="if">·用户管理</A> 
          <LI><A href="admin_group_set.php" target="if">·组设置</A> 
          <LI><A href="#">·禁用用户区</A> 
		  <LI><A href="makejs/catelog.html" target='if'>·生成JS</A> 

          </LI></UL></DD></DL>
      <DL>
            <DT class=dt2 id=dt5 onmouseover=showbg(5) onclick=showsubmenu(5) 
        onmouseout=showoutbg(5)><img src="image/cpanel.png" width="22" height="22">&nbsp;&nbsp;&nbsp;<B>网站配置</B>
            <DD id=submenu5>
              <UL>
                <LI><A href="#">·关键字和作者</A> </LI>
              </UL>
            </DD>
            </DL>
            <DL>
              <DT class=dt2 id=dt6 onmouseover=showbg(6) onclick=showsubmenu(6) 
        onmouseout=showoutbg(6)><img src="image/backup.png" width="22" height="22">&nbsp;&nbsp;&nbsp;<B>数据管理</B>
              <DD id=submenu6>
                <UL>
                  <LI><A href="#">·数据导出</A></LI>
                  <LI><a href="admin.php?act=exec">·exec调用例子</a></LI>
                </UL>
              </DD>
            </DL>
            <DL>
              <DT class=dt2 id=dt7 onmouseover=showbg(7) onclick=showsubmenu(7) 
        onmouseout=showoutbg(7)><B><img src="image/back.png" width="22" height="22">&nbsp;&nbsp;&nbsp;<a href="../index.php" target="_BLANK">返回首页</a></B>
              <DD id=submenu7>
                <UL><li><a href="privilege.php?act=logout">·退&nbsp;&nbsp;出</a></B></li>
                </UL>
              </DD>
            </DL>
            <SCRIPT language=javascript1.2>
function showsubmenu(sid){
    whichEl = eval('submenu' + sid);
    if (whichEl.style.display == 'none'){
        eval("submenu" + sid + ".style.display='';");
        eval("dt" + sid + ".className='dt2';");
    }
    else{
        eval("submenu" + sid + ".style.display='none';");
        eval("dt" + sid + ".className='dt1';");
    }
}
function showbg(sid){
    whichEl = eval('submenu' + sid);
    if (whichEl.style.display == 'none'){
        eval("dt" + sid + ".className='dt4';");
    }
    else{
        eval("dt" + sid + ".className='dt3';");
    }
}
function showoutbg(sid){
    whichEl = eval('submenu' + sid);
    if (whichEl.style.display == 'none'){
        eval("dt" + sid + ".className='dt1';");
    }
    else{
        eval("dt" + sid + ".className='dt2';");
    }
}
</SCRIPT>
            <SCRIPT language=javascript1.2>
        eval("submenu" + 1 + ".style.display='';");
        eval("submenu" + 2 + ".style.display='';");
        eval("submenu" + 3 + ".style.display='';");
        eval("submenu" + 4 + ".style.display='';");
        eval("submenu" + 5 + ".style.display='';");
        eval("submenu" + 6 + ".style.display='';");
        eval("submenu" + 7 + ".style.display='';");

eval("dt2.className='dt2';");
eval("dt3.className='dt2';");
eval("dt4.className='dt2';");
eval("dt5.className='dt2';");
eval("dt6.className='dt2';");
eval("dt7.className='dt2';");
</SCRIPT>
          </DIV></TD>
        <TD width=7 rowSpan=5><DIV style="WIDTH: 7px"></DIV></TD>
        <TD vAlign=top><!--<TABLE class=top_Path style="WORD-BREAK: break-all" cellSpacing=0 
      cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD align=middle width="5%"><IMG 
            src="image/arrow3.gif" width="29" height="11"></TD>
          <TD>您现在的位置：&nbsp;<A class=LinkPath 
            href="#">内网管理</A>&nbsp;&gt;&gt;&nbsp;<A 
            class=LinkPath 
            href="#">栏目分类管理</A>&nbsp;</TD>
        </TR></TBODY></TABLE>-->
          <!--网页中部中栏文章栏目代码开始-->
          <!--网页中部中栏文章栏目代码结束-->
          <SCRIPT language=JavaScript> 
var tID=0;
function ShowTabs(ID){
  if(ID!=tID){
    TabTitle[tID].className='menu_soft_title1';
    TabTitle[ID].className='menu_soft_title2';
    Tabs[tID].style.display='none';
    Tabs[ID].style.display='';
    tID=ID;
  }
}
</SCRIPT>
          <TABLE 
      style="BORDER-TOP: #cccccc 2px solid; BACKGROUND: #f7f7f7; WORD-BREAK: break-all; PADDING-TOP: 8px" 
      cellSpacing=0 cellPadding=0 width="100%" border=0>
            <TBODY>
              <TR>
                <TD height=10></TD>
              </TR>
            </TBODY>
          </TABLE>
          <div>
            <iframe style="width:100%; border: solid 1px #CCCCCC" src="admin_index.php" height="520" name="if" id="if" frameborder="0" ></iframe>
          </div></TD>
        <TD width=7 rowSpan=5><DIV style="WIDTH: 7px"></DIV></TD>
        <TD class=WEB_Distance width=13 rowSpan=5><DIV style="WIDTH: 13px"></DIV></TD>
      </TR>
      <TR>
        <TD vAlign=bottom align=right><HR width="100%" color=#cccccc noShade SIZE=1>
          <TABLE height=24 cellSpacing=0 cellPadding=0 width="100%" border=0>
            <TBODY>
              <TR vAlign=top>
                <TD align=right><p ><?php echo SITECOPYRIGHT;?> 版权所有 &copy; 2006－2008&nbsp;&nbsp;designed by Evoup</TD>
              </TR>
            </TBODY>
          </TABLE></TD>
      </TR>
    </TBODY>
  </TABLE>
</DIV>
</BODY>
</HTML>
