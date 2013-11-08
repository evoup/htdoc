<?php
// $Id: modulesadmin.php,v 1.1 2008/02/28 12:17:36 cvs Exp $
//%%%%%%	File Name  modulesadmin.php 	%%%%%
define("_MD_AM_MODADMIN","模块管理");
define("_MD_AM_MODULE","模块名称");
define("_MD_AM_VERSION","版本");
define("_MD_AM_LASTUP","最近更新");
define("_MD_AM_DEACTIVATED","已停用");
define("_MD_AM_ACTION","操作");
define("_MD_AM_DEACTIVATE","停止使用");
define("_MD_AM_ACTIVATE","启动");
define("_MD_AM_UPDATE","更新");
define("_MD_AM_DUPEN","数据库的模块表中有重复条目！");
define("_MD_AM_DEACTED","此模块已被停用。您现在可以安全地卸载这个模块。");
define("_MD_AM_ACTED","当前模块已启动。");
define("_MD_AM_UPDTED","当前模块已更新。");
define("_MD_AM_SYSNO","不能停用系统模块。");
define("_MD_AM_STRTNO","此模块目前被设定为网站默认的启动页面。请编辑系统的偏好设置。");

// added in RC2
define("_MD_AM_PCMFM","请确认：");

// added in RC3
define("_MD_AM_ORDER","排序");
define("_MD_AM_ORDER0","（0 = 不在导航菜单中出现）");
define("_MD_AM_ACTIVE","激活");
define("_MD_AM_INACTIVE","未激活");
define("_MD_AM_NOTINSTALLED","没有安装");
define("_MD_AM_NOCHANGE","没有改变");
define("_MD_AM_INSTALL","安装");
define("_MD_AM_UNINSTALL","卸载");
define("_MD_AM_SUBMIT","提交");
define("_MD_AM_CANCEL","取消");
define("_MD_AM_DBUPDATE","数据库更新成功!");
define("_MD_AM_BTOMADMIN","回到模块管理页面");

// %s represents module name
define("_MD_AM_FAILINS","无法安装 %s。");
define("_MD_AM_FAILACT","无法启动 %s。");
define("_MD_AM_FAILDEACT","无法停用 %s。");
define("_MD_AM_FAILUPD","无法更新 %s。");
define("_MD_AM_FAILUNINS","无法卸载 %s。");
define("_MD_AM_FAILORDER","无法重排 %s.");
define("_MD_AM_FAILWRITE","无法写入信息到导航菜单");
define("_MD_AM_ALEXISTS","模块 %s 已存在。");
define("_MD_AM_ERRORSC","错误：");
define("_MD_AM_OKINS","模块 %s 安装成功。");
define("_MD_AM_OKACT","模块 %s 启动成功。");
define("_MD_AM_OKDEACT","模块 %s 已解除启动状态。可以卸载。");
define("_MD_AM_OKUPD","模块 %s 更新成功。");
define("_MD_AM_OKUNINS","模块 %s 卸载成功。");
define("_MD_AM_OKORDER","模块 %s 修改成功。");

define('_MD_AM_RUSUREINS', '点击按钮安装此模块');
define('_MD_AM_RUSUREUPD', '点击按钮升级此模块');
define('_MD_AM_RUSUREUNINS', '您确定要卸载此模块？');
define('_MD_AM_LISTUPBLKS', '以下区块将一起更新。<br />选择要更新的区块内容(格式)将一起更新。<br />');
define('_MD_AM_NEWBLKS', '新区块');
define('_MD_AM_DEPREBLKS', '不更新区块');
?>