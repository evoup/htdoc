<?php
// $Id: main.php,v 1.1 2008/02/28 12:17:27 cvs Exp $
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

if ( !is_object($xoopsUser) || !is_object($xoopsModule) || !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
    exit("Access Denied");
} else {
    include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php';
    include_once XOOPS_ROOT_PATH."/modules/system/admin/groups/groups.php";
    $op = "display";
    if ( isset($_POST) ) {
        foreach ( $_POST as $k => $v ) {
            $$k = $v;
        }
    }
    if ( isset($_GET['op']) ) {
        if ($_GET['op'] == "modify" || $_GET['op'] == "del") {
            $op = $_GET['op'];
            $g_id = $_GET['g_id'];
        }
    }

    // from finduser section
    if ( !empty($memberslist_id) && is_array($memberslist_id) ) {
        $op = "addUser";
        $uids =& $memberslist_id;
    }

    switch ($op) {
    case "modify":
        include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
        modifyGroup($g_id);
        break;
    case "update":
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header("admin.php?fct=groups&amp;op=adminMain", 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $system_catids = empty($system_catids) ? array() : $system_catids;
        $admin_mids = empty($admin_mids) ? array() : $admin_mids;
        $read_mids = empty($read_mids) ? array() : $read_mids;
        $read_bids = empty($read_bids) ? array() : $read_bids;
        $member_handler =& xoops_gethandler('member');
        $group =& $member_handler->getGroup($g_id);
        $group->setVar('name', $name);
        $group->setVar('description', $desc);
        // if this group is not one of the default groups
        if (!in_array($group->getVar('groupid'), array(XOOPS_GROUP_ADMIN, XOOPS_GROUP_USERS, XOOPS_GROUP_ANONYMOUS))) {
            if (count($system_catids) > 0) {
                $group->setVar('group_type', 'Admin');
            } else {
                $group->setVar('group_type', '');
            }
        }
        if (!$member_handler->insertGroup($group)) {
            xoops_cp_header();
            echo $group->getHtmlErrors();
            xoops_cp_footer();
        } else {
            $groupid = $group->getVar('groupid');
            $gperm_handler =& xoops_gethandler('groupperm');
            $criteria = new CriteriaCompo(new Criteria('gperm_groupid', $groupid));
            $criteria->add(new Criteria('gperm_modid', 1));
            $criteria2 = new CriteriaCompo(new Criteria('gperm_name', 'system_admin'));
            $criteria2->add(new Criteria('gperm_name', 'module_admin'), 'OR');
            $criteria2->add(new Criteria('gperm_name', 'module_read'), 'OR');
            $criteria2->add(new Criteria('gperm_name', 'block_read'), 'OR');
            $criteria->add($criteria2);
            $gperm_handler->deleteAll($criteria);
            if (count($system_catids) > 0) {
                array_push($admin_mids, 1);
                foreach ($system_catids as $s_cid) {
                    $sysperm =& $gperm_handler->create();
                    $sysperm->setVar('gperm_groupid', $groupid);
                    $sysperm->setVar('gperm_itemid', $s_cid);
                    $sysperm->setVar('gperm_name', 'system_admin');
                    $sysperm->setVar('gperm_modid', 1);
                    $gperm_handler->insert($sysperm);
                }
            }
            foreach ($admin_mids as $a_mid) {
                $modperm =& $gperm_handler->create();
                $modperm->setVar('gperm_groupid', $groupid);
                $modperm->setVar('gperm_itemid', $a_mid);
                $modperm->setVar('gperm_name', 'module_admin');
                $modperm->setVar('gperm_modid', 1);
                $gperm_handler->insert($modperm);
            }
            array_push($read_mids, 1);
            foreach ($read_mids as $r_mid) {
                $modperm =& $gperm_handler->create();
                $modperm->setVar('gperm_groupid', $groupid);
                $modperm->setVar('gperm_itemid', $r_mid);
                $modperm->setVar('gperm_name', 'module_read');
                $modperm->setVar('gperm_modid', 1);
                $gperm_handler->insert($modperm);
            }
            foreach ($read_bids as $r_bid) {
                $blockperm =& $gperm_handler->create();
                $blockperm->setVar('gperm_groupid', $groupid);
                $blockperm->setVar('gperm_itemid', $r_bid);
                $blockperm->setVar('gperm_name', 'block_read');
                $blockperm->setVar('gperm_modid', 1);
                $gperm_handler->insert($blockperm);
            }
            redirect_header("admin.php?fct=groups&amp;op=adminMain",1,_AM_DBUPDATED);
        }
        break;
    case "add":
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header("admin.php?fct=groups&amp;op=adminMain", 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (!$name) {
            xoops_cp_header();
            echo _AM_UNEED2ENTER;
            xoops_cp_footer();
            exit();
        }
        $system_catids = empty($system_catids) ? array() : $system_catids;
        $admin_mids = empty($admin_mids) ? array() : $admin_mids;
        $read_mids = empty($read_mids) ? array() : $read_mids;
        $read_bids = empty($read_bids) ? array() : $read_bids;
        $member_handler =& xoops_gethandler('member');
        $group =& $member_handler->createGroup();
        $group->setVar("name", $name);
        $group->setVar("description", $desc);
        if (count($system_catids) > 0) {
            $group->setVar("group_type", 'Admin');
        }
        if (!$member_handler->insertGroup($group)) {
            xoops_cp_header();
            echo $group->getHtmlErrors();
            xoops_cp_footer();
        } else {
            $groupid = $group->getVar('groupid');
            $gperm_handler =& xoops_gethandler('groupperm');
            if (count($system_catids) > 0) {
                array_push($admin_mids, 1);
                foreach ($system_catids as $s_cid) {
                    $sysperm =& $gperm_handler->create();
                    $sysperm->setVar('gperm_groupid', $groupid);
                    $sysperm->setVar('gperm_itemid', $s_cid);
                    $sysperm->setVar('gperm_name', 'system_admin');
                    $sysperm->setVar('gperm_modid', 1);
                    $gperm_handler->insert($sysperm);
                }
            }
            foreach ($admin_mids as $a_mid) {
                $modperm =& $gperm_handler->create();
                $modperm->setVar('gperm_groupid', $groupid);
                $modperm->setVar('gperm_itemid', $a_mid);
                $modperm->setVar('gperm_name', 'module_admin');
                $modperm->setVar('gperm_modid', 1);
                $gperm_handler->insert($modperm);
            }
            array_push($read_mids, 1);
            foreach ($read_mids as $r_mid) {
                $modperm =& $gperm_handler->create();
                $modperm->setVar('gperm_groupid', $groupid);
                $modperm->setVar('gperm_itemid', $r_mid);
                $modperm->setVar('gperm_name', 'module_read');
                $modperm->setVar('gperm_modid', 1);
                $gperm_handler->insert($modperm);
            }
            foreach ($read_bids as $r_bid) {
                $blockperm =& $gperm_handler->create();
                $blockperm->setVar('gperm_groupid', $groupid);
                $blockperm->setVar('gperm_itemid', $r_bid);
                $blockperm->setVar('gperm_name', 'block_read');
                $blockperm->setVar('gperm_modid', 1);
                $gperm_handler->insert($blockperm);
            }
            redirect_header("admin.php?fct=groups&amp;op=adminMain",1,_AM_DBUPDATED);
        }
        break;
    case "del":
        xoops_cp_header();
        xoops_confirm(array('fct' => 'groups', 'op' => 'delConf', 'g_id' => $g_id), 'admin.php', _AM_AREUSUREDEL);
        xoops_cp_footer();
        break;
    case "delConf":
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header("admin.php?fct=groups&amp;op=adminMain", 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (intval($g_id) > 0 && !in_array($g_id, array(XOOPS_GROUP_ADMIN, XOOPS_GROUP_USERS, XOOPS_GROUP_ANONYMOUS))) {
            $member_handler =& xoops_gethandler('member');
            $group =& $member_handler->getGroup($g_id);
            $member_handler->deleteGroup($group);
            $gperm_handler =& xoops_gethandler('groupperm');
            $gperm_handler->deleteByGroup($g_id);
        }
        redirect_header("admin.php?fct=groups&amp;op=adminMain",1,_AM_DBUPDATED);
        break;
    case "addUser":
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header("admin.php?fct=groups&amp;op=adminMain", 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $member_handler =& xoops_gethandler('member');
        $size = count($uids);
        for ( $i = 0; $i < $size; $i++ ) {
            $member_handler->addUserToGroup($groupid, $uids[$i]);
        }
        redirect_header("admin.php?fct=groups&amp;op=modify&amp;g_id=".$groupid."",0,_AM_DBUPDATED);
        break;
    case "delUser":
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header("admin.php?fct=groups&amp;op=adminMain", 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (intval($groupid) > 0) {
            $member_handler =& xoops_gethandler('member');
            $memstart = isset($memstart) ? intval($memstart) : 0;
            if ($groupid == XOOPS_GROUP_ADMIN) {
                if ($member_handler->getUserCountByGroup($groupid) > count($uids)){
                    $member_handler->removeUsersFromGroup($groupid, $uids);
                }
            } else {
                $member_handler->removeUsersFromGroup($groupid, $uids);
            }
            redirect_header('admin.php?fct=groups&amp;op=modify&amp;g_id='.$groupid.'&amp;memstart='.$memstart,0,_AM_DBUPDATED);
        }
        break;
    case "display":
        default:
        displayGroups();
        break;
    }
}
?>