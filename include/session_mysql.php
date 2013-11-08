<?php
/* ------------------------------------------------------------------------ 
* session_mysql.php 
* ------------------------------------------------------------------------ 
* PHP4 MySQL Session Handler 
* Version 1.00 
* by Ying Zhang (ying@zippydesign.com) 
* Last Modified: May 21 2000 
* 
* ------------------------------------------------------------------------ 
* TERMS OF USAGE: 
* ------------------------------------------------------------------------ 
* You are free to use this library in any way you want, no warranties are 
* expressed or implied. This works for me, but I don't guarantee that it 
* works for you, USE AT YOUR OWN RISK. 
* 
* While not required to do so, I would appreciate it if you would retain 
* this header information. If you make any modifications or improvements, 
* please send them via email to Ying Zhang <YING@ZIPPYDESIGN.COM>. 
* 
* ------------------------------------------------------------------------ 
* DESCRIPTION: 
* ------------------------------------------------------------------------ 
* This library tells the PHP4 session handler to write to a MySQL database 
* instead of creating individual files for each session. 
* 
* Create a new database in MySQL called "sessions" like so: 
* 
* CREATE TABLE sessions ( 
* sesskey char(32) not null, 
* expiry int(11) unsigned not null, 
* value text not null, 
* PRIMARY KEY (sesskey) 
* ); 
* 
* ------------------------------------------------------------------------ 
* INSTALLATION: 
* ------------------------------------------------------------------------ 
* Make sure you have MySQL support compiled into PHP4. Then copy this 
* script to a directory that is accessible by the rest of your PHP 
* scripts. 
*确信你的php4有mysql支持，然后把这个脚本拷贝到和你的php脚本有关的目录。 
* ------------------------------------------------------------------------ 
* USAGE:（使用方法） 
* ------------------------------------------------------------------------ 
* Include this file in your scripts before you call session_start(), you 
* don't have to do anything special after that. 
*包含这个文件到你要使用session的文件中，必须在调用session_start()之前，否则, 
*会很惨的，不要怪我没告诉你。 这样就不需要再做什么工作了,还和你以前用session的方法一样。 
*/ 

$SESS_DBHOST = "localhost"; /* database server hostname */ 
$SESS_DBNAME = "jyit"; /* database name */ 
$SESS_DBUSER = "root"; /* database user */ 
$SESS_DBPASS = "jysysadmin"; /* database password */ 

$SESS_DBH = ""; 
$SESS_LIFE = get_cfg_var("session.gc_maxlifetime"); 

function sess_open($save_path, $session_name) { 
global $SESS_DBHOST, $SESS_DBNAME, $SESS_DBUSER, $SESS_DBPASS, $SESS_DBH; 

if (! $SESS_DBH = mysql_pconnect($SESS_DBHOST, $SESS_DBUSER, $SESS_DBPASS)) 
	{ 
echo " Can't connect to $SESS_DBHOST as $SESS_DBUSER"; 
echo " MySQL Error: ", mysql_error(); 
die; 
} 
mysql_query("SET NAMES 'utf8'");//evoupV1.1解决乱码

if (! mysql_select_db($SESS_DBNAME, $SESS_DBH)) 
	{ echo " Unable to select database $SESS_DBNAME"; die; } 
return true; 
} 

function sess_close() 
	{ 
return true; 
} 

function sess_read($key) 
	{ 
global $SESS_DBH, $SESS_LIFE; 
$qry = "SELECT value FROM sessions WHERE sesskey = '$key' AND expiry > " . time(); 
$qid = mysql_query($qry, $SESS_DBH); 
if (list($value) = mysql_fetch_row($qid)) 
	{ 
return $value; 
} 

return false; 
} 

function sess_write($key, $val) 
	{ 
global $SESS_DBH, $SESS_LIFE; 
$expiry = time() + $SESS_LIFE; 
$value = addslashes($val); 
//$qry = "INSERT INTO sessions VALUES ('$key', $expiry, '$value')"; 
//把这句sql放这里可能比较危险,先
$lk=mysql_connect('localhost','root','jysysadmin');
mysql_select_db('jyit',$lk);
//$sqlz="select t1.*,t2.depname from login AS t1,department AS t2,usr AS t3 where t1.logname='$logname' and t1.pwd='$password' and t1.id=t3.id and t2.id=t3.department";
//echo $sqlz;
//$rs = mysql_query($sqlz, $lk); 
//$rowz = mysql_fetch_row($rs);
//echo "row2是".$rowz[2];
//$ss=$rowz[2];
$ss='as';
$ipaddr=getip();
$qry = "INSERT INTO sessions(sesskey,expiry,value,user,ip) VALUES ('$key', $expiry, '$value','$ss','$ipaddr')"; //evoupV1.1因为加了个user字段所以插入部分值,evoupV1.2因为发现了session2种不同原理,干脆开始就插入当前用户id
//报告link不对，做完修正
@$qid = mysql_query($qry, $SESS_DBH); 
if (! $qid) { 
$qry = "UPDATE sessions SET expiry = $expiry, value = '$value' WHERE sesskey = '$key' AND expiry > " . time(); 
@$qid = mysql_query($qry, $SESS_DBH); 
} 
return $qid; 
} 
function sess_destroy($key) { 
global $SESS_DBH; 
$qry = "DELETE FROM sessions WHERE sesskey = '$key'"; 
$qid = mysql_query($qry, $SESS_DBH); 
return $qid; 
} 
function sess_gc($maxlifetime) { 
global $SESS_DBH; 
$qry = "DELETE FROM sessions WHERE expiry < " . time(); 
$qid = mysql_query($qry, $SESS_DBH); 
return mysql_affected_rows($SESS_DBH); 
} 
session_set_save_handler( 
"sess_open", 
"sess_close", 
"sess_read", 
"sess_write", 
"sess_destroy", 
"sess_gc"); 







function getip() {
if (isset($_SERVER)) {
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
   $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
   $realip = $_SERVER['HTTP_CLIENT_IP'];
} else {
   $realip = $_SERVER['REMOTE_ADDR'];
}
} else {
if (getenv("HTTP_X_FORWARDED_FOR")) {
   $realip = getenv( "HTTP_X_FORWARDED_FOR");
} elseif (getenv("HTTP_CLIENT_IP")) {
   $realip = getenv("HTTP_CLIENT_IP");
} else {
   $realip = getenv("REMOTE_ADDR");
}
}
return $realip;
}
?>