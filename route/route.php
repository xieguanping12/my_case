<?php

$route = [
    'api/postcode'              => 'api/JuheApiController@postcode',
    'api/caipiao'               => 'api/JuheApiController@caipiao',
    'api/weixin/query'          => 'api/JuheApiController@weixinQuery',
    'api/ip/ip2addr'            => 'api/JuheApiController@ipLocation',
    'api/mobile_consume/query'  => 'api/JuheApiController@mobileConsume',
    'api/verifyface/verify'     => 'api/JuheApiController@faceVerify',
    'api/geo'                   => 'api/JuheApiController@geoLocation',
    'yuntongxun/voice'          => 'api/JuheApiController@voiceSmsCode',
    'web/user/third/registeer'  => 'web/Controller/UserController@thirdRegister',
    'web/user/third/login'      => 'web/Controller/UserController@thirdLogin',
    'web/office/pdf/generate'   => 'web/Controller/OfficeController@pdfGen',
    'api/ban_word/add'          => 'api/BanWordController@add',
    'api/ban_word/get'          => 'api/BanWordController@get',
    'api/ban_word/batch_import' => 'api/BanWordController@batchImport',
];

$uri = $_SERVER['PHP_SELF'];
$uri = trim(str_replace('/index.php/', '', $uri), '.php');

if (isset($route[$uri])) {
    $access = $route[$uri];
    $access = explode('@', $access);
    $path = $access[0];
    $obj = explode('/', $path)[count(explode('/', $path)) - 1];
    $action = $access[1];
    require_once './'.$path.'.php';
    $obj = new $obj($action);
}

