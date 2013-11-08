<?php
/* $Id: footer_custom.inc.php,v 1.1.1.1 2007/08/16 08:30:12 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

// This file includes all custom footers if they exist.

// Include site footer
if (file_exists('./config.footer.inc.php')) {
    require('./config.footer.inc.php');
}
?>
