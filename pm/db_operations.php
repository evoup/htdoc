<?php
/* $Id: db_operations.php,v 1.1.1.1 2007/08/16 08:30:10 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * handles miscellaneous db operations:
 *  - move/rename
 *  - copy
 *  - changing collation
 *  - changing comment
 *  - adding tables
 *  - viewing PDF schemas
 */

/**
 * requirements
 */
require_once('./libraries/common.lib.php');
require_once('./libraries/mysql_charsets.lib.php');

/**
 * Rename/move or copy database
 */
if (isset($db) &&
    ((isset($db_rename) && $db_rename == 'true') ||
    (isset($db_copy) && $db_copy == 'true'))) {

    require_once('./libraries/tbl_move_copy.php');

    if (isset($db_rename) && $db_rename == 'true') {
        $move = TRUE;
    } else {
        $move = FALSE;
    }

    if (!isset($newname) || !strlen($newname)) {
        $message = $strDatabaseEmpty;
    } else {
        if ($move ||
           (isset($create_database_before_copying) && $create_database_before_copying)) {
            $local_query = 'CREATE DATABASE ' . PMA_backquote($newname);
            if (isset($db_collation)) {
                $local_query .= ' DEFAULT' . PMA_generateCharsetQueryPart($db_collation);
            }
            $local_query .= ';';
            $sql_query = $local_query;
            PMA_DBI_query($local_query);
        }

        $tables_full = PMA_DBI_get_tables_full($db);
        foreach ($tables_full as $table => $tmp) {
            $back = $sql_query;
            $sql_query = '';

            // value of $what for this table only
            $this_what = $what;

            if (!isset($tables_full[$table]['Engine'])) {
                $tables_full[$table]['Engine'] = $tables_full[$table]['Type'];
            }
            // do not copy the data from a Merge table
            // note: on the calling FORM, 'data' means 'structure and data'
            if ($tables_full[$table]['Engine'] == 'MRG_MyISAM') {
                if ($this_what == 'data') {
                    $this_what = 'structure';
                }
                if ($this_what == 'dataonly') {
                    $this_what = 'nocopy';
                }
            }

            if ($this_what != 'nocopy') {
                PMA_table_move_copy($db, $table, $newname, $table,
                    isset($this_what) ? $this_what : 'data', $move);
            }

            $sql_query = $back . $sql_query;
        }
        unset($table);

        // Duplicate the bookmarks for this db (done once for each db)
        if ($db != $newname) {
            $get_fields = array('user', 'label', 'query');
            $where_fields = array('dbase' => $db);
            $new_fields = array('dbase' => $newname);
            PMA_duplicate_table_info('bookmarkwork', 'bookmark', $get_fields,
                $where_fields, $new_fields);
        }

        if ($move) {
            // cleanup pmadb stuff for this db
            require_once('./libraries/relation_cleanup.lib.php');
            PMA_relationsCleanupDatabase($db);

            $local_query = 'DROP DATABASE ' . PMA_backquote($db) . ';';
            $sql_query .= "\n" . $local_query;
            PMA_DBI_query($local_query);
            $message    = sprintf($strRenameDatabaseOK, htmlspecialchars($db),
                htmlspecialchars($newname));
        } else {
            $message    = sprintf($strCopyDatabaseOK, htmlspecialchars($db),
                htmlspecialchars($newname));
        }
        $reload     = TRUE;

        /* Change database to be used */
        if ($move) {
            $db         = $newname;
        } else {
            if (isset($switch_to_new) && $switch_to_new == 'true') {
                PMA_setCookie( 'pma_switch_to_new', 'true' );
                $db         = $newname;
            } else {
                PMA_setCookie( 'pma_switch_to_new', '' );
            }
        }
    }
}
/**
 * Settings for relations stuff
 */

require_once('./libraries/relation.lib.php');
$cfgRelation = PMA_getRelationsParam();

/**
 * Check if comments were updated
 * (must be done before displaying the menu tabs)
 */
if ($cfgRelation['commwork'] && isset($db_comment) && $db_comment == 'true') {
    PMA_SetComment($db, '', '(db_comment)', $comment);
}

/**
 * Prepares the tables list if the user where not redirected to this script
 * because there is no table in the database ($is_info is TRUE)
 */
if (empty($is_info)) {
    require('./libraries/db_details_common.inc.php');
    $url_query .= '&amp;goto=db_operations.php';

    // Gets the database structure
    $sub_part = '_structure';
    require('./libraries/db_details_db_info.inc.php');
    echo "\n";
}

if (PMA_MYSQL_INT_VERSION >= 40101) {
    $db_collation = PMA_getDbCollation($db);
}
if (PMA_MYSQL_INT_VERSION < 50002
  || (PMA_MYSQL_INT_VERSION >= 50002 && $db != 'information_schema')) {
    $is_information_schema = FALSE;
} else {
    $is_information_schema = TRUE;
}

if (!$is_information_schema) {

    require('./libraries/display_create_table.lib.php');

    if ($cfgRelation['commwork']) {
        /**
         * database comment
         */
        ?>
    <form method="post" action="db_operations.php">
    <?php echo PMA_generate_common_hidden_inputs($db); ?>
    <input type="hidden" name="db_comment" value="true" />
    <fieldset>
        <legend>
        <?php
        if ($cfg['PropertiesIconic']) {
            echo '<img class="icon" src="' . $pmaThemeImage . 'b_comment.png"'
                .' alt="" border="0" width="16" height="16" hspace="2" align="middle" />';
        }
        echo $strDBComment;
        $comment = PMA_getComments($db);
        ?>
        </legend>
        <input type="text" name="comment" class="textfield" size="30"
            value="<?php
            echo (isset($comment) && is_array($comment)
                ? htmlspecialchars(implode(' ', $comment))
                : ''); ?>" />
        <input type="submit" value="<?php echo $strGo; ?>" />
    </fieldset>
    </form>
        <?php
    }
    /**
     * rename database
     */
    ?>
    <form method="post" action="db_operations.php"
        onsubmit="return emptyFormElements(this, 'newname')">
    <input type="hidden" name="what" value="data" />
    <input type="hidden" name="db_rename" value="true" />
    <?php echo PMA_generate_common_hidden_inputs($db); ?>
    <fieldset>
        <legend>
    <?php
    if ($cfg['PropertiesIconic']) {
        echo '<img class="icon" src="' . $pmaThemeImage . 'b_edit.png"'
            .' alt="" width="16" height="16" />';
    }
    echo $strDBRename . ':';
    ?>
        </legend>
        <input type="text" name="newname" size="30" class="textfield" value="" />
        <input type="submit" value="<?php echo $strGo; ?>" />
    </fieldset>
    </form>

    <?php
    /**
     * Copy database
     */
    ?>
    <form method="post" action="db_operations.php"
        onsubmit="return emptyFormElements(this, 'newname')">
    <?php
    if (isset($db_collation)) {
        echo '<input type="hidden" name="db_collation" value="' . $db_collation
            .'" />' . "\n";
    }
    echo '<input type="hidden" name="db_copy" value="true" />' . "\n";
    echo PMA_generate_common_hidden_inputs($db);
    ?>
    <fieldset>
        <legend>
    <?php
    if ($cfg['PropertiesIconic']) {
        echo '<img class="icon" src="' . $pmaThemeImage . 'b_edit.png"'
            .' alt="" width="16" height="16" />';
    }
    echo $strDBCopy . ':';
    ?>
        </legend>
        <input type="text" name="newname" size="30" class="textfield" value="" /><br />
        <input type="radio" name="what" value="structure"
            id="radio_copy_structure" style="vertical-align: middle" />
        <label for="radio_copy_structure"><?php echo $strStrucOnly; ?></label><br />
        <input type="radio" name="what" value="data" id="radio_copy_data"
            checked="checked" style="vertical-align: middle" />
        <label for="radio_copy_data"><?php echo $strStrucData; ?></label><br />
        <input type="radio" name="what" value="dataonly"
            id="radio_copy_dataonly" style="vertical-align: middle" />
        <label for="radio_copy_dataonly"><?php echo $strDataOnly; ?></label><br />

        <input type="checkbox" name="create_database_before_copying" value="1"
            id="checkbox_create_database_before_copying"
            style="vertical-align: middle" checked="checked" />
        <label for="checkbox_create_database_before_copying">
            <?php echo $strCreateDatabaseBeforeCopying; ?></label><br />
        <input type="checkbox" name="drop_if_exists" value="true"
            id="checkbox_drop" style="vertical-align: middle" />
        <label for="checkbox_drop"><?php echo $strStrucDrop; ?></label><br />
        <input type="checkbox" name="sql_auto_increment" value="1"
            id="checkbox_auto_increment" style="vertical-align: middle" />
        <label for="checkbox_auto_increment">
            <?php echo $strAddAutoIncrement; ?></label><br />
        <input type="checkbox" name="constraints" value="1"
            id="checkbox_constraints" style="vertical-align: middle" />
        <label for="checkbox_constraints">
            <?php echo $strAddConstraints; ?></label><br />
    <?php
    if (isset($_COOKIE) && isset($_COOKIE['pma_switch_to_new'])
      && $_COOKIE['pma_switch_to_new'] == 'true') {
        $pma_switch_to_new = 'true';
    }
    ?>
        <input type="checkbox" name="switch_to_new" value="true"
            id="checkbox_switch"
            <?php echo ((isset($pma_switch_to_new) && $pma_switch_to_new == 'true') ? ' checked="checked"' : ''); ?>
            style="vertical-align: middle" />
        <label for="checkbox_switch"><?php echo $strSwitchToDatabase; ?></label>
    </fieldset>
    <fieldset class="tblFooters">
        <input type="submit" name="submit_copy" value="<?php echo $strGo; ?>" />
    </fieldset>
    </form>

    <?php
    /**
     * Change database charset
     */
    if (PMA_MYSQL_INT_VERSION >= 40101) {
    // MySQL supports setting default charsets / collations for databases since
    // version 4.1.1.
        echo '<form method="post" action="./db_operations.php">' . "\n"
           . PMA_generate_common_hidden_inputs($db, $table)
           . '<fieldset>' . "\n"
           . '    <legend>';
        if ($cfg['PropertiesIconic']) {
            echo '<img class="icon" src="' . $pmaThemeImage . 's_asci.png"'
                .' alt="" width="16" height="16" />';
        }
        echo '    <label for="select_db_collation">' . $strCollation . ':</label>' . "\n"
           . '    </legend>' . "\n"
           . PMA_generateCharsetDropdownBox(PMA_CSDROPDOWN_COLLATION,
                'db_collation', 'select_db_collation', $db_collation, FALSE, 3)
           . '    <input type="submit" name="submitcollation"'
           . ' value="' . $strGo . '" style="vertical-align: middle" />' . "\n"
           . '</fieldset>' . "\n"
           . '</form>' . "\n";
    }

    if ( $num_tables > 0
      && !$cfgRelation['allworks'] && $cfg['PmaNoRelation_DisableWarning'] == FALSE) {
        echo '<div class="error"><h1>' . $strError . '</h1>'
            . sprintf( $strRelationNotWorking,
                '<a href="' . $cfg['PmaAbsoluteUri'] . 'chk_rel.php?' . $url_query . '">',
                '</a>')
            . '</div>';
    } // end if
} // end if (!$is_information_schema)


// not sure about leaving the PDF dialog for information_schema
if ($num_tables > 0) {
    $takeaway = $url_query . '&amp;table=' . urlencode($table);
}

if ($cfgRelation['pdfwork'] && $num_tables > 0) { ?>
    <!-- Work on PDF Pages -->

    <?php
    // We only show this if we find something in the new pdf_pages table

    $test_query = '
         SELECT *
           FROM ' . PMA_backquote($GLOBALS['cfgRelation']['db']) . '.' . PMA_backquote($cfgRelation['pdf_pages']) . '
          WHERE db_name = \'' . PMA_sqlAddslashes($db) . '\'';
    $test_rs    = PMA_query_as_cu($test_query, null, PMA_DBI_QUERY_STORE);

    if ($test_rs && PMA_DBI_num_rows($test_rs) > 0) { ?>
    <!-- PDF schema -->
    <form method="post" action="pdf_schema.php">
    <fieldset>
        <legend>
        <?php
        echo PMA_generate_common_hidden_inputs($db);
        if ($cfg['PropertiesIconic']) {
            echo '<img class="icon" src="' . $pmaThemeImage . 'b_view.png"'
                .' alt="" width="16" height="16" />';
        }
        echo $strDisplayPDF;
        ?>:
        </legend>
        <label for="pdf_page_number_opt"><?php echo $strPageNumber; ?></label>
        <select name="pdf_page_number" id="pdf_page_number_opt">
        <?php
        while ($pages = @PMA_DBI_fetch_assoc($test_rs)) {
            echo '                <option value="' . $pages['page_nr'] . '">'
                . $pages['page_nr'] . ': ' . $pages['page_descr'] . '</option>' . "\n";
        } // end while
        PMA_DBI_free_result($test_rs);
        unset($test_rs);
        ?>
        </select><br />

        <input type="checkbox" name="show_grid" id="show_grid_opt" />
        <label for="show_grid_opt"><?php echo $strShowGrid; ?></label><br />
        <input type="checkbox" name="show_color" id="show_color_opt"
            checked="checked" />
        <label for="show_color_opt"><?php echo $strShowColor; ?></label><br />
        <input type="checkbox" name="show_table_dimension" id="show_table_dim_opt" />
        <label for="show_table_dim_opt"><?php echo $strShowTableDimension; ?>
            </label><br />
        <input type="checkbox" name="all_tab_same_wide" id="all_tab_same_wide" />
        <label for="all_tab_same_wide"><?php echo $strAllTableSameWidth; ?>
            </label><br />
        <input type="checkbox" name="with_doc" id="with_doc" checked="checked" />
        <label for="with_doc"><?php echo $strDataDict; ?></label><br />

        <label for="orientation_opt"><?php echo $strShowDatadictAs; ?></label>
        <select name="orientation" id="orientation_opt">
            <option value="L"><?php echo $strLandscape;?></option>
            <option value="P"><?php echo $strPortrait;?></option>
        </select><br />

        <label for="paper_opt"><?php echo $strPaperSize; ?></label>
        <select name="paper" id="paper_opt">
        <?php
            foreach ($cfg['PDFPageSizes'] AS $key => $val) {
                echo '<option value="' . $val . '"';
                if ($val == $cfg['PDFDefaultPageSize']) {
                    echo ' selected="selected"';
                }
                echo ' >' . $val . '</option>' . "\n";
            }
        ?>
        </select>
    </fieldset>
    <fieldset class="tblFooters">
        <input type="submit" value="<?php echo $strGo; ?>" />
    </fieldset>
    </form>
        <?php
    }   // end if
    ?>
    <ul>
        <li>
    <?php
        echo '<a href="pdf_pages.php?' . $takeaway . '">';
        if ($cfg['PropertiesIconic']) {
            echo '<img class="icon" src="' . $pmaThemeImage . 'b_edit.png"'
                .' alt="" width="16" height="16" />';
        }
        echo $strEditPDFPages . '</a>';
    ?>
        </li>
    </ul>
    <?php
} // end if

if ( $num_tables > 0
  && $cfgRelation['relwork'] && $cfgRelation['commwork']
  && isset($cfg['docSQLDir']) && !empty($cfg['docSQLDir']) ) {
    /**
     * import docSQL files
     */
    echo '<ul>' . "\n"
        .'<li><a href="db_details_importdocsql.php?' . $takeaway . '">' . "\n";
    if ($cfg['PropertiesIconic']) {
        echo '<img class="icon" src="' . $pmaThemeImage . 'b_docsql.png"'
            .' alt="" width="16" height="16" />';
    }
    echo $strImportDocSQL . '</a></li>' . "\n"
        .'</ul>';
}

/**
 * Displays the footer
 */
require_once('./libraries/footer.inc.php');
?>
