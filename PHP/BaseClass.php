<?php
namespace Study\PHPClass;

//错误日志
require 'composer/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class BaseClass{
	
	public function write($info,$data=[]){
		//echo $info;die();
		// create a log channel
		$log = new Logger('Study');
		$log->pushHandler(new StreamHandler('/tmp/your.log', Logger::WARNING));
		$log->error($info,$data);
		
	}
}