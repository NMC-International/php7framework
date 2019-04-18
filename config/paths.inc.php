<?php
namespace App;
/**
 * Created by PhpStorm.
 * User: rowshan
 * Date: 15-Apr-19
 * Time: 12:42 PM
 */

//Path to index
define('BASE_PATH',str_replace('\\','/',getcwd()));

//Path to Application Root
define('SYS_PATH',str_replace('\\','/',dirname(BASE_PATH)));

//Path to Core Files
define('CORE_PATH', SYS_PATH . '/'. 'core');

//Config Path
define('CONFIG_PATH', SYS_PATH . '/'. 'config');

//Path ti Controller, Model, View
define('CONTROLLER_PATH',SYS_PATH . '/'.'controller');
define('MODEL_PATH',SYS_PATH . '/'.'model');
define('VIEW_PATH',SYS_PATH . '/'.'view');