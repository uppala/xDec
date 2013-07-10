<?php
/**
 * Developer: javascript Kadyan
 * Date: 12/05/13
 * Time: 8:05 PM
 */
if(!defined('xDEC')){
    echo "c indirect access".$_SERVER['PHP_SELF'];
exit;
}
class Session {
    public function user(){
        if(isset($_SESSION['xDecUSER']))
            return $_SESSION['xDecUSER'];
        return null;
    }
    public function isUser(){
        if(isset($_SESSION['xDecUSER']))
            return true;
        return false;
    }
    public function setUser($user){
        $_SESSION['xDecUSER'] = $user;
    }
    public function unsetUser(){
        if(isset($_SESSION['xDecUSER']))
            unset($_SESSION['xDecUSER']);
        session_destroy();
        $_SESSION = array();
    }
    public function save(){
        if(isset($_SESSION['xDecUSER'])){
            get('Database')->insert('login_session',array('session_id'=>session_id(),'user_id'=>$_SESSION['xDecUSER']['id'],'ip'=>$_SERVER['HTTP_HOST'],'agent'=>$_SERVER['HTTP_USER_AGENT']));
        }
    }
}