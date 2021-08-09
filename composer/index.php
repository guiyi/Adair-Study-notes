<?php

require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('DFRobot');
$log->pushHandler(new StreamHandler('/tmp/your.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');

die();

use Psr\Log\LoggerInterface;

class Foo
{
    private $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    public function doSomething()
    {
        if ($this->logger) {
        	echo 'Doing work';die();
            $this->logger->info('Doing work');
        }
           
        try {
            $this->doSomethingElse();
        } catch (Exception $exception) {
            $this->logger->error('Oh no!', array('exception' => $exception));
        }

        // do something useful
    }

    public function doSomethingElse(){
    	if ($this->logger) {
            $this->logger->info('Doing else work');
            $this->logger->error('Oh no!', array('exception' => $exception));
        }else{
        	echo 33;
        }
    }
}

$obj = new Foo();
echo 111;
$obj->doSomething();
echo 222;