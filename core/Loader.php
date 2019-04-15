<?php
/**
 * Created by PhpStorm.
 * User: Engr. Syed Rowshan Ali
 * Date: 15-Apr-19
 * Time: 2:14 PM
 * This class will be used to load controller, model and view
 */
class Loader{
	static protected $instance;     //Singleton Instance
	private $_router;               //Router to the Class
	private $_error;                //Error to the class

	private function __construct()
	{
		//Loading Router and the Error Class
        $this->_router = Router::getInstance();
        $this->_error = Error::getInstance();

        //Load the controller at this stage
        $this->load_controller();
	}

	/**
	 * @param null $controller
	 * Load Default Controller by the router class
	 */
	public function load_controller($controller = null){
		if($controller == null){
			//Get Controller and Method Name
			$controller = $this->_router->controller();
			$method = ucfirst($this->_router->method());
			$parameters = $this->_router->parameters();

			//Enforcing Controller name
			$controller = rtrim($controller,'_C');
			$controller = ucfirst($controller) . '_C';

			//Checking if controller exist or not
			if(file_exists(CONTROLLER_PATH . '/' . $controller . '.php')){

				//Actual loading of controller
				require_once CONTROLLER_PATH . '/' . $controller . '.php';
				//Loading Class File
				if(class_exists($controller)){
					$controller_class = new $controller();

					//Calling class method
					if(method_exists($controller_class,$method)){
						$controller_class->$method($parameters);
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