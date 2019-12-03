<?php
// start.php

$path = __DIR__;
$host = 'localhost';
$port = '90';
$router = 'index.php';


/**
 * Load arguments
 */
//echo "Args:\n";
foreach ($argv as $key => $value) {
//	echo $key . ':' . $value . "\n";
	$vals = explode(':', $value);
	switch (isset($vals[1]) ? $vals[0] : $value) {
		case 'host':
		case 'localhost':
			$host = $vals[1];
			echo 'host: ' . $host . "\n";
			break;
		case 'port':
			$port = $vals[1];
			echo 'port: ' . $port . "\n";
			break;
		case 'router':
			$router = $vals[1];
			echo 'router: ' . $router . "\n";
			break;
//		default:
//			echo 'ERRRR' . ':' . $value . "\n";
//			break;
	}
}



/**
 * Start server
 */
echo 'Start server on: ' . $host . ':' . $port . "\n";
echo 'Router:' . $router . "\n";
echo 'Path: ' . $path . "\n";
shell_exec("cd $path" . ' && ' . 'sudo php -S ' . $host . ':' . $port . ' ' . $router); // Start server
