<?php

$http = new swoole_http_server('0.0.0.0', 8001);
$http->on('request', function( $request, $response){
	//启用协程redis
	$redis = new Swoole\Coroutine\Redis();
	$redis->connect( '127.0.0.1', 6379);
	$value = $redis->get( $request->get['a']);

	//假设开启了协程mysql和协程redis，那么程序运行时间为mysql或redis中执行时间最长的客户端运行时间
	//不是mysql+redis总共的运行时间
	$response->header('Content-Type', 'text/plain');
	$response->end( $value);
});
$http->start();