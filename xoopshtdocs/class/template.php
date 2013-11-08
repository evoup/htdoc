<?php
// $Id: template.php,v 1.1 2008/02/28 12:16:56 cvs Exp $
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

if (!defined('SMARTY_DIR')) {
	exit();
}
/**
 * Base class: Smarty template engine
 */
require_once SMARTY_DIR.'Smarty.class.php';

/**
 * Template engine
 *
 * @package		kernel
 * @subpackage	core
 *
 * @author		Kazumi Ono 	<onokazu@xoops.org>
 * @copyright	(c) 2000-2003 The Xoops Project - www.xoops.org
 */
class XoopsTpl extends Smarty {

	var $left_delimiter = '<{';
	var $right_delimiter = '}>';

	var $template_dir = XOOPS_THEME_PATH;
	var $cache_dir = XOOPS_CACHE_PATH;
	var $compile_dir = XOOPS_COMPILE_PATH;

	function XoopsTpl() {
		global $xoopsConfig;

		$this->compile_id = $xoopsConfig['template_set'] . '-' . $xoopsConfig['theme_set'];
		$this->_compile_id = $this->compile_id;
		$this->compile_check = ( $xoopsConfig['theme_fromfile'] == 1 );
		$this->plugins_dir = array(
			XOOPS_ROOT_PATH . '/class/smarty/xoops_plugins',
			XOOPS_ROOT_PATH . '/class/smarty/plugins',
		);
		if ( $xoopsConfig['debug_mode'] ) {
			$this->debugging_ctrl = 'URL';
		    if ( $xoopsConfig['debug_mode'] == 3 ) {
		    	$this->debugging = true;
		    }
		}
		$this->Smarty();

		$this->assign( array(
			'xoops_url' => XOOPS_URL,
			'xoops_rootpath' => XOOPS_ROOT_PATH,
			'xoops_langcode' => _LANGCODE,
			'xoops_charset' => _CHARSET,
			'xoops_version' => XOOPS_VERSION,
			'xoops_upload_url' => XOOPS_UPLOAD_URL
		) );
	}

	/**
	 * Renders output from template data
	 *
	 * @param   string  $data		The template to render
	 * @param	bool	$display	If rendered text should be output or returned
	 * @return  string  Rendered output if $display was false
	 **/
    function fetchFromData( $tplSource, $display = false, $vars = null ) {
        if ( !function_exists('smarty_function_eval') ) {
            require_once SMARTY_DIR . '/plugins/function.eval.php';
        }
    	if ( isset( $vars ) ) {
    		$oldVars = $this->_tpl_vars;
    		$this->assign( $vars );
	        $out = smarty_function_eval( array('var' => $tplSource), $this );
        	$this->_tpl_vars = $oldVars;
        	return $out;
    	}
        return smarty_function_eval( array('var' => $tplSource), $this );
    }

    function touch( $resourceName ) {
    	$isForced = $this->force_compile;
    	$this->force_compile = true;
    	$this->clear_cache( $resourceName );
    	$result = $this->_compile_resource( $resourceName, $this->_get_compile_path( $resourceName ) );
    	$this->force_compile = $isForced;
    	return $result;
	}

    /**
     * @deprecated DO NOT USE THESE METHODS, ACCESS THE CORRESPONDING PROPERTIES INSTEAD
     */
	function xoops_setTemplateDir($dirname) {		$this->template_dir = $dirname;			}
	function xoops_getTemplateDir() {				return $this->template_dir;				}
	function xoops_setDebugging($flag=false) {		$this->debugging = is_bool($flag) ? $flag : false;	}
	function xoops_setCaching( $num = 0 ) {			$this->caching = (int)$num;				}
	function xoops_setCompileDir($dirname) {		$this->compile_dir = $dirname;			}
	function xoops_setCacheDir($dirname) {			$this->cache_dir = $dirname;			}
	function xoops_canUpdateFromFile() {			return $this->compile_check;			}
	function xoops_fetchFromData( $data ) {			return $this->fetchFromData( $data );	}
	function xoops_setCacheTime( $num = 0 ) {
		if ( ( $num = (int)$num ) <= 0) {
			$this->caching = 0;
		} else {
			$this->cache_lifetime = $num;
		}
	}
}

/**
 * function to update compiled template file in templates_c folder
 *
 * @param   string  $tpl_id
 * @param   boolean $clear_old
 * @return  boolean
 **/
function xoops_template_touch($tpl_id, $clear_old = true) {
	$tplfile_handler =& xoops_gethandler('tplfile');
	$tplfile =& $tplfile_handler->get($tpl_id);

	if ( is_object($tplfile) ) {
		$file = $tplfile->getVar( 'tpl_file', 'n' );
		$tpl = new XoopsTpl();
		return $tpl->touch( "db:$file" );
	}
	return false;
}

/**
 * Clear the module cache
 *
 * @param   int $mid    Module ID
 * @return
 **/
function xoops_template_clear_module_cache($mid)
{
	$block_arr = XoopsBlock::getByModule($mid);
	$count = count($block_arr);
	if ($count > 0) {
		$xoopsTpl = new XoopsTpl();
		$xoopsTpl->xoops_setCaching(2);
		for ($i = 0; $i < $count; $i++) {
			if ($block_arr[$i]->getVar('template') != '') {
				$xoopsTpl->clear_cache('db:'.$block_arr[$i]->getVar('template'), 'blk_'.$block_arr[$i]->getVar('bid'));
			}
		}
	}
}
?>