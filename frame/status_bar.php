<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=gb2312"><title>状态</title>

<link rel="stylesheet" href="../css/css.css">

</head>
<?php
include('../include/UsersOnline3.php');
?>
<body class="statusbar" topmargin="0" leftmargin="0" background="callleftmenu_data/FF0088.gif" bgcolor=#999999 marginheight="0" marginwidth="0">


<table class="small" bordercolorlight="#1E75EA" bordercolordark="#0042AE" border="1" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr valign="top">
    <td align="center" width="90">
       <a href="#" onclick="javascript:show_online();" style="color: rgb(255, 255, 255); width: 100%; font-weight: bold;">
       共<?php
		
		//初始化类
$ol = new UsersOnline(false);

//get rid of the old records
$ol->refresh();

//who is at my site?

//这只是为了用addvisitor方法-_-!
//ADDING A USER, NO REPORTING
$ol = new UsersOnline(true);
$ol->printNumber("site");
?>人在线
       </a>
    </td>
    <td align="center" width="80">&nbsp;
       <span id="new_sms"></span>
    </td>
    <td title="点击返回我的桌面" style="" onclick="javascript:main_refresh();" align="center">
       <span style="color: rgb(255, 255, 255); width: 100%; font-weight: bold;">
Powered By <B>Evoup</B> Vesion1.0       </span>
    </td>
    <td align="center" width="80">&nbsp;
       <span id="new_leter"></span>
    </td>
    <td align="center" width="75">&nbsp;
       <a href="javascript:show_menu();" style="color: rgb(255, 255, 255); width: 100%; font-weight: bold;">菜单</a>
    </td>
  </tr>
</tbody></table>

<!-- <iframe name="ref_new_letter" src="status_bar_data/ref_new_letter.htm" height="0" width="0"></iframe> -->
<!-- <iframe name="ref_sms" src="status_bar_data/ref_sms.htm" height="1" width="1"></iframe> -->

</body></html>