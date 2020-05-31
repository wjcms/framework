<?php

namespace wjcms\framework\config;


/**
 *database 

 */
class Config
{
    /**
     * [load 方法]
     * @return [type] [description]
     */
    public function load()
    {
        // echo '123';
        foreach(glob(BASE_PATH.'/config/*') as $file){
            $info= pathinfo($file);
            $this->config[$info['filename']] = include $file;
        }
        // dump($this->config);
    }

    public function set($name,$value){

        // return $this->config[$name];
        $tmp = &$this->config;
        foreach(explode('.',$name) as $key){
            $tmp = &$tmp[$key];
        }
        $tmp=$value;  
    }

    public function get($name,$default=null){

        // return $this->config[$name];
        $tmp = $this->config;
        foreach(explode('.',$name) as $key){
            if (!isset($tmp[$key])) return $default; 
            $tmp = &$tmp[$key];
        }
        return $tmp;    
    }


}

