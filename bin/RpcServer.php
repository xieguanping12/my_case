<?php

require_once '../load.php';

class RpcServer
{
    protected $serv = null;

    public function __construct($host, $port)
    {
        //创建一个tcp socket服务
        $this->serv = stream_socket_server("tcp://{$host}:{$port}", $errno, $errstr);

        if (! $this->serv) {
            exit("{$errno} : {$errstr} \n");
        }
        //判断我们的RPC服务目录是否存在
        $realPath = realpath(RPC_PATH);

        while (true) {
            $client = stream_socket_accept($this->serv, 60);

            if ($client) {
                //这里为了简单，我们一次性读取
                $buf = fread($client, 2048);

                //解析客户端发送过来的协议
                $classRet = preg_match("/Rpc-Class:\s(.*);".PHP_EOL."/i", $buf, $class);
                $methodRet = preg_match("/Rpc-Method:\s(.*);".PHP_EOL."/i", $buf, $method);
                $paramsRet = preg_match("/Rpc-Params:\s(.*);".PHP_EOL."/i", $buf, $params);

                //                dump([$buf,$class,$method,$params],1);
                if ($classRet && $methodRet) {
                    $class = ucfirst($class[1]);
                    $file = $realPath.'/'.$class.'.php';

                    //判断文件是否存在，如果有，则引入文件
                    if (file_exists($file)) {
                        require_once $file;
                        //实例化类，并调用客户端指定的方法
                        $obj = new $class();
                        $method = $method[1];

                        //如果有参数，则传入指定参数
                        if (! $paramsRet) {
                            $data = $obj->$method();
                        } else {
                            $data = $obj->$method(json_decode($params[1], true));
                        }
                        //把运行后的结果返回给客户端
                        print_r([json_decode($params[1], true), $data]);
                        fwrite($client, $data);
                    }
                } else {
                    fwrite($client, 'class or method error');
                }
                //关闭客户端
                fclose($client);
            }
        }
    }

    public function __destruct()
    {
        fclose($this->serv);
    }
}

new RpcServer('www.test.com', 8888);