<?php

class TestController
{
    public function index($params)
    {
        $return = Response::rpcSuccess($params);

        return $return;
    }

    public function error()
    {
        $return = Response::rpcError('10001','密码错误');

        return $return;
    }
}