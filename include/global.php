<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
unregister_GLOBALS(); //When register_globals=On
@set_magic_quotes_runtime (0);
function unregister_GLOBALS() { //When register_globals = 'on'//from boblog2.1.0
	if (!ini_get('register_globals')) { //Already off
		return;
	}
	// Variables that shouldn't be unset
	$noUnset = array('_GET', '_POST',  '_COOKIE',  '_REQUEST', '_SERVER',  '_ENV',  '_FILES');
	$input = array_merge($_GET,  $_POST,	$_COOKIE, $_SERVER, $_ENV,  $_FILES,	isset($_SESSION) && is_array($_SESSION) ? $_SESSION : array());
	foreach ($input as $k => $v) {
		if ($k=='GLOBALS') {
			global $kgr;
			$kgr=0;
			kill_GLOBALS($input[$k]); //GLOBALS is recursive -,-
		}
		elseif (!in_array($k, $noUnset) && isset($GLOBALS[$k])) {
			$GLOBALS[$k]=NULL;
		}
	}
}

function kill_GLOBALS($input) { //Unregister $_REQUEST['GLOBALS'] like array recursively
	global $kgr;
	$kgr+=1;
	if ($kgr>10) die('Access Denied!');
	if (is_array($input)) {
		foreach ($input as $k => $v) {
			if ($k=='GLOBALS') kill_GLOBALS($input[$k]);
			$GLOBALS[$k]=NULL;
		}
	}
}
?>