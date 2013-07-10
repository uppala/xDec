<?php
/**
 * Developer: Rahul Kadyan
 * Date: 16/05/13
 * Time: 3:58 PM
 */
if(!defined('xDEC')){
    echo "c indirect access".$_SERVER['PHP_SELF'];
exit;
}
interface Page{
    function __head__();
    function __title__($var);
    function index($var);
}