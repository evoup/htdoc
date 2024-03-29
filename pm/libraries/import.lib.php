<?php
/* $Id: import.lib.php,v 1.1.1.1 2007/08/16 08:30:12 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/* Library that provides common import functions that are used by import plugins */

// We need to know something about user
require_once('./libraries/check_user_privileges.lib.php');
// We do this check
define('PMA_CHK_DROP', 1);

/**
 *  Check whether timeout is getting close
 *
 *  @return boolean true if timeout is close
 *  @access public
 */
function PMA_checkTimeout()
{
    global $timestamp, $maximum_time, $timeout_passed;
    if ($maximum_time == 0) {
        return FALSE;
    } elseif ($timeout_passed) {
        return TRUE;
    /* 5 in next row might be too much */
    } elseif ((time() - $timestamp) > ($maximum_time - 5)) {
        $timeout_passed = TRUE;
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 *  Detects what compression filse uses
 *
 *  @param  string filename to check
 *  @return string MIME type of compression, none for none
 *  @access public
 */
function PMA_detectCompression($filepath)
{
    $file = @fopen($filepath, 'rb');
    if (!$file) {
        return FALSE;
    }
    $test = fread($file, 4);
    fclose($file);
    if ($test[0] == chr(31) && $test[1] == chr(139)) {
        return 'application/gzip';
    }
    if (substr($test, 0, 3) == 'BZh') {
        return 'application/bzip2';
    }
    if ($test == "PK\003\004") {
        return 'application/zip';
    }
    return 'none';
}

/**
 *  Runs query inside import buffer. This is needed to allow displaying
 *  of last SELECT or SHOW results and simmilar nice stuff.
 *
 *  @param  string query to run
 *  @param  string query to display, this might be commented
 *  @access public
 */
function PMA_importRunQuery($sql = '', $full = '')
{
    global $import_run_buffer, $go_sql, $complete_query, $display_query, $sql_query, $cfg, $my_die, $error, $reload, $finished, $timeout_passed, $skip_queries, $executed_queries, $max_sql_len, $read_multiply, $cfg, $sql_query_disabled, $db, $run_query, $is_superuser;
    $read_multiply = 1;
    if (isset($import_run_buffer)) {
        // Should we skip something?
        if ($skip_queries > 0) {
            $skip_queries--;
        } else {
            if (!empty($import_run_buffer['sql']) && trim($import_run_buffer['sql']) != '') {
                if (!$cfg['AllowUserDropDatabase']
                    && !$is_superuser
                    && preg_match('@DROP[[:space:]]+(IF EXISTS[[:space:]]+)?DATABASE @i', $import_run_buffer['sql'])) {
                    $message = $GLOBALS['strNoDropDatabases'];
                    $show_error_header = TRUE;
                    $error = TRUE;
                    return;
                }
                $max_sql_len = max($max_sql_len, strlen($import_run_buffer['sql']));
                if (!$sql_query_disabled) {
                    $sql_query .= $import_run_buffer['full'];
                }
                $executed_queries++;
                if ($run_query && $finished && empty($sql) && !$error && (
                        (!empty($import_run_buffer['sql']) && preg_match('/^[\s]*(SELECT|SHOW)/i', $import_run_buffer['sql'])) ||
                        ($executed_queries == 1)
                        )) {
                    $go_sql = TRUE;
                    if (!$sql_query_disabled) {
                        $complete_query = $sql_query;
                        $display_query = $sql_query;
                    } else {
                        $complete_query = '';
                        $display_query = '';
                    }
                    $sql_query = $import_run_buffer['sql'];
                } elseif ($run_query) {
                    $result = PMA_DBI_try_query($import_run_buffer['sql']);
                    $msg = '# ';
                    if ($result === FALSE) { // execution failed
                        if (!isset($my_die)) {
                            $my_die = array();
                        }
                        $my_die[] = array('sql' => $import_run_buffer['full'], 'error' => PMA_DBI_getError());

                        if ($cfg['VerboseMultiSubmit']) {
                            $msg .= $GLOBALS['strError'];
                        }

                        if (!$cfg['IgnoreMultiSubmitErrors']) {
                            $error = TRUE;
                            return;
                        }
                    } elseif ($cfg['VerboseMultiSubmit']) {
                        $a_num_rows = (int)@PMA_DBI_num_rows($result);
                        $a_aff_rows = (int)@PMA_DBI_affected_rows();
                        if ($a_num_rows > 0) {
                            $msg .= $GLOBALS['strRows'] . ': ' . $a_num_rows;
                        } elseif ($a_aff_rows > 0) {
                            $a_rows = 
                            $msg .= $GLOBALS['strAffectedRows'] . ' ' . $a_aff_rows;
                        } else {
                            $msg .= $GLOBALS['strEmptyResultSet'];
                        }
                    }
                    if (!$sql_query_disabled) {
                        $sql_query .= $msg . "\n";
                    }

                    // If a 'USE <db>' SQL-clause was found and the query succeeded, set our current $db to the new one
                    if ($result != FALSE && preg_match('@^[\s]*USE[[:space:]]*([\S]+)@i', $import_run_buffer['sql'], $match)) {
                        $db = trim($match[1]);
                        $reload = TRUE;
                    }

                    if ($result != FALSE && preg_match('@^[\s]*(DROP|CREATE)[\s]+(IF EXISTS[[:space:]]+)?(TABLE|DATABASE)[[:space:]]+(.+)@im', $import_run_buffer['sql'])) {
                        $reload = TRUE;
                    }
                } // end run query
            } // end non empty query
            elseif (!empty($import_run_buffer['full'])) {
                if ($go_sql) {
                    $complete_query .= $import_run_buffer['full'];
                    $display_query .= $import_run_buffer['full'];
                } else {
                    if (!$sql_query_disabled) {
                        $sql_query .= $import_run_buffer['full'];
                    }
                }
            }
            // check length of query unless we decided to pass it to sql.php
            if (!$go_sql) {
                if ($cfg['VerboseMultiSubmit'] && !empty($sql_query)) {
                    if (strlen($sql_query) > 50000 || $executed_queries > 50 || $max_sql_len > 1000) {
                        $sql_query = '';
                        $sql_query_disabled = TRUE;
                    }
                } else {
                    if (strlen($sql_query) > 10000 || $executed_queries > 10 || $max_sql_len > 500) {
                        $sql_query = '';
                        $sql_query_disabled = TRUE;
                    }
                }
            }
        } // end do query (no skip)
    } // end buffer exists
    
    // Do we have something to push into buffer?
    if (!empty($sql) || !empty($full)) {
        $import_run_buffer = array('sql' => $sql, 'full' => $full);
    } else {
        unset($GLOBALS['import_run_buffer']);
    }
}


/**
 *  Returns next part of imported file/buffer
 *
 *  @param  integer size of buffer to read (this is maximal size
 *                  function will return)
 *  @return string part of file/buffer
 *  @access public
 */
function PMA_importGetNextChunk($size = 32768)
{
    global $import_file, $import_text, $finished, $compression, $import_handle, $offset, $charset_conversion, $charset_of_file, $charset, $read_multiply, $read_limit;
    
    // Add some progression while reading large amount of data
    if ($read_multiply <= 8) {
        $size *= $read_multiply;
    } else {
        $size *= 8;
    }
    $read_multiply++;

    // We can not read too much
    if ($size > $read_limit) {
        $size = $read_limit;
    }

    if (PMA_checkTimeout()) {
        return FALSE;
    }
    if ($finished) {
        return TRUE;
    }

    if ($import_file == 'none') {
        // Well this is not yet supported and tested, but should return content of textarea
        if (strlen($import_text) < $size) {
            $finished = TRUE;
            return $import_text;
        } else {
            $r = substr($import_text, 0, $size);
            $offset += $size;
            $import_text = substr($import_text, $size);
            return $r;
        }
    }
    
    switch ($compression) {
        case 'application/bzip2':
            $result = bzread($import_handle, $size);
            $finished = feof($import_handle);
            break;
        case 'application/gzip':
            $result = gzread($import_handle, $size);
            $finished = feof($import_handle);
            break;
        case 'application/zip':
            $result = substr($import_text, 0, $size);
            $import_text = substr($import_text, $size);
            $finished = empty($import_text);
            break;
        case 'none':
            $result = fread($import_handle, $size);
            $finished = feof($import_handle);
            break;
    }
    $offset += $size;
    
    if ($charset_conversion) {
        return PMA_convert_string($charset_of_file, $charset, $result);
    } else {
        return $result; 
    }
}



?>
