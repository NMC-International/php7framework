<?php

namespace App;

/**
 * User: Engr. Syed Rowshan Ali
 * Date: 15-Apr-19
 * Time: 12:20 PM
 * @package	Php 7 Framework
 * @author	Engr. Syed Rowshan Ali
 * @copyright	Copyright (c) 2019 - 2020, NMC International (http://nmcint.com/)
 * @license	The GNU General Public License
 * @link	https://github.com/Engr-Rowshan/php7framework
 * @since	Version 1.0.0
 */

/* A Single Flag to show debugging message and error reports
 * DEBUG = true; show debugging message, error message
 * DEBUG = false; hide all debugging message, error message
 */

//At first load the debugging an error reporting feature
define('DEBUG',true);
require_once '../config/error.inc.php';

/* Setting Path Constants Globally*/
require_once '../config/paths.inc.php';

use App\Core;

//The main Loader Class
require_once CORE_PATH . '/' . 'Loader.php';
$loader = Core\Loader::getInstance();

$loader->load_core('error');
$error = Core\Error::getInstance();

$loader->load_controller();

