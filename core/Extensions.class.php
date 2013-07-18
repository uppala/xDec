<?php
if(!defined('xDEC')) exit;
//TODO Need re-consideration
/**
 * Class Extension
 */
class Extensions {
    /**
     * @var
     */
    private $extensions;

    /**
     *
     */
    public function load(){
        $this->extensions = array();
        $dh = @opendir(EXT);
        while (($filename = readdir ($dh))) {
            if($filename == '.' || $filename == '..') continue;
            if(is_dir(EXT.$filename)){
                if(file_exists(EXT.$filename.'/'.$filename.'.php')){
                    require_once(EXT.$filename.'/'.$filename.'.php');
                    {
                        if(in_array('Extension', class_implements($filename))){
                            $this->extensions[$filename] = new $filename();
                        }
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
            $ext->head_start();
        }
    }
    
    function get($key){
        if(in_array($key, $this->extensions)) return $this->extensions[$key];
        return null;
    }

    /**
     *
     */
    public function head_end(){
        foreach($this->extensions as $ext){
            $ext->head_end();
        }
    }

    /**
     *
     */
    public function body_start(){
        foreach($this->extensions as $ext){
            $ext->body_start();
        }
    }

    /**
     *
     */
    public function body_end(){
        foreach($this->extensions as $ext){
            $ext->body_end();
        }
    }
}
