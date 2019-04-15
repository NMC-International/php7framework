<?php
/**
 * Created by PhpStorm.
 * User: rowshan
 * Date: 15-Apr-19
 * Time: 2:15 PM
 */

// A singleton class to handle request.
class Request {
	private static $instance = null;

	private $_get = null;
	private $_post = null;
	private $_request = null;
	private $_method = null;

	private $_host;
	private $_remote_host;
	private $_remote_ip;
	private $_uri;
	private $_query_str;

	private function __construct()
	{
		$this->_get = $_GET;
		$this->_post = $_POST;
		$this->_request = $_REQUEST;
		$this->_method = $_SERVER['REQUEST_METHOD'];
		$this->_host = $_SERVER['HTTP_HOST'];

		//I don't know why but sometime REMOTE_HOST Not available
		$this->_remote_host = isset($_SERVER['REMOTE_HOST'])?$_SERVER['REMOTE_HOST']:'';

		$this->_query_str = $_SERVER['QUERY_STRING'];

		$this->_remote_ip = $_SERVER['REMOTE_ADDR'];
		$this->_uri = $_SERVER['REQUEST_URI'];

		//Security Cleanup
		unset($_GET);
		unset($_POST);
		unset($_REQUEST);
		unset($_GLOBAL);
	}

	public static function getInstance()
	{
		if (self::$instance == null)
		{
			self::$instance = new Request();
		}

		return self::$instance;
	}

	/**
	 * @param $key
	 * Return Get value
	 * @return string, false
	 */
	public function get($key = null){
		return isset($this->_get[$key]) ? $this->_get[$key] : false;
	}

	/**
	 * @param $key
	 * Return Post value
	 * @return string, false
	 */
	public function post($key = null){
		return isset($this->_post[$key]) ? $this->_post[$key] : false;
	}

	public function request($key = null){
		return isset($this->_request[$key]) ? $this->_request[$key] : false;
	}

	/**
	 * @param bool $lower = false
	 *
	 * @return string
	 */
	public function method($lower = false){
		if($lower){
			return strtolower($this->_method);
		}else{
			return $this->_method;
		}
	}

	public function uri(){
		return $this->_uri;
	}

	public function query_str(){
		return $this->_query_str;
	}
}
