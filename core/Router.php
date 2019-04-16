<?php
namespace Php7;
use Php7;
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
	private $_loader = null;
	private $_config;

	private function __construct()
	{

	    if($this->_loader == null){
	        $this->_loader = Loader::getInstance();

	        $this->_config = $this->_loader->config('router');
        }

		$this->_uri = ltrim($_SERVER['REQUEST_URI'],'/');
		$part  = explode('/',$this->_uri,3);

		$c = count($part);
		switch ($c){
			case 1:
				$part[0] == '' ? $this->_controller = $this->_config['default_controller'] : $this->_controller = $part[0];
				$this->_method = $this->_config['default_method'];
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