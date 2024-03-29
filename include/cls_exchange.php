<?php

/**
 * ECSHOP 后台自动操作数据库的类文件
 * ============================================================================
 * 版权所有 (C) 2005-2007 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com
 * ----------------------------------------------------------------------------
 * 这是一个免费开源的软件；这意味着您可以在不用于商业目的的前提下对程序代码
 * 进行修改、使用和再发布。
 * ============================================================================
 * $Author: root $
 * $Date: 2008/08/11 16:07:00 $
 * $Id: cls_exchange.php,v 1.3 2008/08/11 16:07:00 root Exp $
*/

if (!defined('IN_EVP'))
{
    die('Hacking attempt');
}

/*------------------------------------------------------ */
//-- 该类用于与数据库数据进行交换
/*------------------------------------------------------ */
class exchange
{
    var $table;
    var $db;
    var $id;
    var $name;
    var $error_msg;

    /**
     * 构造函数
     *
     * @access  public
     * @param   string       $table       数据库表名
     * @param   dbobject     $db          aodb的对象
     * @param   string       $id          数据表主键字段名
     * @param   string       $name        数据表重要段名
     *
     * @return void
     */
    function exchange($table, &$db , $id, $name)
    {
        $this->table     = $table;
        $this->db        = &$db;
        $this->id        = $id;
        $this->name      = $name;
        $this->error_msg = '';
    }

    /**
     * 判断表中某字段是否重复，若重复则中止程序，并给出错误信息
     *
     * @access  public
     * @param   string  $col    字段名
     * @param   string  $name   字段值
     * @param   integer $id
     *
     * @return void
     */
    function is_only($col, $name, $id = 0, $where='')
    {
        $sql = 'SELECT COUNT(*) FROM ' .$this->table. " WHERE $col = '$name'";
        $sql .= empty($id) ? '' : ' AND ' . $this->id . " <> '$id'";
        $sql .= empty($where) ? '' : ' AND ' .$where;

        return ($this->db->getOne($sql) == 0);
    }

    /**
     * 返回指定名称记录再数据表中记录个数
     *
     * @access  public
     * @param   string      $col        字段名
     * @param   string      $name       字段内容
     *
     * @return   int        记录个数
     */
    function num($col, $name, $id = 0)
    {
        $sql = 'SELECT COUNT(*) FROM ' .$this->table. " WHERE $col = '$name'";
        $sql .= empty($id) ? '' : ' AND '. $this->id ." != '$id' ";

        return $this->db->getOne($sql);
    }

    /**
     * 编辑某个字段
     *
     * @access  public
     * @param   string      $set        要更新集合如" col = '$name', value = '$value'"
     * @param   int         $id         要更新的记录编号
     *
     * @return bool     成功或失败
     */
    function edit($set, $id)
    {
        $sql = 'UPDATE ' . $this->table . ' SET ' . $set . " WHERE $this->id = '$id'";
        if ($this->db->query($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * 取得某个字段的值
     *
     * @access  public
     * @param   int     $id     记录编号
     * @param   string  $id     字段名
     *
     * @return string   取出的数据
     */
    function get_name($id, $name = '')
    {
        if (empty($name))
        {
            $name = $this->name;
        }

        $sql = "SELECT `$name` FROM " . $this->table . " WHERE $this->id = '$id'";

        return $this->db->getOne($sql);
    }

    /**
     * 删除条记录
     *
     * @access  public
     * @param   int         $id         记录编号
     *
     * @return bool
     */
    function drop($id)
    {
        $sql = 'DELETE FROM ' . $this->table . " WHERE $this->id = '$id'";

        return $this->db->query($sql);
    }
}

?>