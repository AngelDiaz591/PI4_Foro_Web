<?php 
/**
 * Configuration file
 * DS           -  Directory Separator
 * ROOT         -  Root directory
 * 
 * IS_DEV       -  Check if the server is local
 * URL          -  URL of the website.
 *  ^ Modify it according to your environment
 * 
 * DB_HOST      -  Database host
 * DB_NAME      -  Database name
 * DB_USER      -  Database user
 *  ^ Modify it according to your environment
 * DB_PASS      -  Database password
 *  ^ Modify it according to your environment
 * 
 * CLASSES      -  Classes directory
 * PARENT_ROOT  -  Parent directory
 * 
 * RESOURCES    -  Resources directory
 * LAYOUTS      -  Layouts directory
 * VIEWS        -  Views directory
 * HELPERS      -  Helpers directory
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);

define('IS_DEV', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) ? true : false);
define('URL', IS_DEV ? 'http://127.0.0.1:2000/' : 'ROMOTE_URL');

define('DB_HOST', IS_DEV ? 'localhost' : 'REMOTE_HOST');
define('DB_NAME', IS_DEV ? 'foroweb_development' : 'REMOTE_DB');
define('DB_USER', IS_DEV ? 'zama' : 'REMOTE_USER');
define('DB_PASS', IS_DEV ? '1234' : 'REMOTE_PASS');

define('CLASSES', ROOT . 'classes' . DS);
define('PARENT_ROOT', ROOT . '..' . DS);

define('RESOURCES', ROOT . 'resources' . DS);
define('LAYOUTS', RESOURCES . 'layouts' . DS);
define('VIEWS', RESOURCES . 'views' . DS);
define('HELPERS', RESOURCES . 'helpers' . DS);

?>
