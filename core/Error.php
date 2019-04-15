<?php
namespace App\Core;

use App;
use App\Core;
/**
 * Created by PhpStorm.
 * User: Engr. Syed Rowshan Ali
 * Date: 15-Apr-19
 * Time: 2:15 PM
 */

/** A singleton class to handle Error generated into the page.
 *  This class will be available to the controller
 *
*/


class Error {
	private static $instance = null;    //Singleton Instance

	private function __construct()
	{

	}

	public static function getInstance()
	{
		if (self::$instance == null)
		{
			self::$instance = new Core\Error();
		}

		return self::$instance;
	}

	/**
	 * @param null $msg
	 * Show 404 Error Page
	 */
	public function show_404($msg = null){
		header('HTTP/1.1 404 Not Found');
		echo $msg != null ? 'Error:404 :: ' .$msg :'Page not found #404';
		return;
	}
}
