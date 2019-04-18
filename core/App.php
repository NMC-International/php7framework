<?php
/**
 * This singleton class will be center post for the framework
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
 * Interface for Singelton Class
 * 
 * @category Core_File
 * @package  Php7
 * @author   Engr. Syed Rowshan Ali <engr.rowshan@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl.txt GNU/GPLv3
 * @link     https://nmcint.com
 */
interface Singelton
{
    /**
     * getInstance
     *
     * @param  mixed $app
     *
     * @return void
     */
    static public function getInstance($app);
}

/**
 * The main class of the apllication
 * 
 * @category Class
 * @package  Php7
 * @author   Engr. Syed Rowshan Ali <engr.rowshan@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl.txt GNU/GPLv3
 * @link     https://nmcint.com
 */
Class App implements Singelton
{
    private static $_instance = null;

    public $load = null;    //Loader Class
    public $request = null; //Request Class
    public $config = array(); //Hold all configuration

    /**
     * Constructor Function
     */
    private function __construct()
    {
        //The main Loader Class
        include_once CORE_PATH . '/' . 'Loader.php';
        $this->load = Loader::getInstance($this);

        //Load the request Class
        //$this->request =  $this->load->core('request');
    }

    /**
     * Function to return the class instance
     * 
     * @return App Class
     */
    public static function getInstance($app = null)
    {
        if (self::$_instance === null ) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }
}