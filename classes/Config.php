<?php
  class Config {
    public static function get($path = null) {
      if($path) {
        $config = $GLOBALS['config'];
        $path = explode('/', $path);

        //print_r($path);
        foreach($path as $bit) {
          //echo $bit, ' ';
          if(isset($config[$bit])){
            //echo 'Set';
              $config = $config[$bit];
          }
        }
        
        return $config;
        
      }
    }
  }
?>
