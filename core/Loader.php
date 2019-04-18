<?php
/**
 * This singleton class will be the loader of all other files
 * php version 7.2.10
 * 
 * @category Core_File
 * @package  Php7
 * @author   Engr. Syed Rowshan Ali <engr.rowshan@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl.txt GNU/GPLv3
 * @link     https://nmcint.com
 */

namespace Php7;
use Php7;

/**
 * The loader class of the apllication
 * 
 * @category Class
 * @package  Php7
 * @author   Engr. Syed Rowshan Ali <engr.rowshan@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl.txt GNU/GPLv3
 * @link     https://nmcint.com
 */
class Loader implements Singelton{
	static protected $instance;     //Singleton Instance
	protected $_app;				//DI app class

	private $_router;               //Router to the Class
	private $_error;             	//Error to the class
	private $_core = array();
	private $_config = array();

	private function __construct()
	{

	}

    /**
     * @param $config_file_name
     * This function will load any config file exist into the config director
     */
	public function config($config_file_name) : array{
		//Check is the config file loaded before
        if( ! in_array($config_file_name,$this->_config )){
			//Get the file path
			$config_path = CONFIG_PATH . '/' . strtolower($config_file_name).'.inc.php';
			
			//Check if any config file exist
            if(file_exists($config_path)){
				//Add the file
				include $config_path;

				$this->_app->config = array_merge($this->_app->config,$config);
				return $config;
			}else{
				return array();
			}
			
        }
    }

    /**
     * @param $core
	 * @param $config = true
     * This function will load core classes from Core Folder
     */
    public function core($core,$config = true) : object{
		if($config){
			$this->config($core);
		}

        if( ! in_array($core,$this->_core)){
            $core_path = CORE_PATH . '/' . ucfirst($core).'.php';
            if(file_exists($core_path)){
				require_once $core_path;
				$classname = __NAMESPACE__ . '\\' . ucfirst($core);
				$this->_app->{$core} = $classname::getInstance($this->_app);
                return $this->_app->{$core};
            }
        }
    }


	/**
	 * @param null $controller
	 * Load Default Controller by the router class
	 */
	public function controller($controller = null) : void{
		if($controller == null){

			//Get Controller and Method Name
			$controller = $this->_app->router->controller();
			$method = ucfirst($this->_app->router->method());
			$parameters = $this->_app->router->parameters();

			//Enforcing Controller name
			$controller = rtrim($controller,'_C');
			$controller = ucfirst($controller) . '_C';

			//Checking if controller exist or not
			if(file_exists(CONTROLLER_PATH . '/' . $controller . '.php')){

				//Actual loading of controller
				require_once CONTROLLER_PATH . '/' . $controller . '.php';
				//Loading Class File
				if(class_exists($controller)){
					$controller_class = new $controller($this->_app);

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

	
	/**
	 * getInstance
	 *
	 * @param  mixed $app
	 *
	 * @return void
	 */
	public static function getInstance($app = null) : Loader
	{
		if (self::$instance == null)
		{
			self::$instance = new Loader();
			self::$instance->_app = $app;
		}
		return self::$instance;
	}
}