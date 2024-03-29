<?php
/* $Id: tbl_import.php,v 1.1.1.1 2007/08/16 08:30:10 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

require_once('./libraries/common.lib.php');

/**
 * Gets tables informations and displays top links
 */
require_once('./libraries/tbl_properties_common.php');
$url_query .= '&amp;goto=tbl_import.php&amp;back=tbl_import.php';

require_once('./libraries/tbl_properties_table_info.inc.php');
/**
 * Displays top menu links
 */
require_once('./libraries/tbl_properties_links.inc.php');

$import_type = 'table';
require_once('./libraries/display_import.lib.php');

/**
 * Displays the footer
 */
require_once('./libraries/footer.inc.php');
?>

