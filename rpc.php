<?php

require_once './load.php';
require_once BIN_PATH.'/RpcClient.php';

$raw = file_get_contents("php://input");
$raw='{
	"jsonrpc":"2.0",
	"method":"TestController.index",
	"version":"1.0",
	"params":
	{
		"name":"xgp",
		"age":27
	},
	"id":"trace_id_20180506"
}';
$request = json_decode($raw,true);
$host = $_SERVER['HTTP_HOST'];
$trace_id = array_get($request,'id','');
//dump([$raw,$request,$host,$trace_id],1);

$access = explode('.',array_get($request, 'method',''));
$class_path = array_get($access,'0','');
$method = array_get($access,'1','');
$params = array_get($request,'params',[]);

//请求RpcClient
$cli = new RpcClient("tcp://{$host}:8888/{$class_path}");
echo $cli->$method($params);
