<?php
// author:adair
//memcached -d -m 1024 -l 127.0.0.1 -p 11211
ini_set("session.save_handler", "memcache"); 
ini_set("session.save_path", "tcp://127.0.0.1:11211"); 

session_start(); 
if (!isset($_SESSION['TEST'])) { 
$_SESSION['TEST'] = time(); 
} 
$_SESSION['TEST3'] = time(); 
print $_SESSION['TEST']; 
print "<br><br>"; 
print $_SESSION['TEST3']; 
print "<br><br>"; 
print 'session id: '.session_id(); 

//telnet 127.0.0.1 11211
//get session_id;
?>
