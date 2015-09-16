<?php
  session_start();

  $GLOBALS['config']=array(
    'mysql' => array(
      'host' => '127.0.0.1',
      'username' => 'root',
      'passowrd' => 'Madison1',
      'db' => 'lr'
    ),
    'remember' => array(
      'cookie_name' => 'hash',
      'cookie_expiry' => 604800
    ),
    'sessions' => array(
      'session_name' => 'user'
    )
  );
  // Autoload (Require_once) function spl = standard php library
spl_autoload_register(function($class) {
  require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';

?>
