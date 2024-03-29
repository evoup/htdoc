<?php
/* $Id: string.lib.php,v 1.1.1.1 2007/08/16 08:30:12 cvs Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/** Specialized String Functions for phpMyAdmin
 *
 * Copyright 2002 Robin Johnson <robbat2@users.sourceforge.net>
 * http://www.orbis-terrarum.net/?l=people.robbat2
 *
 * Defines a set of function callbacks that have a pure C version available if
 * the "ctype" extension is available, but otherwise have PHP versions to use
 * (that are slower).
 *
 * The SQL Parser code relies heavily on these functions.
 */

/* Try to load mbstring, unless we're using buggy php version */
if (PMA_PHP_INT_VERSION != 40203) {
    if (!@extension_loaded('mbstring')) {
        PMA_dl('mbstring');
    }
}

/* windows-* and tis-620 are not supported and are not multibyte,
 * others can be ignored as they're not multibyte */
$GLOBALS['using_mb_charset'] = 
    substr($GLOBALS['charset'], 0, 8) != 'windows-' &&
    substr($GLOBALS['charset'], 0, 9) != 'iso-8859-' && 
    substr($GLOBALS['charset'], 0, 3) != 'cp-' && 
    $GLOBALS['charset'] != 'koi8-r' && 
    $GLOBALS['charset'] != 'tis-620';

$GLOBALS['PMA_allow_mbstr'] = @function_exists('mb_strlen') && $GLOBALS['using_mb_charset'];

if ($GLOBALS['PMA_allow_mbstr']) {
    // the hebrew lang file uses iso-8859-8-i, encoded RTL,
    // but mb_internal_encoding only supports iso-8859-8
    if ($GLOBALS['charset'] == 'iso-8859-8-i'){
        mb_internal_encoding('iso-8859-8');
    } else {
        //mb_internal_encoding($GLOBALS['charset']);
		mb_internal_encoding('utf-8');

    }
}

// This is for handling input better
if (defined('PMA_MULTIBYTE_ENCODING') || $GLOBALS['PMA_allow_mbstr']) {
    $GLOBALS['PMA_strpos']  = 'mb_strpos';
    $GLOBALS['PMA_strrpos'] = 'mb_strrpos';
} else {
    $GLOBALS['PMA_strpos']  = 'strpos';
    $GLOBALS['PMA_strrpos'] = 'strrpos';
}

/**
 * Returns length of string depending on current charset.
 *
 * @param   string   string to count
 *
 * @return  int      string length
 *
 * @access  public
 *
 * @author  nijel
 */
function PMA_strlen($string)
{
    // windows-* charsets are not multibyte and not supported by mb_*
    if (defined('PMA_MULTIBYTE_ENCODING') || $GLOBALS['PMA_allow_mbstr']) {
        return mb_strlen($string);
    } else {
        return strlen($string);
    }
}

/**
 * Returns substring from string, works depending on current charset.
 *
 * @param   string   string to count
 * @param   int      start of substring
 * @param   int      length of substring
 *
 * @return  int      substring
 *
 * @access  public
 *
 * @author  nijel
 */
function PMA_substr($string, $start, $length = 2147483647)
{
    if (defined('PMA_MULTIBYTE_ENCODING') || $GLOBALS['PMA_allow_mbstr']) {
        return mb_substr($string, $start, $length);
    } else {
        return substr($string, $start, $length);
    }
}


/**
 * This checks if a string actually exists inside another string
 * We try to do it in a PHP3-portable way.
 * We don't care about the position it is in.
 *
 * @param   string   string to search for
 * @param   string   string to search in
 *
 * @return  boolean  whether the needle is in the haystack or not
 */
function PMA_STR_strInStr($needle, $haystack)
{
    // $GLOBALS['PMA_strpos']($haystack, $needle) !== FALSE
    // return (is_integer($GLOBALS['PMA_strpos']($haystack, $needle)));
    return $GLOBALS['PMA_strpos'](' ' . $haystack, $needle);
} // end of the "PMA_STR_strInStr()" function


/**
 * Checks if a given character position in the string is escaped or not
 *
 * @param   string   string to check for
 * @param   integer  the character to check for
 * @param   integer  starting position in the string
 *
 * @return  boolean  whether the character is escaped or not
 */
function PMA_STR_charIsEscaped($string, $pos, $start = 0)
{
    $len = PMA_strlen($string);
    // Base case:
    // Check for string length or invalid input or special case of input
    // (pos == $start)
    if (($pos == $start) || ($len <= $pos)) {
        return FALSE;
    }

    $p           = $pos - 1;
    $escaped     = FALSE;
    while (($p >= $start) && (PMA_substr($string, $p, 1) == '\\')) {
        $escaped = !$escaped;
        $p--;
    } // end while

    if ($pos < $start) {
        // throw error about strings
    }

    return $escaped;
} // end of the "PMA_STR_charIsEscaped()" function


/**
 * Checks if a number is in a range
 *
 * @param   integer  number to check for
 * @param   integer  lower bound
 * @param   integer  upper bound
 *
 * @return  boolean  whether the number is in the range or not
 */
function PMA_STR_numberInRangeInclusive($num, $lower, $upper)
{
    return (($num >= $lower) && ($num <= $upper));
} // end of the "PMA_STR_numberInRangeInclusive()" function


/**
 * Checks if a character is a digit
 *
 * @param   string   character to check for
 *
 * @return  boolean  whether the character is a digit or not
 *
 * @see     PMA_STR_numberInRangeInclusive()
 */
function PMA_STR_isDigit($c)
{
    $ord_zero = 48; //ord('0');
    $ord_nine = 57; //ord('9');
    $ord_c    = ord($c);

    return PMA_STR_numberInRangeInclusive($ord_c, $ord_zero, $ord_nine);
} // end of the "PMA_STR_isDigit()" function


/**
 * Checks if a character is an hexadecimal digit
 *
 * @param   string   character to check for
 *
 * @return  boolean  whether the character is an hexadecimal digit or not
 *
 * @see     PMA_STR_numberInRangeInclusive()
 */
function PMA_STR_isHexDigit($c)
{
    $ord_Aupper = 65;  //ord('A');
    $ord_Fupper = 70;  //ord('F');
    $ord_Alower = 97;  //ord('a');
    $ord_Flower = 102; //ord('f');
    $ord_zero   = 48;  //ord('0');
    $ord_nine   = 57;  //ord('9');
    $ord_c      = ord($c);

    return (PMA_STR_numberInRangeInclusive($ord_c, $ord_zero, $ord_nine)
            || PMA_STR_numberInRangeInclusive($ord_c, $ord_Aupper, $ord_Fupper)
            || PMA_STR_numberInRangeInclusive($ord_c, $ord_Alower, $ord_Flower));
} // end of the "PMA_STR_isHexDigit()" function


/**
 * Checks if a character is an upper alphabetic one
 *
 * @param   string   character to check for
 *
 * @return  boolean  whether the character is an upper alphabetic one or
 *                   not
 *
 * @see     PMA_STR_numberInRangeInclusive()
 */
function PMA_STR_isUpper($c)
{
    $ord_zero = 65; //ord('A');
    $ord_nine = 90; //ord('Z');
    $ord_c    = ord($c);

    return PMA_STR_numberInRangeInclusive($ord_c, $ord_zero, $ord_nine);
} // end of the "PMA_STR_isUpper()" function


/**
 * Checks if a character is a lower alphabetic one
 *
 * @param   string   character to check for
 *
 * @return  boolean  whether the character is a lower alphabetic one or
 *                   not
 *
 * @see     PMA_STR_numberInRangeInclusive()
 */
function PMA_STR_isLower($c)
{
    $ord_zero = 97;  //ord('a');
    $ord_nine = 122; //ord('z');
    $ord_c    = ord($c);

    return PMA_STR_numberInRangeInclusive($ord_c, $ord_zero, $ord_nine);
} // end of the "PMA_STR_isLower()" function


/**
 * Checks if a character is an alphabetic one
 *
 * @param   string   character to check for
 *
 * @return  boolean  whether the character is an alphabetic one or not
 *
 * @see     PMA_STR_isUpper()
 * @see     PMA_STR_isLower()
 */
function PMA_STR_isAlpha($c)
{
    return (PMA_STR_isUpper($c) || PMA_STR_isLower($c));
} // end of the "PMA_STR_isAlpha()" function


/**
 * Checks if a character is an alphanumeric one
 *
 * @param   string   character to check for
 *
 * @return  boolean  whether the character is an alphanumeric one or not
 *
 * @see     PMA_STR_isUpper()
 * @see     PMA_STR_isLower()
 * @see     PMA_STR_isDigit()
 */
function PMA_STR_isAlnum($c)
{
    return (PMA_STR_isUpper($c) || PMA_STR_isLower($c) || PMA_STR_isDigit($c));
} // end of the "PMA_STR_isAlnum()" function


/**
 * Checks if a character is a space one
 *
 * @param   string   character to check for
 *
 * @return  boolean  whether the character is a space one or not
 *
 * @see     PMA_STR_numberInRangeInclusive()
 */
function PMA_STR_isSpace($c)
{
    $ord_space = 32; //ord(' ')
    $ord_tab   = 9; //ord('\t')
    $ord_CR    = 13; //ord('\n')
    $ord_NOBR  = 160; //ord('U+00A0);
    $ord_c     = ord($c);

    return (($ord_c == $ord_space)
            || ($ord_c == $ord_NOBR)
            || PMA_STR_numberInRangeInclusive($ord_c, $ord_tab, $ord_CR));
} // end of the "PMA_STR_isSpace()" function


/**
 * Checks if a character is an accented character
 *
 * @note    Presently this only works for some character sets. More work
 *          may be needed to fix it.
 *
 * @param   string   character to check for
 *
 * @return  boolean  whether the character is an accented one or not
 *
 * @see     PMA_STR_numberInRangeInclusive()
 */
function PMA_STR_isAccented($c)
{
    $ord_min1 = 192; //ord('A');
    $ord_max1 = 214; //ord('Z');
    $ord_min2 = 216; //ord('A');
    $ord_max2 = 246; //ord('Z');
    $ord_min3 = 248; //ord('A');
    $ord_max3 = 255; //ord('Z');

    $ord_c    = ord($c);

    return PMA_STR_numberInRangeInclusive($ord_c, $ord_min1, $ord_max1)
           || PMA_STR_numberInRangeInclusive($ord_c, $ord_min2, $ord_max2)
           || PMA_STR_numberInRangeInclusive($ord_c, $ord_min2, $ord_max2);
} // end of the "PMA_STR_isAccented()" function


/**
 * Checks if a character is an SQL identifier
 *
 * @param   string   character to check for
 * @param   boolean  whether the dot character is valid or not
 *
 * @return  boolean  whether the character is an SQL identifier or not
 *
 * @see     PMA_STR_isAlnum()
 */
function PMA_STR_isSqlIdentifier($c, $dot_is_valid = FALSE)
{
    return (PMA_STR_isAlnum($c)
            || PMA_STR_isAccented($c)
            || ($c == '_') || ($c == '$')
            || (($dot_is_valid != FALSE) && ($c == '.')));
} // end of the "PMA_STR_isSqlIdentifier()" function


/**
 * Binary search of a value in a sorted array
 *
 * @param   string   string to search for
 * @param   array    sorted array to search into
 * @param   integer  size of sorted array to search into
 *
 * @return  boolean  whether the string has been found or not
 */
function PMA_STR_binarySearchInArr($str, $arr, $arrsize)
{
    // $arr MUST be sorted, due to binary search
    $top    = $arrsize - 1;
    $bottom = 0;
    $found  = FALSE;

    while (($top >= $bottom) && ($found == FALSE)) {
        $mid        = intval(($top + $bottom) / 2);
        $res        = strcmp($str, $arr[$mid]);
        if ($res == 0) {
            $found  = TRUE;
        } elseif ($res < 0) {
            $top    = $mid - 1;
        } else {
            $bottom = $mid + 1;
        }
    } // end while

    return $found;
} // end of the "PMA_STR_binarySearchInArr()" function

?>
