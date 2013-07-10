<?php
if(!defined('xDEC')) exit;
//TODO Need re-consideration
/**
 * Class Extension
 */
class Extension {
    /**
     * @var
     */
    private $extensions;
    /**
     * @var
     */
    private $namespaces;

    /**
     *
     */
    public function load(){
        $this->extensions = array();
        $this->namespaces = array();
        $dh = @opendir(EXT);
        while (($filename = readdir ($dh))) {
            if($filename == '.' || $filename == '..') continue;
            if(is_dir(EXT.$filename)){
                if(file_exists(EXT.$filename.'/start.php')){
                    require_once(EXT.$filename.'/start.php');
                    //if(strlen($namespace) > 0 && !preg_match('/xDec/',$namespace) && !in_array($namespace, $this->namespaces) && function_exists('\\'.$namespace.'\\register'))
                    {
                        //$namespace = '\\'.trim($namespace,'\\').'\\';
                        //set('ext:'.$filename,new $filename);
                        $this->extensions[]['name'] = $filename;
                        $this->extensions[]['namespace'] = "";//$namespace;
                        $this->extensions[]['data'] = call_user_func('register');
                    }
                }
            }
        }
    }

    /**
     *
     */
    public function head_start(){
        foreach($this->extensions as $ext){
            if(isset($ext['data']['head_start']) && function_exists($ext['data']['namespace'].$ext['data']['head_start'])){
                call_user_func($ext['data']['namespace'].$ext['data']['head_start']);
            }
        }
    }

    /**
     *
     */
    public function head_end(){
        foreach($this->extensions as $ext){
            if(isset($ext['data']['head_end']) && function_exists($ext['data']['namespace'].$ext['data']['head_end'])){
                call_user_func($ext['data']['namespace'].$ext['data']['head_end']);
            }
        }
    }

    /**
     *
     */
    public function body_start(){
        foreach($this->extensions as $ext){
            if(isset($ext['data']['body_start']) && function_exists($ext['data']['namespace'].$ext['data']['body_start'])){
                call_user_func($ext['data']['namespace'].$ext['data']['body_start']);
            }
        }
    }

    /**
     *
     */
    public function body_end(){
        foreach($this->extensions as $ext){
            if(isset($ext['data']['body_end']) && function_exists($ext['data']['namespace'].$ext['data']['body_end'])){
                call_user_func($ext['data']['namespace'].$ext['data']['body_end']);
            }
        }
    }
}