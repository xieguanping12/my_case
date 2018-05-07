<?php

class Response
{
    public function __construct()
    {

    }

    /**
     * rpc请求示例：
     * --> [
     * {"jsonrpc": "2.0", "method": "sum", "params": [1,2,4], "id": "1"},
     * {"jsonrpc": "2.0", "method": "notify_hello", "params": [7]},
     * {"jsonrpc": "2.0", "method": "subtract", "params": [42,23], "id": "2"},
     * {"foo": "boo"},
     * {"jsonrpc": "2.0", "method": "foo.get", "params": {"name": "myself"}, "id": "5"},
     * {"jsonrpc": "2.0", "method": "get_data", "id": "9"}
     * ]
     * rpc返回示例：
     * <-- [
     * {"jsonrpc": "2.0", "result": 7, "id": "1"},
     * {"jsonrpc": "2.0", "result": 19, "id": "2"},
     * {"jsonrpc": "2.0", "result": ["hello", 5], "id": "9"}
     * ]
     */
    /**
     * 返回成功示例
     *
     * @param array $data 返回数据
     * @param null $id trace_id
     * @return string
     */
    public static function rpcSuccess($data = [], $id = null)
    {
        $return = [
            'jsonrpc' => '2.0',
            'result'  => $data,
            'id'      => $id,
        ];

        return json_encode($return);
    }

    /**
     * 返回错误示例
     * {"jsonrpc": "2.0", "error": {"code": -32601, "message": "Method not found"}, "id": "5"},
     *
     * @param $code
     * @param $message
     * @param null $id
     * @return string
     */
    public static function rpcError($code = -1, $message = '参数错误', $id = null)
    {
        $return = [
            'jsonrpc' => '2.0',
            'error'   => [
                'code'    => $code,
                'message' => $message,
            ],
            'id'      => $id,
        ];

        return json_encode($return);
    }
}