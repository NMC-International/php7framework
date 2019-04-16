<?php
namespace Php7;
use Php7;

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
	private $_error;             //Error to the class
	private $_core = array();
	private $_config = array();

	private function __construct()
	{

	}

    /**
     * @param $config
     * This function will load any config file exist into the config director
     */
	public function config($config_file_name){
		//$app = App::getInstance();


        if( ! in_array($config_file_name,$this->_config)){
            $config_path = CONFIG_PATH . '/' . strtolower($config_file_name).'.inc.php';
            if(file_exists($config_path)){
				include $config_path;
				$app->config = array_merge($config);
				return;
            }
        }
    }

    /**
     * @param $core
	 * @param $config = true
     * This function will load core classes from Core Folder
     */
    public function core($core,$config = true){
		if($config){
			$this->config($core);
		}

        if( ! in_array($core,$this->_core)){
            $core_path = CORE_PATH . '/' . ucfirst($core).'.php';
            if(file_exists($core_path)){
				require_once $core_path;
				$classname = __NAMESPACE__ . '\\' . ucfirst($core);
                return  $classname::getInstance();
            }
        }
    }


	/**
	 * @param null $controller
	 * Load Default Controller by the router class
	 */
	public function controller($controller = null){
		if($controller == null){

		    if($this->_router == null){
		        $this->core('router');
		        $this->_router = Router::getInstance();
            }

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