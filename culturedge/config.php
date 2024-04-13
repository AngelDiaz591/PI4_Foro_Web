<?php 
/**
 * Configuration file
 * DS           -  Directory Separator
 * ROOT         -  Root directory
 * IS_DEV       -  Check if the server is local
 * URL          -  URL of the website.
 *  ^ Modify it according to your environment
 * DB_HOST      -  Database host
 * CLASSES      -  Classes directory
 * PARENT_ROOT  -  Parent directory
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);

define('IS_DEV', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) ? true : false);
define('URL', IS_DEV ? 'http://127.0.0.1:2000/' : 'ROMOTE_URL');

define('DB_HOST', IS_DEV ? 'localhost' : 'REMOTE_HOST');

define('CLASSES', ROOT . 'classes' . DS);
define('PARENT_ROOT', ROOT . '..' . DS);

?>
