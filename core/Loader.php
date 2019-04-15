<?php
/**
 * Created by PhpStorm.
 * User: rowshan
 * Date: 15-Apr-19
 * Time: 2:14 PM
 */
class Loader{
	static protected $instance;
	private $_router;
	private $_error;

	private function __construct()
	{
        $this->_router = Router::getInstance();
        $this->_error = Error::getInstance();

        $this->load_controller();
	}

	public function load_controller($controller = null){
		if($controller == null){
			$controller = $this->_router->controller();
			$method = ucfirst($this->_router->method());

			$controller = rtrim($controller,'_C');
			$controller = ucfirst($controller) . '_C';

			if(file_exists(CONTROLLER_PATH . '/' . $controller . '.php')){

				require_once CONTROLLER_PATH . '/' . $controller . '.php';

				if(class_exists($controller)){

					$controller_class = new $controller();

					if(method_exists($controller_class,$method)){
						$controller_class->$method();
					}else{
						$this->_error->show_404('Method not Found');
					}
				}else{
					$this->_error->show_404('Controller Not Found');
				}

			}else{
				$this->_error->show_404('Controller File Not Found');
			}
		}
	}

	public static function getInstance()
	{
		if (self::$instance == null)
		{
			self::$instance = new Loader();
		}

		return self::$instance;
	}
}