<?php
// $Id: install.php,v 1.1 2008/02/28 12:17:16 cvs Exp $
define("_INSTALL_L0","欢迎使用 XOOPS 安装向导，请按提示进行安装。");
define("_INSTALL_L70","请先设定您的 mainfile.php 文件属性为可读写：UNIX/LINUX 系统设定为 666、MacOS 系统设定为 777、WinOS 系统去掉只读属性。设定完成后请点击刷新按钮。");
//define("_INSTALL_L71","点击按钮进入安装程序。");
define("_INSTALL_L1","请使用文本编辑软件打开 mainfile.php 文件找到第31行代码：");
define("_INSTALL_L2","请将这一行改为：");
define("_INSTALL_L3","找到第35行将 %s 改为 %s");
define("_INSTALL_L4","好，请点击保存按钮，再重试一次。");
define("_INSTALL_L5","警告！");
define("_INSTALL_L6","检测到 mainfile.php 文件中第31行的 XOOPS_ROOT_PATH 与根路径信息不符，请更正。");
define("_INSTALL_L7","您的设置为：");
define("_INSTALL_L8","程序检测为：");
define("_INSTALL_L9","（在微软的MS平台上可能会出现这个错误信息，请忽略并点击继续安装。）");
define("_INSTALL_L10","请确认下列信息后继续。");
define("_INSTALL_L11","XOOPS 物理路径：");
define("_INSTALL_L12","XOOPS 访问网址：");
define("_INSTALL_L13","如果上述信息正确，请继续。");
define("_INSTALL_L14","继续");
define("_INSTALL_L15","请打开 mainfile.php 文件输入您的数据库设置信息。");
define("_INSTALL_L16","%s 是您的数据库主机名称。");
define("_INSTALL_L17","%s 是您的数据库用户名称。");
define("_INSTALL_L18","%s 是您的数据库帐号密码。");
define("_INSTALL_L19","%s 是要创建的数据库名称。");
define("_INSTALL_L20","%s 是您的数据表前缀名称。");
define("_INSTALL_L21","该数据库不存在");
define("_INSTALL_L22","由程序自动创建？");
define("_INSTALL_L23","是");
define("_INSTALL_L24","否");
define("_INSTALL_L25","安装程序检查 mainfile.php 设置如下，如果不正确请作修改。");
define("_INSTALL_L26","数据库设置");
define("_INSTALL_L51","数据库类型");
define("_INSTALL_L66","选择要使用的数据库类型");
define("_INSTALL_L27","数据库主机名称：");
define("_INSTALL_L67","如果不确定请使用'localhost'。");
define("_INSTALL_L28","数据库用户帐号：");
define("_INSTALL_L65","用户登录数据库主机并创建数据库的帐号。");
define("_INSTALL_L29","数据库名称：");
define("_INSTALL_L64","用于安装XOOPS的数据库名称，如果不存在，程序将自动创建。");
define("_INSTALL_L52","数据库用户密码：");
define("_INSTALL_L68","与数据库用户帐号对应的密码。");
define("_INSTALL_L30","数据表前缀：");
define("_INSTALL_L63","XOOPS 所有数据表的前缀，确省为 'xoops'，建议修改（纯字母+数字）。");
define("_INSTALL_L54","数据库持续连接：");
define("_INSTALL_L69","建议虚拟主机用户选择'否'。");
define("_INSTALL_L55","XOOPS 物理路径：");
define("_INSTALL_L59","XOOPS 根目录的绝对物理路径，结尾不要加'/'。");
define("_INSTALL_L56","XOOPS 虚拟路径(URL)：");
define("_INSTALL_L58","访问 XOOPS 网站的网址，结尾不要加'/'。");

define("_INSTALL_L31","无法创建数据库，请联系服务器管理员查询详细信息。");
define("_INSTALL_L32","网站安装成功");
define("_INSTALL_L33","请点击<a href='../index.php'><font size=18>这里</font></a>浏览您的网站首页。");
define("_INSTALL_L35","如果有任何错误，请访问<a href='http://xoops.sourceforge.net/'>XOOPS 官方英文站点</a>或<a href=\"http://xoops.org.cn/\">XOOPS 官方中文站点</a>");
define("_INSTALL_L36","请填写网站管理员信息");
define("_INSTALL_L37","网站管理员帐号：");
define("_INSTALL_L38","网站管理员邮件：");
define("_INSTALL_L39","网站管理员密码：");
define("_INSTALL_L74","确认管理员密码：");
define("_INSTALL_L40","创建数据表");
define("_INSTALL_L41","请返回上一页确认信息无误后再试。");
define("_INSTALL_L42","返回");
define("_INSTALL_L57","请输入%s");

// %s is database name
define("_INSTALL_L43","数据库 %s 创建成功！");

// %s is table name
define("_INSTALL_L44","无法创建 %s。");
define("_INSTALL_L45","数据表 %s 创建成功。");

define("_INSTALL_L46","为使默认模块顺利运行，请设定下列文件属性为可写：");
define("_INSTALL_L47","继续");

define("_INSTALL_L53","请确认下列信息：");

define("_INSTALL_L60","无法打开 mainfile.php 文件，请检查文件属性后重试。");
define("_INSTALL_L61","无法写入 mainfile.php 文件，请联系系统管理员。");
define("_INSTALL_L62","设置内容保存成功，请继续。");
define("_INSTALL_L72","下列目录属性必须为可读写：UNIX/LINUX 系统设定为 666、MacOS 系统设定为 777、WinOS 系统去掉只读属性。");
define("_INSTALL_L73","邮件格式无效。");

// add by haruki
define("_INSTALL_L80","XOOPS介绍");
define("_INSTALL_L81","文件属性检查");
define("_INSTALL_L82","文件与目录属性检查");
define("_INSTALL_L83","文件%s 属性为只读。");
define("_INSTALL_L84","文件%s 属性为可写。");
define("_INSTALL_L85","目录%s 属性为只读。");
define("_INSTALL_L86","目录%s 属性为可写。");
define("_INSTALL_L87","设置正确无误。");
define("_INSTALL_L89","基本设置");
define("_INSTALL_L90","基本设置");
define("_INSTALL_L91","确认");
define("_INSTALL_L92","保存设置");
define("_INSTALL_L93","修改设置");
define("_INSTALL_L88","保存基本设置");
define("_INSTALL_L94","检查路径和网址");
define("_INSTALL_L127","正在检查文件路径和网址设置...");
define("_INSTALL_L95","无法检测到XOOPS目录的物理路径。");
define("_INSTALL_L96","程序检测到您的物理路径(%s)与您的的设置不一致，请修正。");
define("_INSTALL_L97","<strong>物理路径</strong>正确。");

define("_INSTALL_L99","<strong>物理路径</strong>必须是一个目录。");
define("_INSTALL_L100","<strong>虚拟路径</strong>是有效网址。");
define("_INSTALL_L101","<strong>虚拟路径</strong>是无效网址。");
define("_INSTALL_L102","确认数据库设置");
define("_INSTALL_L103","返回首页重新开始");
define("_INSTALL_L104","检查数据库");
define("_INSTALL_L105","创建数据库");
define("_INSTALL_L106","无法连接到数据库服务器。");
define("_INSTALL_L107","请检查数据库服务器的设置。");
define("_INSTALL_L108","已经连接到数据库服务器。");
define("_INSTALL_L109","数据库 %s 不存在。");
define("_INSTALL_L110","数据库 %s 存在并已连接。");
define("_INSTALL_L111","数据库连接成功。<br />继续创建数据表。");
define("_INSTALL_L112","管理员设置");
define("_INSTALL_L113","数据表 %s 已删除。");
define("_INSTALL_L114","数据表创建失败。");
define("_INSTALL_L115","数据表已创建。");
define("_INSTALL_L116","保存数据");
define("_INSTALL_L117","完成");

define("_INSTALL_L118","数据表 %s 创建失败。");
define("_INSTALL_L119","%d 条数据保存到 %s。");
define("_INSTALL_L120","%d 条数据无法保存到 %s。");

define("_INSTALL_L121","%s 设置为 %s");
define("_INSTALL_L122","%s 设置失败。");

define("_INSTALL_L123","文件 %s 已保存到目录 /cache/。");
define("_INSTALL_L124","文件 %s 无法保存到目录 /cache/。");

define("_INSTALL_L125","文件 %s 已基于 %s 修改");
define("_INSTALL_L126","无法修改 %s");

define("_INSTALL_L130","安装向导在您的数据库中检测到 XOOPS 1.3.x 的数据表。<br />安装程序将更新您的数据库到 XOOPS2。");
define("_INSTALL_L131","XOOPS 相关数据表已存在。");
define("_INSTALL_L132","更新数据表");
define("_INSTALL_L133","数据表 %s 已更新。");
define("_INSTALL_L134","更新 %s 数据表失败。");
define("_INSTALL_L135","数据表更新失败。");
define("_INSTALL_L136","数据表已更新。");
define("_INSTALL_L137","更新模块");
define("_INSTALL_L138","更新评论");
define("_INSTALL_L139","更新头像");
define("_INSTALL_L140","更新表情图");
define("_INSTALL_L141","安装程序将更新您的模块兼容当前的 XOOPS2 版本。<br />请确定您已经将 XOOPS2 的所有文件上传到服务器中。<br />更新将由安装程序完成。");
define("_INSTALL_L142","正在更新模块...");
define("_INSTALL_L143","安装程序将更新您现有的配置数据到 XOOPS2。");
define("_INSTALL_L144","更新设置");
define("_INSTALL_L145","评论（ID：%s）已插入到数据库。");
define("_INSTALL_L146","无法将评论（ID：%s）插入到数据库。");
define("_INSTALL_L147","正在更新评论...");
define("_INSTALL_L148","更新完成。");
define("_INSTALL_L149","安装程序现在将更新评论留言到 XOOPS2。<br />请稍候。");
define("_INSTALL_L150","安装程序现在将更新表情图与会员等级图到 XOOPS2。<br />请稍候。");
define("_INSTALL_L151","安装程序现在将更新头像图片到 XOOPS2。<br />请稍候。");
define("_INSTALL_L155","正在更新表情图与会员等级图...");
define("_INSTALL_L156","正在更新头像图片...");
define("_INSTALL_L157","为每个群组类型选择预设会员群组");
define("_INSTALL_L158","原有群组");
define("_INSTALL_L159","网站管理员");
define("_INSTALL_L160","注册会员");
define("_INSTALL_L161","游客");
define("_INSTALL_L162","您必须为各群组设置权限。");
define("_INSTALL_L163","%s 数据表已删除。");
define("_INSTALL_L164","%s 数据表删除失败。");
define("_INSTALL_L165","网站维护中，请稍后访问。");

// %s is filename
define("_INSTALL_L152","无法打开 %s。");
define("_INSTALL_L153","无法更新 %s。");
define("_INSTALL_L154","%s 更新完成。");

define('_INSTALL_L128', '选择语言');
define('_INSTALL_L200', '刷新');


define('_INSTALL_CHARSET', 'UTF-8');

// Database character set for install, setting database character set
define('_INSTALL_DBCHARSET_INSTALL', 'utf8');
// Database collate for install, setting database collate
//define('_INSTALL_DBCOLLATION_INSTALL', 'utf8_general_ci');

// character set for database in regular connection, will be written to mainfile.php
define('_INSTALL_DBCHARSET', 'utf8');

/* A very tricky solution for handling language selection */
$GLOBALS["install_languages"] = array(
	"english"		=> "英语 English",
	"schinese"		=> "简体中文 GB2312",
	"schinese_utf8"	=> "简体中文 UTF-8",
	);
?>