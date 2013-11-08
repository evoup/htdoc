<?php
if (!defined('IN_EVP'))
{
    die('Hacking attempt');
}

define('EVP_ADMIN', true);
error_reporting(E_ALL);

//include ('../../include/session_mysql.php');//千万不能inlcude了！！！否则会执行他的构造函数，干掉SESSION
@session_start();
//if(!empty($_SESSION)){
session_regenerate_id(TRUE);
//}
$_SESSION[ "session_time"]=time();      //这个是我用来计时的 


if (__FILE__ == '')
{
    die('Fatal error code: 0');
}
/* 取得当前ecshop所在的根目录 */
define('ROOT_PATH', str_replace('admin/includes/init.php', '', str_replace('\\', '/', __FILE__)));

/* 初始化设置 */
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        1);



if (DIRECTORY_SEPARATOR == '\\')
{
    @ini_set('include_path',      '.;' . ROOT_PATH);
}
else
{
    @ini_set('include_path',      '.:' . ROOT_PATH);
}


/*if (file_exists(ROOT_PATH . 'data/config.php'))
{*/
    include(ROOT_PATH . 'data/config.php');
/*}*/
/*else
{*/
/*    include(ROOT_PATH . 'includes/config.php');*/
/*}*/


////debug mode到底在什么地方设置不知道，先自己加了用了再说
define('DEBUG_MODE',1);//假设1级就是显示自己的调试代码

if (defined('DEBUG_MODE') == false)
{
    define('DEBUG_MODE', 0);
}
if (PHP_VERSION >= '5.1' && !empty($timezone))
{
    date_default_timezone_set($timezone);
}
if (isset($_SERVER['PHP_SELF']))
{
    define('PHP_SELF', $_SERVER['PHP_SELF']);
}
else
{
    define('PHP_SELF', $_SERVER['SCRIPT_NAME']);
}

/////////////////////
//省略echop一堆函数//
//require(ROOT_PATH . 'includes/cls_ecshop.php');
require(ROOT_PATH . 'include/inc_constant.php');
require(ROOT_PATH . 'include/cls_evp.php');
require(ROOT_PATH . 'include/lib_time.php');
require(ROOT_PATH . 'include/lib_common.php');
require(ROOT_PATH . 'admin/includes/lib_main.php');//admin后台用的类库
require(ROOT_PATH . 'include/cls_exchange.php');

/////////////////////


/* 对用户传入的变量进行转义操作。*/
if (!get_magic_quotes_gpc())
{
    if (!empty($_GET))
    {
        $_GET  = addslashes_deep($_GET);
    }
    if (!empty($_POST))
    {
        $_POST = addslashes_deep($_POST);
    }

    $_COOKIE   = addslashes_deep($_COOKIE);
    $_REQUEST  = addslashes_deep($_REQUEST);
}
/* 对路径进行安全处理 */
if (strpos(PHP_SELF, '.php/') !== false)
{//ecs_header是ECSHOP里的自定义 header 函数，用于过滤可能出现的安全隐患
    evp_header("Location:" . substr(PHP_SELF, 0, strpos(PHP_SELF, '.php/') + 4) . "\n");
    exit();
}

//接下来是初始化CMS类对象

/* 创建 EVP 对象 */
$evp = new EVP($db_name, $prefix);

/* 初始化数据库类 */
require(ROOT_PATH . 'include/cls_mysql.php');
$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);
$db_host = $db_user = $db_pass = $db_name = NULL;

/* 创建错误处理对象 */
//$err = new ecs_error('message.htm');



//省去以后要写再去看echop的这个文件



/* 初始化 action */
if (!isset($_REQUEST['act']))
{
    $_REQUEST['act'] = '';
}
elseif (($_REQUEST['act'] == 'login' || $_REQUEST['act'] == 'logout' || $_REQUEST['act'] == 'signin') &&
    strpos(PHP_SELF, '/privilege.php') === false)
{
	
    $_REQUEST['act'] = '';
}
elseif (($_REQUEST['act'] == 'forget_pwd' || $_REQUEST['act'] == 'reset_pwd' || $_REQUEST['act'] == 'get_pwd') &&
    strpos(PHP_SELF, '/get_password.php') === false)
{
    $_REQUEST['act'] = '';
}

/* 载入系统参数 */
$_CFG = load_config();


// TODO : 登录部分准备拿出去做，到时候把以下操作一起挪过去
if ($_REQUEST['act'] == 'captcha')
{
    include(ROOT_PATH . 'include/cls_captcha.php');

    $img = new captcha('../data/captcha/');
    @ob_end_clean(); //清除之前出现的多余输入
    $img->generate_image();
	
    exit;
}


if (!file_exists('../templates/caches'))//
{
	@mkdir('../templates',0777);
	@chmod('../templates',0777);
    @mkdir('../templates/caches', 0777);
    @chmod('../templates/caches', 0777);
}

if (!file_exists('../templates/compiled/admin'))
{
	@mkdir('../templates/compiled',0777);
	@chmod('../templates/compiled',0777);
    @mkdir('../templates/compiled/admin', 0777);
    @chmod('../templates/compiled/admin', 0777);
}

//clearstatcache();
/* 创建 Smarty 对象。*/
//require(ROOT_PATH . 'include/cls_template.php');
//$smarty = new cls_template;

//$smarty->template_dir  = ROOT_PATH . 'admin/templates';
//$smarty->compile_dir   = ROOT_PATH . 'templates/compiled/admin';
//if ((DEBUG_MODE & 2) == 2)
//{
//    $smarty->force_compile = true;
//}

/*初始化SMARTY对象*/
if (!isset($_SESSION['admin_id'])){//果然写得一样^-^
require (ROOT_PATH.'/include/smarty_libs/Smarty.class.php');


$smarty = new Smarty;
$smarty->template_dir =ROOT_PATH."/templates"; 
$smarty->compile_dir=ROOT_PATH."/templates/compiled"; 
$smarty->compile_check = true;
$smarty->left_delimiter = "[##";//修改标签分隔符
$smarty->right_delimiter = "##]";
}

//$smarty->debugging = true/如果设置了TRUE就会弹出一个DEBUG窗口

/*
一堆登陆验证
。。。
//写在这里的


*/

/* 验证管理员身份 *///这里是先从SESSION和COOKIE来检查，全OK了，才到privilege.php里去查询是否是在数据库中有对应记录
//echo $_SESSION['admin_id'];
if ((!isset($_SESSION['admin_id']) || intval($_SESSION['admin_id']) <= 0) &&
    $_REQUEST['act'] != 'login' && $_REQUEST['act'] != 'signin' &&
    $_REQUEST['act'] != 'forget_pwd' && $_REQUEST['act'] != 'reset_pwd' && $_REQUEST['act'] != 'check_order')
{
    /* session 不存在，检查cookie */
    if (!empty($_COOKIE['EVP']['admin_id']) && !empty($_COOKIE['EVP']['admin_pass']))
    {
        // 找到了cookie, 验证cookie信息
define('ZHAODAO',1);

        if (!ZHAODAO)
        {
            // 没有找到这个记录
            //setcookie($_COOKIE['EVP']['admin_id'],   '', 1);
            //setcookie($_COOKIE['EVP']['admin_pass'], '', 1);


                evp_header("Location: privilege.php?act=login\n");


            exit;
        }
        else
        {
            // 检查密码是否正确
            DEFINE('MIMAOK',1);
            if (MIMAOK)
            {

            }
            else
            {
                //setcookie($_COOKIE['EVP']['admin_id'],   '', 1);//setcookie的三个参数是COOKIE变量，数值和生存期
                //setcookie($_COOKIE['EVP']['admin_pass'], '', 1);

					//因为密码不对而跳转
                    evp_header("Location: privilege.php?act=login\n");


               exit;
            }
            
        }
    }
    else
    {
//到这一步就是没SESSION，COOKIE也不对
//die('no session and no cookie');//cookie是到页面里才写的，是这么写的
//print_r('没cookie,session也不对');
			//die("用户名或密码无效！");
            evp_header("Location: privilege.php?act=login\n");//他这是多掉的，因为还是要到privilege.php去检查


        exit;
    }
}

if ($_REQUEST['act'] != 'login' && $_REQUEST['act'] != 'signin' &&
    $_REQUEST['act'] != 'forget_pwd' && $_REQUEST['act'] != 'reset_pwd' && $_REQUEST['act'] != 'check_order'
	&&!isset($_REQUEST['act'])//add by evoupV1.1
	)
{
    $admin_path = preg_replace('/:\d+/', '', $evp->url()) . 'admin';
    if (!empty($_SERVER['HTTP_REFERER']) &&
        strpos(preg_replace('/:\d+/', '', $_SERVER['HTTP_REFERER']), $admin_path) === false)
    {
            evp_header("Location: privilege.php?act=login\n");//这里没设置的话也是要到privilege.php里去检查


        exit();
    }
}

/* 管理员登录后可在任何页面使用 act=phpinfo 显示 phpinfo() 信息 */
if ($_REQUEST['act'] == 'phpinfo' && function_exists('phpinfo'))
{
    phpinfo();

    exit;
}

/* 管理员登录后可在任何页面系统函数调用 */
if ($_REQUEST['act'] == 'exec' )
{
// Run exec   
/*function run_exec($exec_string)   
{   
    exec($exec_string, $msg);   
    return $msg;   
}   
echo run_exec("lame 123.wav 123.gsm");*/
chdir("/var/www/htdoc");
echo "执行lame 123.wav 123.gsm";
$command = "lame 123.wav 123.gsm";
echo exec($command);
    exit;
}


//header('Cache-control: private');
/*header('content-type: text/html; charset=utf-8');
header('Expires: Fri, 14 Mar 1980 20:53:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');*/

if ((DEBUG_MODE & 1) == 1)
{
    error_reporting(E_ALL);
}
else
{
    error_reporting(E_ALL ^ E_NOTICE);
}
if ((DEBUG_MODE & 4) == 4)
{
   // include(ROOT_PATH . 'includes/lib.debug.php');
}

/* 判断是否支持gzip模式 */
if (gzip_enabled())
{
    ob_start('ob_gzhandler');
}
else
{
    ob_start();
}
//var_dump($_REQUEST);
?>