<?php
if(!defined('xDEC')) exit;
//TODO add advanced authentication techniques
//TODO remove dependency on Database class
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
    }

    /**
     * logout function
     */
    public function logout(){
    }

    /**
     * @return bool true for logged in else false
     */
    public function logged(){
    }
}