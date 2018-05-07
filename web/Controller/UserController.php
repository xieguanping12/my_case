<?php

class UserController
{
    public function __construct($action)
    {
        self::$action($_REQUEST);
    }

    /**
     * 第三方用户注册
     */
    public static function thirdRegister()
    {
        $param = $_REQUEST;

        $db = Db::getInstance();
        $conn = $db->connect();
        $table = 'user';

        $name = $param['name'];
        $open_id = isset($param['open_id']) ? $param['open_id'] : 0;
        $source = isset($param['source']) ? $param['source'] : 1;
        $password = md5('hello');
        $create_at = $update_at = time();

        $sql = "select * from {$table} where source='{$source}' and open_id={$open_id};";
        $result = $conn->query($sql);
        $url = 'http://www.test.com/web/third_login/weibo/weibolist.php';

        if ($result->num_rows > 0) {
//            dump(['登录成功',$result,$param,$sql],1);
            header('Location: '.$url);
        } else {
            $sql = "insert into {$table} (name,password,source,open_id,create_at,update_at) VALUE ('$name','$password',$source,'$open_id',$create_at,$update_at);";
            $result = $conn->query($sql);
            if ($result) {
                dump(['注册成功',$sql,$param,$result],1);
                header('Location: '.$url);
            } else {
//                dump(['注册失败',$sql,$param,$result],1);
                header('Location: http://www.test.com/web/third_login/weibo/login.php');
            }
        }

    }

    /**
     * 第三方用户登录
     */
    public static function thirdLogin()
    {
        $param = $_REQUEST;
        $open_id = isset($param['open_id']) ? $param['open_id'] : 0;
        $source = isset($param['source']) ? $param['source'] : 1;

        $db = Db::getInstance();
        $conn = $db->connect();
        $table = 'user';

        $sql = "select * from {$table} where source='{$source}' and open_id={$open_id};";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $url = 'http://www.test.com/web/third_login/weibo/weibolist.php';
            dump(['登录成功',$result,$param,$sql],1);
            header('Location: '.$url);
        } else {
            self::thirdRegister($param);
        }
    }
}
