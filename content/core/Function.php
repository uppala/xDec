<?php
if(!defined('xDEC')){
    echo "f indirect access".$_SERVER['PHP_SELF'];
exit;
}
/**
 * Developer: javascript Kadyan
 * Date: 12/05/13
 * Time: 1:20 PM
 */
function get($key)
{
    return Registry::get($key);
}

function set($key, $value)
{
    return Registry::set($key, $value);
}

function remove($key)
{
    return Registry::remove($key);
}

function is_ssl() {
    if ( isset($_SERVER['HTTPS']) ) {
        if ( 'on' == strtolower($_SERVER['HTTPS']) )
            return true;
        if ( '1' == $_SERVER['HTTPS'] )
            return true;
    } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        return true;
    }
    return false;
}

function error_handler($errno, $errstr, $errfile, $errline){
    if (!(error_reporting() & $errno)) {
        return;
    }
    switch($errno){
        case E_ERROR:
        case E_COMPILE_ERROR:
        case E_CORE_ERROR:
        case E_RECOVERABLE_ERROR:
            get(LOGGER)->error("#$errno $errstr in `$errfile` at line no $errline");
            break;
        default:
            get(LOGGER)->log("#$errno $errstr in `$errfile` at line no $errline");
            break;
    }

}
function directory_size($directory) {
    $directorySize=0;
    if ($dh = @opendir($directory)) {
        while (($filename = readdir ($dh))) {
            if ($filename != "." && $filename != "..")
            {
                if (is_file($directory."/".$filename))
                    $directorySize += filesize($directory."/".$filename);
                if (is_dir($directory."/".$filename))
                    $directorySize += directory_size($directory."/".$filename);
            }
        }
    }
    @closedir($dh);
    return $directorySize;
}