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
	static protected $_instance;
	protected $_App;

	private $_controller;
	private $_method;
	private $_parameters;
	private $_uri;

	private function __construct(App $App)
	{
		$this->_App = $App;

		$this->_uri = ltrim($_SERVER['REQUEST_URI'],'/');
		$part  = explode('/',$this->_uri,3);

		$c = count($part);
		switch ($c){
			case 1:
				$part[0] == '' ? $this->_controller = $this->_App->config['default_controller'] : $this->_controller = $part[0];
				$this->_method = $this->_App->config['default_method'];
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

	public static function getInstance($App) : Router
	{
		if (self::$_instance == null)
		{
			self::$_instance = new Router($App);
		}

		return self::$_instance;
	}

	public function controller() : string{
		return $this->_controller;
	}

	public function method() : ?string {
		return $this->_method;
	}

	public function parameters() : ?string{
		return $this->_parameters;
	}
}