<?php
if(!defined('xDEC')){
    //header("Location: http://".$_SERVER['HTTP_HOST']);
    echo "script access deny";
    exit;
}
/**
 * Developer: javascript Kadyan
 * Date: 12/05/13
 * Time: 3:52 PM
 */

/**
 * Class Auth
 * Provides basic authentication
 * @package xDec
 */
class Auth {
    /**
     * @var string $table name of login table
     */
    /**
     * @var string $field_user name of username column
     */
    /**
     * @var string $field_pass name of password column
     */
    private static $table = 'login', $field_user, $field_pass;

    /**
     * Simple login
     * @param string $user username
     * @param string $pass password
     * @return bool true for successful login else false
     */
    public function login($user, $pass){
        self::$table = get('Modal')->getTable('login');
        self::$field_user = get('Modal')->getField('login', 'user');
        self::$field_pass = get('Modal')->getField('login', 'pass');
        $user = get('Security')->clean($user);
        $pass = md5($pass);
        get('Database')->select(
            self::$table,
            array(
                get('Modal')->getField('login','id'),
                get('Modal')->getField('login','user'),
                get('Modal')->getField('login','permissions'),
                get('Modal')->getField('login','field')
            ), self::$field_user."=\"$user\" AND ".self::$field_pass."=\"$pass\"");
        if(is_object(get('Database')->result()) && get('Database')->result()->num_rows == 1){
            $user_data = get('Database')->row();
            set('logged_in', $user_data['id']);
            get('Session')->setUser($user_data);
            get('Database')->insert(get('Modal')->getTable('login_history'), get('Modal')->getAssoc('login_history',array($user_data['id'],session_id(),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'])));
            return true;
        }
        return false;
    }

    /**
     * logout function
     */
    public function logout(){
        remove('logged_in');
        get('Session')->unsetUser();
    }

    /**
     * @return bool true for logged in else false
     */
    public function logged(){
        if(get('Session')->isUser()){
            return true;
        }
        return false;
    }

    /**
     * @return int user id for logged in user otherwise null
     */
    public function user(){
        if($this->logged()){
            $user = get('Session')->user();
            return $user['id'];
        }
        return null;
    }
}