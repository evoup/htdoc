<?php
// $Id: formtext.php,v 1.1 2008/02/28 12:17:09 cvs Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //
if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}
/**
 * @package     kernel
 * @subpackage  form
 * 
 * @author	    Kazumi Ono	<onokazu@xoops.org>
 * @copyright	copyright (c) 2000-2003 XOOPS.org
 */
 
/**
 * A simple text field
 * 
 * @package     kernel
 * @subpackage  form
 * 
 * @author	    Kazumi Ono	<onokazu@xoops.org>
 * @copyright	copyright (c) 2000-2003 XOOPS.org
 */
class XoopsFormText extends XoopsFormElement {

	/**
     * Size
	 * @var	int 
     * @access	private
	 */
	var $_size;

	/**
     * Maximum length of the text
	 * @var	int 
	 * @access	private
	 */
	var $_maxlength;

	/**
     * Initial text
	 * @var	string  
	 * @access	private
	 */
	var $_value;

	/**
	 * Constructor
	 * 
	 * @param	string	$caption	Caption
	 * @param	string	$name       "name" attribute
	 * @param	int		$size	    Size
	 * @param	int		$maxlength	Maximum length of text
     * @param	string  $value      Initial text
	 */
	function XoopsFormText($caption, $name, $size, $maxlength, $value = ""){
		$this->setCaption($caption);
		$this->setName($name);
		$this->_size = intval($size);
		$this->_maxlength = intval($maxlength);
		$this->setValue($value);
	}

	/**
	 * Get size
	 * 
     * @return	int
	 */
	function getSize() {
		return $this->_size;
	}

	/**
	 * Get maximum text length
	 * 
     * @return	int
	 */
	function getMaxlength() {
		return $this->_maxlength;
	}

	/**
	 * Get initial content
	 * 
	 * @param	bool    $encode To sanitizer the text? Default value should be "true"; however we have to set "false" for backward compat
     * @return	string
	 */
	function getValue($encode = false) {
		return $encode ? htmlspecialchars($this->_value, ENT_QUOTES) : $this->_value;
	}

	/**
	 * Set initial text value
	 * 
     * @param	$value  string
	 */
	function setValue($value) {
		$this->_value = $value;
	}

	/**
	 * Prepare HTML for output
	 * 
     * @return	string  HTML
	 */
	function render() {
		return "<input type='text' name='".$this->getName()."' id='".$this->getName()."' size='".$this->getSize()."' maxlength='".$this->getMaxlength()."' value='".$this->getValue()."'".$this->getExtra()." />";
	}
}
?>