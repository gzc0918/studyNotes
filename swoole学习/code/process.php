<?php
$process = new swoole_process( function( swoole_process $pro){
	$file = __DIR__ . '/http_server.php';
	$pro->exec("/home/soft/php/bin/php", [ $file]);
}, false);
$pid = $process->start();
echo $pid . PHP_EOL;

swoole_process::wait();//回收子进程