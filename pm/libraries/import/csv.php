<?php
/* $Id: csv.php,v 1.1.1.1 2007/08/16 08:30:14 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/* CSV import plugin for phpMyAdmin */

if ($plugin_param == 'table') {
    if (isset($plugin_list)) {
        $plugin_list['csv'] = array(
            'text' => 'strCSV',
            'extension' => 'csv',
            'options' => array(
                array('type' => 'bool', 'name' => 'replace', 'text' => 'strReplaceTable'),
                array('type' => 'bool', 'name' => 'ignore', 'text' => 'strIgnoreDuplicates'),
                array('type' => 'text', 'name' => 'terminated', 'text' => 'strFieldsTerminatedBy', 'size' => 2, 'len' => 2),
                array('type' => 'text', 'name' => 'enclosed', 'text' => 'strFieldsEnclosedBy', 'size' => 2, 'len' => 2),
                array('type' => 'text', 'name' => 'escaped', 'text' => 'strFieldsEscapedBy', 'size' => 2, 'len' => 2),
                array('type' => 'text', 'name' => 'new_line', 'text' => 'strLinesTerminatedBy', 'size' => 2),
                array('type' => 'text', 'name' => 'columns', 'text' => 'strColumnNames'),
                ),
            'options_text' => 'strCSVImportOptions',
            );
    } else {
    /* We do not define function when plugin is just queried for information above */
        $replacements = array(
            '\\n'   => "\n",
            '\\t'   => "\t",
            '\\r'   => "\r",
            );
        $csv_terminated = strtr($csv_terminated, $replacements);
        $csv_enclosed = strtr($csv_enclosed,  $replacements);
        $csv_escaped = strtr($csv_escaped, $replacements);
        $csv_new_line = strtr($csv_new_line, $replacements);

        if (strlen($csv_terminated) != 1) {
            $message = sprintf($strInvalidCSVParameter, $strFieldsTerminatedBy);
            $show_error_header = TRUE;
            $error = TRUE;
        } elseif (strlen($csv_enclosed) != 1) {
            $message = sprintf($strInvalidCSVParameter, $strFieldsEnclosedBy);
            $show_error_header = TRUE;
            $error = TRUE;
        } elseif (strlen($csv_escaped) != 1) {
            $message = sprintf($strInvalidCSVParameter, $strFieldsEscapedBy);
            $show_error_header = TRUE;
            $error = TRUE;
        } elseif (strlen($csv_new_line) != 1 && $csv_new_line != 'auto') { 
            $message = sprintf($strInvalidCSVParameter, $strLinesTerminatedBy);
            $show_error_header = TRUE;
            $error = TRUE;
        }

        $buffer = '';
        if (isset($csv_replace)) {
            $sql_template = 'REPLACE';
        } else {
            $sql_template = 'INSERT';
            if (isset($csv_ignore)) {
                $sql_template .= ' IGNORE';
            }
        }
        $sql_template .= ' INTO ' . PMA_backquote($table);
        
        $tmp_fields = PMA_DBI_get_fields($db, $table);
        
        if (empty($csv_columns)) {
            $fields = $tmp_fields;
        } else {
            $sql_template .= ' (';
            $fields = array();
            $tmp   = split(',( ?)', $csv_columns);
            foreach ($tmp as $key => $val) {
                if (count($fields) > 0) {
                    $sql_template .= ', ';
                }
                $val = trim($val);
                $found = FALSE;
                foreach ($tmp_fields as $id => $field) {
                    if ($field['Field'] == $val) {
                        $found = TRUE;
                        break;
                    }
                }
                if (!$found) {
                    $message = sprintf($strInvalidColumn, $val);
                    $show_error_header = TRUE;
                    $error = TRUE;
                    break;
                }
                $fields[] = $field;
                $sql_template .= PMA_backquote($val);
            }
            $sql_template .= ') ';
        }

        $required_fields = count($fields);

        $sql_template .= ' VALUES (';

        // Defaults for parser
        $i = 0;
        $len = 0;
        $line = 1;
        $lasti = -1;
        $values = array();
        $csv_finish = FALSE;

        while (!($finished && $i >= $len) && !$error && !$timeout_passed) {
            $data = PMA_importGetNextChunk();
            if ($data === FALSE) {
                // subtract data we didn't handle yet and stop processing
                $offset -= strlen($buffer);
                break;
            } elseif ($data === TRUE) {
                // Handle rest of buffer
            } else {
                // Append new data to buffer
                $buffer .= $data;
                // Do not parse string when we're not at the end and don't have new line inside
                if (($csv_new_line == 'auto' && strpos($buffer, "\r") === FALSE && strpos($buffer, "\n") === FALSE)
                    || ($csv_new_line != 'auto' && strpos($buffer, $csv_new_line) === FALSE)) {
                    continue;
                }
            }

            // Current length of our buffer
            $len = strlen($buffer);
            // Currently parsed char
            $ch = $buffer[$i];
            while ($i < $len) {
                // Deadlock protection
                if ($lasti == $i) {
                    $message = sprintf($strInvalidCSVFormat, $line);
                    $show_error_header = TRUE;
                    $error = TRUE;
                    break;
                }
                $lasti = $i;

                // This can happen with auto EOL and \r at the end of buffer
                if (!$csv_finish) {
                    // Grab empty field
                    if ($ch == $csv_terminated) {
                        $values[] = '';
                        if ($i == $len - 1) {
                            break;
                        }
                        $i++;
                        $ch = $buffer[$i];
                        continue;
                    }

                    // Grab one field 
                    if ($ch == $csv_enclosed) {
                        $need_end = TRUE;
                        if ($i == $len - 1) {
                            break;
                        }
                        $i++;
                        $ch = $buffer[$i];
                    } else {
                        $need_end = FALSE;
                    }
                    $fail = FALSE;
                    $value = '';
                    while (($need_end && $ch != $csv_enclosed) || (!$need_end && !($ch == $csv_terminated || $ch == $csv_new_line || ($csv_new_line == 'auto' && ($ch == "\r" || $ch == "\n"))))) {
                        if ($ch == $csv_escaped) {
                            if ($i == $len - 1) {
                                $fail = TRUE;
                                break;
                            }
                            $i++;
                            $ch = $buffer[$i];
                        }
                        $value .= $ch;
                        if ($i == $len - 1) {
                            if (!$finished) {
                                $fail = TRUE;
                            }
                            break;
                        }
                        $i++;
                        $ch = $buffer[$i];
                    }
                    if ($fail) {
                        break;
                    }
                    $values[] = $value;
                    // Need to strip trailing enclosing char?
                    if ($need_end && $ch == $csv_enclosed) {
                        if ($i == $len - 1) {
                            break;
                        }
                        $i++;
                        $ch = $buffer[$i];
                    }
                    // Are we at the end?
                    if ($ch == $csv_new_line || ($csv_new_line == 'auto' && ($ch == "\r" || $ch == "\n")) || ($finished && $i == $len - 1)) {
                        $csv_finish = TRUE;
                    }
                    // Go to next char
                    if ($ch == $csv_terminated) {
                        if ($i == $len - 1) {
                            break;
                        }
                        $i++;
                        $ch = $buffer[$i];
                    }
                }

                // End of line
                if ($csv_finish || $ch == $csv_new_line || ($csv_new_line == 'auto' && ($ch == "\r" || $ch == "\n"))) {
                    if ($csv_new_line == 'auto' && $ch == "\r") { // Handle "\r\n"
                        if ($i >= ($len - 2) && !$finished) {
                            break; // We need more data to decide new line
                        }
                        if ($buffer[$i + 1] == "\n") {
                            $i++;
                        }
                    }
                    // We didn't parse value till the end of line, so there was empty one
                    if (!$csv_finish) {
                        $values[] = '';
                    }
                    // Do we have correct count of values?
                    if (count($values) != $required_fields) {
                        $message = sprintf($strInvalidCSVFieldCount, $line);
                        $show_error_header = TRUE;
                        $error = TRUE;
                        break;
                    }
                    
                    $first = TRUE;
                    $sql = $sql_template;
                    foreach ($values as $key => $val) {
                        if (!$first) {
                            $sql .= ', ';
                        }
                        $sql .= '\'' . addslashes($val) . '\'';
                        $first = FALSE;
                    }
                    $sql .= ')';

                    // FIXME: maybe we could add original line to verbose SQL in comment
                    PMA_importRunQuery($sql, $sql);
                    $line++;
                    $csv_finish = FALSE;
                    $values = array();
                    $buffer = substr($buffer, $i + 1);
                    $len = strlen($buffer);
                    $i = 0;
                    $lasti = -1;
                    $ch = $buffer[0];
                }
            } // End of parser loop
        } // End of import loop

        // Commit any possible data in buffers
        PMA_importRunQuery();
        
        if (count($values) != 0 && !$error) {
            $message = sprintf($strInvalidCSVFormat, $line);
            $show_error_header = TRUE;
            $error = TRUE;
        }
    }
}
?>
