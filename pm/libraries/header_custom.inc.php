<?php
/* $Id: header_custom.inc.php,v 1.1.1.1 2007/08/16 08:30:12 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

// This file includes all custom headers if they exist.

// Include site header
if (file_exists('./config.header.inc.php')) {
    require('./config.header.inc.php');
}
?>
