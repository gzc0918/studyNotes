<?php
/**
 * Created by PhpStorm.
 * User: gzc0918
 * Date: 2020-07-26
 * Time: 14:10
 */
$redis = new swoole_redis();
$redis->connect( '127.0.0.1', 6379, function ( $redis_client, $result){
    echo "connect ing" . PHP_EOL;
    var_dump( $result);
    /*
    //设置key
    $redis_client->set( 'name', 'gzc', function ($redis_client, $result){
        var_dump($result);
    });*/
    /*
    //获取key值
    $redis_client->get( 'name', function ( $redis_client, $result){
        var_dump( $result);
        $redis_client->close();
    });*/
    /*
     //搜索key
     $redis_client->keys("*", function ( $redis_client, $result){
       var_dump( $result);
       $redis_client->close();
    });*/
    $redis_client->keys("*s*", function ($redis_client, $result){
        var_dump( $result);
        $redis_client->close();
    });
    //$redis_client->close();
});