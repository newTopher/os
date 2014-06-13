<?php

  define('APP_DEBUG',TRUE);
  define('CONF_PATH','./config/');
  define('TMPL_PATH','./tpl/');
  defined('APP_PATH') 	or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');
  define('RUNTIME_PATH','./logs/');
  defined('RUNTIME_PATH') or define('RUNTIME_PATH',APP_PATH.'Runtime/');
  require './Core/weikucms.php';

?>