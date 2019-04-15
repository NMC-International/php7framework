<?php
/**
 * Created by PhpStorm.
 * User: rowshan
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
define('DEBUG',true);
require_once '../config/error.inc.php';

/* Setting Path Constants*/
require_once '../config/paths.inc.php';

/* Load security config file */
require_once '../config/security.inc.php';

require_once CORE_PATH . '/' . 'Error.php';
$error = Error::getInstance();

/* Request Class */
require_once CORE_PATH . '/' . 'Request.php';
$request = Request::getInstance();

//Router Class
require_once CORE_PATH . '/' . 'Router.php';
$router = Router::getInstance();

//Loader Class
require_once CORE_PATH . '/' . 'Loader.php';
$loader = Loader::getInstance();


