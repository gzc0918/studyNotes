<?php
/**
 * Created by PhpStorm.
 * User: gzc0918
 * Date: 2020-07-26
 * Time: 10:28
 */
class AsyncMysql{
    public $db_source = null;
    public $db_config = [
        'host' => '127.0.0.1',
        'port' => '3306',
        'user' => 'root',
        'password' => 'root',
        'database' => 'test',
        'charset' => 'utf8',
        'timeout' => '2',
    ];
    public function __construct()
    {
        $this->db_source = new swoole_mysql();
    }
    public function execute( $sql){
        $this->db_source->connect( $this->db_config, function( $db, $r) use ($sql){
            if( $r === false){
                exit("链接失败" . $db->connect_error . PHP_EOL);
            }
            $db->query( $sql, function( $db, $r){
                if( $r === false){
                    exit('执行sql失败' . $db->errno . PHP_EOL);
                }elseif( $r === true){ //添加 或者 修改语句
                    exit('执行成功' . PHP_EOL);
                }else{//查询语句
                    print_r( $r);
                }
            });
        });
        return true;
    }
}
$db = new AsyncMysql();
var_dump( $db->execute("select * from user"));
echo "start";