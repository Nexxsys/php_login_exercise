<?php
  session_start();

  $GLOBALS['config']=array(
    'mysql' => array(
      'host' => '127.0.0.1',
      'username' => 'root',
      'password' => 'Madison1',
      'db' => 'lr'
    ),
    'remember' => array(
      'cookie_name' => 'hash',
      'cookie_expiry' => 604800 //time in seconds
    ),
    'sessions' => array(
      'session_name' => 'user'
    )
  );
  // Autoload (Require_once) function spl = standard php library

spl_autoload_register(function($class) { //this is callend when a class is instantiated and the class instantiated is what is passed into the function.  i.e. DB
  require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';

?>
