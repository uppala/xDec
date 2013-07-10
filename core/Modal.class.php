<?php
/**
 * Developer: javascript Kadyan
 * Date: 13/05/13
 * Time: 7:33 PM
 */
if(!defined('xDEC')){
    echo "c indirect access".$_SERVER['PHP_SELF'];
exit;
}
class Modal {
    private $table;
    private $fields;
    public function __construct(){

        $this->table = array(
            'login'=>'login',
            'login_history'=>'login_history',
            'session'=>'session',
            'event'=>'events',
            'complaints'=>'complaints',
            'users'=>'users',
            'new'=> 'new'
        );
        $this->fields = array(
            'login'=>array(
                'id'=>'id',
                'user'=>'username',
                'pass'=>'password',
                'timestamp'=>'timestamp',
                'permissions'=>'permissions',
                'field'=>'field'
            ),
            'login_history'=>array(
                'user_id'=>'user_id',
                'session_id'=>'session_id',
                'ip'=>'remote_ip',
                'device'=>'user_agent_string',
                'timestamp'=>'timestamp',
                'id'=>'id',
                'status'=>'login_status'
            ),
            'session'=>array(
                'session'=>'session_id',
                'user'=>'user_id',
                'timestamp'=>'timestamp'
            ),
            'event' => array(
                'id' => 'id',
                'title' => 'title',
                'color' => 'color',
                'description' => 'description',
                'venue'=>'venue',
                'day'=>'day',
                'dateTime'=>'dateTime'
            ),
            'complaints' => array(
                'id' => 'id',
                'complainer' => 'webmail',
                'title' => 'title',
                'to' => 'to',
                'complaint' => 'detail',
                'timestamp' => 'timestamp',
                'comment' => 'comment'
            ),
            'users' => array(
                'id' => 'id',
                'webmail' => 'webmail',
                'mail' => 'mail',
                'name' => 'name',
                'facebook' => 'facebook'
            ),
            'new' => array(
                'id' => 'id',
                'title' => 'title',
                'color' => 'color',
                'detail' => 'detail',
                'webmail' => 'webmail',
                'date' => 'date'
            )
        );
    }
    public function getTable($key){
        if(array_key_exists($key, $this->table)) return $this->table[$key];
        else trigger_error("Unexpected $key; NOT FOUND IN table DATABASE; [caller function: ".var_dump(debug_backtrace()), E_USER_NOTICE);
    }

    public function getField($table,$key){
        if(array_key_exists($table, $this->table)&&array_key_exists($key,$this->fields[$table])) return $this->fields[$table][$key];
        else trigger_error("Unexpected $table or $key; NOT FOUND IN table DATABASE; [caller function: ".var_dump(debug_backtrace()), E_USER_NOTICE);
    }

    public function getAssoc($table,$val){
        $ret = array();
        $i=0;
        if(array_key_exists($table,$this->table)){
            foreach($this->fields[$table] as $key => $dump){
                if($i == count($val)) break;
                $ret[$key] = get('Security')->mysql($val[$i++]);
            }
        }
        return $ret;
    }

}