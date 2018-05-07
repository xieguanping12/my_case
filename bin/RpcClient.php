<?php

class RpcClient
{
    protected $urlInfo = [];

    public function __construct($url)
    {
        //解析URL
        $this->urlInfo = parse_url($url);
        if (! $this->urlInfo) {
            exit("{$url} error \n");
        }
    }

    public function __call($method, $params)
    {
        //创建一个客户端
        $client = stream_socket_client("tcp://{$this->urlInfo['host']}:{$this->urlInfo['port']}", $errno, $errstr);
        //        dump(["tcp://{$this->urlInfo['host']}:{$this->urlInfo['port']}"],1);
        if (! $client) {
            exit("{$errno} : {$errstr} \n");
        }
        //传递调用的类名
        $class = basename($this->urlInfo['path']);
        //        dump([$this->urlInfo['path'],$class],1);
        $proto = "Rpc-Class: {$class};".PHP_EOL;
        //传递调用的方法名
        $proto .= "Rpc-Method: {$method};".PHP_EOL;
        //传递方法的参数
        $params = json_encode($params);
        $proto .= "Rpc-Params: {$params};".PHP_EOL;
        //        dump($proto,1);
        //向服务端发送我们自定义的协议数据
        fwrite($client, $proto);
        //读取服务端传来的数据
        $data = fread($client, 2048);
        //        dump(["tcp://{$this->urlInfo['host']}:{$this->urlInfo['port']}",$client, $proto,$data],1);
        //关闭客户端
        fclose($client);

        return $data;
    }
}
