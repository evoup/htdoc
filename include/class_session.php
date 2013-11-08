<?php
/**
* @author 马秉尧
* @copyright (C) 2005 CoolCode.CN
这个类的使用很简单，在原来使用 session_start 的地方，替换成 $session = new session($db) 就可以了。$db 表示 sessions 表所在的数据库。

另外可以用 get 方法来获取某个用户的所有会话信息，通过 lists 方法来得到所有用户会话列表。这样就可以方便的管理用户会话了。


*/
//链接到不同的数据库，独立session数据库，大型网站可以参考
//require_once("class_mysql.php");

class session {
    var $db;
    function session(&$db) {
        $this->db = &$db; 
        session_module_name('user');
        session_set_save_handler(
            array(&$this, 'open'), 
            array(&$this, 'close'), 
            array(&$this, 'read'), 
            array(&$this, 'write'), 
            array(&$this, 'destroy'), 
            array(&$this, 'gc')
        );
        session_start();
    }
    function unserialize($data_value) {
        $vars = preg_split(
            '/([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\|/',
            $data_value, -1, PREG_SPLIT_NO_EMPTY |                
            PREG_SPLIT_DELIM_CAPTURE
        );
        for ($i = 0; $vars[$i]; $i++) {
            $result[$vars[$i++]] = unserialize($vars[$i]);    
        }
        return $result;
    }
    function open($path, $name) {
        return true;
    }
    function close() {
        return true;
    }
    function read($session_id) {
        $session_id = $this->db->escape_string($session_id);
        if ($row = $this->db->query("select * from `sessions` where `session_id` = '$session_id' limit 1")) {
            return $row['data_value'];
        }
        else {
            $this->db->query("insert into `sessions` set `session_id` = '$session_id'");
            return "";
        }
    }
    function write($session_id, $data_value) {
        $data = $this->unserialize($data_value);
        $session_id = $this->db->escape_string($session_id);
        $data_value = $this->db->escape_string($data_value);
        $this->db->query("update `sessions` set " 
                                . "`user_id` = '{$data['user_id']}', "
                                . "`data_value` = '$data_value', "
                                . "`last_visit` = null "
                                . "where `session_id` = '$session_id'");
        return true;
    }
    function destroy($session_id) {
        $session_id = $this->db->escape_string($session_id);
        $this->db->query("delete from `sessions` where `session_id` = '$session_id'");
        return true;
    }
    function gc($lifetime) {
        $this->db->query("delete from `sessions` where unix_timestamp(now()) - unix_timestamp(`last_visit`) > $lifetime");
        return true;
    }
    // get sessions by user_id
    function get($user_id) {
        $user_id = $this->db->escape_string($user_id);
        return $this->db->query("select * from `sessions` where `user_id` = '$user_id'");
    }
    // get sessions list
    function lists($page, $rows) {
        if ($page == 0) {
            return $this->db->query("select * from `sessions` order by `user_id`");
        }
        else {
            $start = ($page - 1) * $rows;
            return $this->db->query("select * from `sessions` order by `user_id` limit $start, $rows");
        }
    }
}
?>