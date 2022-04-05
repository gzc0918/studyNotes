<?php
$ws = new swoole_websocket_server('0.0.0.0', 8881);

$ws->set([
	'document_root' => '/home/study_code/html',
	'enable_static_handler' => true,
]);

$ws->on( 'open', function ( $ws, $request){
	//var_dump( $request->fd, $request->get, $request->server);
	echo "{$request->fd}\n";
	$ws->push( $request->fd, "hello bro i am ws server\n");
});

$ws->on('message', function( $ws, $frame){
	echo "message is : {$frame->data}\n";
	$ws->push( $frame->fd, 'message i am got it');
});

$ws->on('close', function( $ws, $fd){
	echo "client-{$fd} is closed \n";
});

$ws->start();