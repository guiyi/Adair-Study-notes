<?php
ob_end_clean();
header("Connection: close\r\n");
header("Content-Encoding: none\r\n");
ignore_user_abort(true); // optional
ob_start();
echo ('Text user will see');
$size = ob_get_length();
//header("Content-Length: $size");
ob_end_flush();     // Strange behaviour, will not work
flush();            // Unless both are called !
ob_end_clean();

//do processing here
//sleep(5);

echo('Text user will never see'). "\n<BR \>";
//do some processing


function abort()
{
     if(connection_aborted())
           unlink('file.ini');
}
register_shutdown_function('abort');



function test() 
{ 
 echo '这个是中止方法test的输出'. "\n<BR \>";
} 
  
register_shutdown_function('test'); 
  
echo 'before' . PHP_EOL. "\n<BR \>";



function echocwd() { echo 'cwd: ', getcwd(),  "\n<BR \>"; }

register_shutdown_function('echocwd');
echocwd() and exit;




function shutdown()
{
    // This is our shutdown function, in 
    // here we can do any last operations
    // before the script is complete.

    echo 'Script executed with success', PHP_EOL;
}

register_shutdown_function('shutdown');
echo '111'. "\n<BR \>";





function foobar($arg, $arg2) {
    echo __FUNCTION__, " got $arg and $arg2\n". "\n<BR \>";
}
class foo {
    function bar($arg, $arg2) {
        echo __METHOD__, " got $arg and $arg2\n". "\n<BR \>";
    }
}


// Call the foobar() function with 2 arguments
call_user_func_array("foobar", array("one", "two"));

// Call the $foo->bar() method with 2 arguments
$foo = new foo;
call_user_func_array(array($foo, "bar"), array("three", "four"));