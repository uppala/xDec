<?php
/**
 * Developer: javascript Kadyan
 * Date: 12/05/13
 * Time: 4:05 PM
 */
if(!defined('xDEC')){
    echo "c indirect access".$_SERVER['PHP_SELF'];
exit;
}
define('LOG_FILE', BASE.'xDec.log');
define('ERROR_LOG_FILE', BASE.'xDecErrors.log');
class Logger {
    public function custom_log($file, $log){
           $fp = fopen($file,'a');
           fwrite($fp,$log."\n");
           fclose($fp);
    }
    public function log($log){
        $this->custom_log(LOG_FILE,$log);
    }
    public function error($log){
        $this->custom_log(ERROR_LOG_FILE, $log);
    }
}