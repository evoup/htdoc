<?php
// $Id: searchform.php,v 1.1 2008/02/28 12:17:14 cvs Exp $
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
if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

// create form
$search_form = new XoopsThemeForm(_SR_SEARCH, "search", "search.php", 'get');

// create form elements
$search_form->addElement(new XoopsFormText(_SR_KEYWORDS, "query", 30, 255, htmlspecialchars(stripslashes(implode(" ", $queries)), ENT_QUOTES)), true);
$type_select = new XoopsFormSelect(_SR_TYPE, "andor", $andor);
$type_select->addOptionArray(array("AND"=>_SR_ALL, "OR"=>_SR_ANY, "exact"=>_SR_EXACT));
$search_form->addElement($type_select);
if (!empty($mids)) {
	$mods_checkbox = new XoopsFormCheckBox(_SR_SEARCHIN, "mids[]", $mids);
} else {
	$mods_checkbox = new XoopsFormCheckBox(_SR_SEARCHIN, "mids[]", $mid);
}
if (empty($modules)) {
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('hassearch', 1));
    $criteria->add(new Criteria('isactive', 1));
    if (!empty($available_modules)) {
        $criteria->add(new Criteria('mid', "(".implode(',', $available_modules).")", 'IN'));
    }
    $module_handler =& xoops_gethandler('module');
    $mods_checkbox->addOptionArray($module_handler->getList($criteria));
}
else {
    foreach ($modules as $mid => $module) {
        $module_array[$mid] = $module->getVar('name');
    }
    $mods_checkbox->addOptionArray($module_array);
}
$search_form->addElement($mods_checkbox);
if ($xoopsConfigSearch['keyword_min'] > 0) {
	$search_form->addElement(new XoopsFormLabel(_SR_SEARCHRULE, sprintf(_SR_KEYIGNORE, $xoopsConfigSearch['keyword_min'])));
}
$search_form->addElement(new XoopsFormHidden("action", "results"));
$search_form->addElement(new XoopsFormHiddenToken('id'));
$search_form->addElement(new XoopsFormButton("", "submit", _SR_SEARCH, "submit"));
?>