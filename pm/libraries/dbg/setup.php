<?php
/* $Id: setup.php,v 1.1.1.1 2007/08/16 08:30:14 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:
/**
 * checks for DBG extension and trys to load if not loaded
 * 
 * allways use $GLOBALS here, as this script is included by footer.inc.hp
 * which can also be included from inside a function
 */
if ( $GLOBALS['cfg']['DBG']['enable'] ) {
    /**
     * Loads the DBG extension if needed
     */
    if ( ! @extension_loaded('dbg') && ! PMA_dl('dbg') ) {
        echo '<div class="warning">'
            .sprintf( $GLOBALS['strCantLoad'], 'DBG' )
            .' <a href="./Documentation.html#faqdbg" target="documentation">' 
            .$GLOBALS['strDocu'] . '</a>'
            .'</div>';
    } else {
        $GLOBALS['DBG'] = true;
    }
}
?>