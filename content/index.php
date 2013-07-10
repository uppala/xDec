<?php
/**
 * Developer: javascript Kadyan
 * Date: 12/05/13
 * Time: 1:37 PM
 */
session_start();
define('xDEC', true);
require_once(dirname(__FILE__).'/config.inc.php');
require_once(BASE.'bootstrap.php');
get('Pages')->get();
$end = time();