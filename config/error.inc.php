<?php
/**
 * Created by PhpStorm.
 * User: rowshan
 * Date: 15-Apr-19
 * Time: 1:51 PM
 */

if(DEBUG){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}else{
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(0);
}

/**
 * Class Debug
 * This class will hold all the debug message and will printout at once into the output class
 */
class Debug{
	static private $debug_msg = '';

	static public function Line($str){
		self::$debug_msg .= $str;
	}
	public function PrintOut(){
		echo (DEBUG)? self::$debug_msg:'';
	}
}