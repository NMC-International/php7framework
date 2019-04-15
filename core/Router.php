<?php
/**
 * Created by PhpStorm.
 * User: rowshan
 * Date: 15-Apr-19
 * Time: 2:14 PM
 */
class Router{
	static protected $instance;

	private $_controller;
	private $_method;
	private $_parameters;
	private $_uri;

	private function __construct()
	{
		$request = Request::getInstance();

		$this->_uri = ltrim($request->uri(),'/');
		$part  = explode('/',$this->_uri,3);

		$c = count($part);
		switch ($c){
			case 1:
				$part[0] == '' ? $this->_controller = 'Default_C' : $this->_controller = $part[0];
				$this->_method = 'index';
				$this->_parameters = null;
				break;
			case 2:
				$this->_controller = $part[0];
				$this->_method = $part[1];
				$this->_parameters = null;
				break;
			case 3:
				$this->_controller = $part[0];
				$this->_method = $part[1];
				$this->_parameters = $part[2];
				break;
		}
	}

	public static function getInstance()
	{
		if (self::$instance == null)
		{
			self::$instance = new Router();
		}

		return self::$instance;
	}

	public function controller(){
		return $this->_controller;
	}

	public function method(){
		return $this->_method;
	}

	public function parameters(){
		return $this->_parameters;
	}
}