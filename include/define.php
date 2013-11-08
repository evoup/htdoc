<?php
if (!defined('IN_EVP')){
    die('Hacking attempt');
}
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'jysysadmin');
	define('DB_NAME', 'jyit');
	define('SITENAME', '嘉定365');
	define('SITECOPYRIGHT','上海易普有限公司');
	define('IS_DEBUG','1');
	
	
	// Use persistent connection? (Yes=1 No=0)
	// Default is 'Yes'. Choose 'Yes' if you are unsure.
//	define('DB_PCONNECT', 0);

//	define('GROUP_ADMIN', '1');
//	define('GROUP_USERS', '2');
//	define('GROUP_ANONYMOUS', '3');

?>