<?php
/**
 * Developer: Rahul Kadyan
 * Date: 16/05/13
 * Time: 3:40 PM
 */
if(!defined('xDEC')){
    echo "c indirect access".$_SERVER['PHP_SELF'];
exit;
}
class Pages {
    private function start_head(){
        echo '<!DOCTYPE html>
              <html>
                <head>
                    <base href="'.get('home_url').'">
                    <title>';
                        get('Router')->title();
              echo '</title>';
        get('Extension')->head_start();
    }

    private function build_head(){
        get('Router')->head();
    }

    private function end_head(){
        get('Extension')->head_end();
    }

    private function start_body(){
        echo '<body>';
        get('Extension')->body_start();
    }

    private function build_body(){
        get('Router')->body();
    }

    private function end_body(){
        get('Extension')->body_end();
        echo '</body></html>';
    }

    function get(){
        if(get('Router')->navigate() == null){

            $this->start_head();
            $this->build_head();
            $this->end_head();

            $this->start_body();
            $this->build_body();
            $this->end_body();
        } else {
            $this->build_body();
        }
    }
}