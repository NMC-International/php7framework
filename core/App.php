<?php
/**
 * This singleton class will be center post for the framework
 */
namespace Php7;
use Php7;

Class App{
    private static $instance = null;

    public $load = null;    //Loader Class
    public $request = null; //Request Class
    public $config = array(); //Hold all configuration

    private function __construct()
    {
        //The main Loader Class
        require_once CORE_PATH . '/' . 'Loader.php';
        $this->load = Loader::getInstance();

        //Load the request Class
        $this->request =  $this->load->core('request');
    }

    public static function getInstance()
    {
        if (self::$instance === null)
		{
			self::$instance = new App();
		}
		return self::$instance;
    }

}