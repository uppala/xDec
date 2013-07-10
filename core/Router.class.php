<?php
if(!defined('xDEC')) exit;
//TODO add different kind of url support
/**
 * Class Router
 * @package xDec
 */
class Router
{
    /**
     *
     */
    public function __construct(){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('?',$uri);
        $uri = $uri[0];
        $uri = substr($uri, strlen(DIR));
        $segments = explode('/',trim($uri, '/'));
        switch(count($segments)){
            case 0: set('page', 'home'); set('request', 'index'); break;
            case 1: if($segments[0] == ''){
                        set('page', HOME_CLASS); set('request', 'index');
                    } else {
                        set('page', $segments[0]); set('request', 'index');
                    } break;
            case 2: set('page', $segments[0]); set('request', $segments[1]); break;
            default: set('page', $segments[0]); set('request', $segments[1]);
                        //TODO replace with security class once done
                     set('vars', addslashes(strip_tags(htmlspecialchars(urldecode(substr($uri, strlen('/'.$segments[0].'/'.$segments[1].'/'))))))); break;
        }
        set('uri', BASE_URL.$_SERVER['REQUEST_URI']);
    }
    var $class, $method;
    public function navigate(){
        if(file_exists(CONTENT.get('page').'.page.php')){
            require_once(CONTENT.get('page').'.page.php');
            $class = get('page');
            $this->class = new $class;
            if( in_array(get('request'), get_class_methods($class)) ){
                $this->method = get('request');
                if(in_array('method_meta', get_class_methods($class)) ){
                    return $this->class->method_meta(get('request'));
                }
            } else {
                require_once(CONTENT.'error.page.php');
                $class = 'error';
                $this->class = new $class;
                $this->method = '_404';
            }
        } else {
            require_once(CONTENT.'error.page.php');
            $class = 'error';
            $this->class = new $class;
            $this->method = '_404';
        }
        return null;
    }

    public function head(){
        $this->class->__head__(get('vars'));
    }

    public function title(){
        $this->class->__title__(get('vars'));
    }

    public function body(){
        $method = $this->method;
        $this->class->$method(get('vars'));
    }

    public function redirect($url){
        header("Location: $url");
    }
    /**
     *
     */
    private function __clone(){
    }

}