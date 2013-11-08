<?php
//
// +----------------------------------------------------------------------+
// | 分页类                                                               |
// +----------------------------------------------------------------------+
// | Copyright (c) 2001 NetFish Software                                  |
// |                                                                      |
// | Author: whxbb(whxbbh@21cn.com)                                       |
// +----------------------------------------------------------------------+
//
// $Id: page.php,v 1.4 2008/08/11 16:07:00 root Exp $
//
// 禁止直接访问该页面
if (basename($HTTP_SERVER_VARS['PHP_SELF']) == "pager.class.php") {
    header("HTTP/1.0 404 Not Found");
}
/**
* 分页类
* Purpose
* 分页
*
* @author  : whxbb(whxbb@21cn.com)
* @version : 0.1
* @date    :  2001/8/2
*/
class Pager
{
    /** 总信息数 */
    var $infoCount;
    /** 总页数 */
    var $pageCount;
    /** 每页显示条数　*/
    var $items;
    /** 当前页码 */
    var $pageNo;
    /** 查询的起始位置　*/
    var $startPos;
    var $nextPageNo;
    var $prevPageNo;
    
    function Pager($infoCount, $items, $pageNo)
    {
        $this->infoCount = $infoCount;
        $this->items     = $items;
        $this->pageNo    = $pageNo;
        $this->pageCount = $this->GetPageCount();
        $this->AdjustPageNo();
        $this->startPos  = $this->GetStartPos();
    }
    function AdjustPageNo()
    {
        if($this->pageNo == '' || $this->pageNo < 1)
            $this->pageNo = 1;
        if ($this->pageNo > $this->pageCount)
            $this->pageNo = $this->pageCount;
    }
    /**
     * 下一页
     */
    function GoToNextPage()
    {
        $nextPageNo = $this->pageNo + 1;
        if ($nextPageNo > $this->pageCount)
        {
            $this->nextPageNo = $this->pageCount;
            return false;
        }
        $this->nextPageNo = $nextPageNo;
        return true;
    }
    /**
     * 上一页
     */
    function GotoPrevPage()
    {
        $prevPageNo = $this->pageNo - 1;
        if ($prevPageNo < 1)
        {
            $this->prevPageNo = 1;
            return false;
        }
        $this->prevPageNo = $prevPageNo;
        return true;
    }
    function GetPageCount()
    {
        return ceil($this->infoCount / $this->items);
    }
    function GetStartPos()
    {
        return ($this->pageNo - 1)  * $this->items;
    }
}
?>
 
 
