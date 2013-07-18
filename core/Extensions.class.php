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
                if(file_exists(EXT.$filename.'/'.$filename.'.php')){
                    require_once(EXT.$filename.'/'.$filename.'.php');
                    {
                        if($filename instanceof Extension){
                            $this->extensions[]['name'] = $filename;
                            $this->extensions[]['data'] = new $filename;
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
            $ext['data']->head_start();
        }
    }

    /**
     *
     */
    public function head_end(){
        foreach($this->extensions as $ext){
            $ext['data']->head_end();
        }
    }

    /**
     *
     */
    public function body_start(){
        foreach($this->extensions as $ext){
            $ext['data']->body_start();
        }
    }

    /**
     *
     */
    public function body_end(){
        foreach($this->extensions as $ext){
            $ext['data']->body_end();
        }
    }
}