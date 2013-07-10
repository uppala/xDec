<?php
/**
 * Developer: javascript Kadyan
 * Date: 12/05/13
 * Time: 3:52 PM
 */
if(!defined('xDEC')){
    echo "c indirect access".$_SERVER['PHP_SELF'];
exit;
}
class Security {
    //TODO clean is for sql filtering
    public function clean($str){
        return addslashes(strip_tags(htmlspecialchars($str)));
    }

    public function mysql($str){
        return strip_tags(htmlspecialchars($str));
    }
}