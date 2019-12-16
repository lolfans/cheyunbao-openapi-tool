<?php
spl_autoload_register("Autoloader::autoload"); //自 PHP5.3.0起

class Autoloader{
	private static $autoloadPathArray = array("Config", "Http", "Utils");

    /**
     * 自动加载 类
     * @param $className
     */
	public static function autoload($className)
	{
		foreach (self::$autoloadPathArray as $path) {
			$file = dirname(__DIR__).DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$className.".php";
			$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
			if(is_file($file)){
				include_once $file;
				break;
			}
		}
	}


}
?>