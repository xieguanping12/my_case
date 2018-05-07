<?php
session_start();

include_once('../../../tools/helpers.php');

include_once('config.php');
include_once('saetv2.ex.class.php');

$o = new SaeTOAuthV2(WB_AKEY, WB_SKEY);

if (isset($_REQUEST['code'])) {
    $keys = [];
    $keys['code'] = $_REQUEST['code'];
    $keys['redirect_uri'] = WB_CALLBACK_URL;
    try {
        $token = $o->getAccessToken('code', $keys);
        //		dump([$keys,$_REQUEST,$token],1);
    } catch (OAuthException $e) {
    }
}

if ($token) {
    $_SESSION['token'] = $token;
    //	dump($_SESSION,1);
    setcookie('weibojs_'.$o->client_id, http_build_query($token));
    $c = new SaeTClientV2(WB_AKEY, WB_SKEY, $_SESSION['token']['access_token']);
    $uid_get = $c->get_uid();
    $uid = $uid_get['uid'];
    $user_message = $c->show_user_by_id($uid);//根据ID获取用户等基本信息
    //        dump($user_message,1);
    //第三方登录成功后将用户注册到我的网站
    $uid = $user_message['id'];
    $name = $user_message['name'];
    $password = md5($uid.$name);
    $user_info = [
        'open_id'   => $uid,
        'name'      => $name,
        'password'  => $password,
        'source'    => 2,//注册来源：1-web注册 2-weibo 3-weixin 4-qq
        'create_at' => time(),
    ];

    //登录到我的网站
    $location_url = "http://www.test.com/index.php/web/user/third/login.php?".http_build_query($user_info);
    header('Location: '.$location_url);
    ?>
    <!--授权完成,<a href="weibolist.php">进入你的微博列表页面</a><br />-->
    <?php
} else {
    ?>
    授权失败。
    <?php
}
?>
