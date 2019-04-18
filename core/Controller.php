<?php
namespace Php7;
use Php7;

class Controller
{
    static protected $_instance = null;
    protected $_App;

    public function __construct(App $App){
        $this->_App = $App;
    }

    public function view(?string $view, ?array $data, boolval $returnAsString){
        /*
        No view file mentioned view file name as controller/method
        If default file not found show 404

        If view file set, check is it directory based or file
        if directory based go to directory and load the file
        if not found show 404

        if simple file name
        check in the root
        not found, check in a directory named as controller and then check inthere root
        if not found return show 404
        */
    }

    /**
	 * getInstance
	 *
	 * @param  mixed $app
	 *
	 * @return void
	 */
	public static function getInstance(App $App) : Controller
	{
		if (self::$_instance == null)
		{
			self::$_instance = new Controller($App);
		}
		return self::$_instance;
	}
}