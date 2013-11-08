<?php
/* $Id: phpinfo.php,v 1.1.1.1 2007/08/16 08:30:10 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:


/**
 * Gets core libraries and defines some variables
 */
define( 'PMA_MINIMUM_COMMON', true );
require_once('./libraries/common.lib.php');


/**
 * Displays PHP information
 */
if ( $GLOBALS['cfg']['ShowPhpInfo'] ) {
    phpinfo();
}
?>
