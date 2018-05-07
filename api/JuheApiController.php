<?php

class JuheApiController
{
    public function __construct($action)
    {
        self::$action($_REQUEST);
    }

    public static function postcode($param)
    {
        $param['key'] = JuheConst::POST_CODE_API_KEY;
        $host = 'http://v.juhe.cn/';
        $path = 'postcode/query';
        $url = juhe_url($host, $path, $param);
        $content = Curl::request($url);

        echo $content;
    }

    public static function caipiao($param)
    {
        $param['key'] = JuheConst::CAIPIAO_API_KEY;
        $host = 'http://apis.juhe.cn/';
        $path = 'lottery/types';
        $url = juhe_url($host, $path, $param);
        $content = Curl::request($url);

        echo $content;
    }

    public static function weixinQuery($param)
    {
        $param['key'] = JuheConst::WEIXIN_QUERY_API_KEY;
        $host = 'http://v.juhe.cn/';
        $path = 'weixin/query';
        $url = juhe_url($host, $path, $param);
        $content = Curl::request($url);

        echo $content;
    }

    public static function ipLocation($param)
    {
        $param['key'] = JuheConst::IP_LOCATION_API_KEY;
        $host = 'http://apis.juhe.cn/';
        $path = 'ip/ip2addr';
        $url = juhe_url($host, $path, $param);
        $content = Curl::request($url);

        echo $content;
    }

    public static function mobileConsume($param)
    {
        $param['key'] = JuheConst::MOBILE_CONSUME_API_KEY;
        $host = 'http://v.juhe.cn/';
        $path = 'mobile_consume/query';
        $url = juhe_url($host, $path, $param);
        $content = Curl::request($url);

        echo $content;
    }

    public static function faceVerify($param)
    {
        $param['key'] = JuheConst::FACE_VERIFY_API_KEY;
        $host = 'http://apis.juhe.cn/';
        $path = 'verifyface/verify';
        $url = $host.$path;
        //        dump([$url,$param],1);
        $content = Curl::request($url, $param);

        echo $content;
    }

    public static function geoLocation($param)
    {
        $param['key'] = JuheConst::GEO_API_KEY;
        $host = 'http://apis.juhe.cn/';
        $path = 'geo';
        $url = juhe_url($host, $path, $param);
        //        dump($url,1);
        $content = Curl::request($url);

        echo $content;
    }

    /**
     * 语音验证码
     * https://www.juhe.cn/docs/api/id/61
     *
     * @param $param
     */
    public static function voiceSmsCode($param)
    {
        $param['key'] = JuheConst::VOICE_SMS_CODE_API_KEY;
        $host = 'http://op.juhe.cn/';
        $path = 'yuntongxun/voice';
        $url = $host.$path;
//        dump($url,1);
        $content = Curl::request($url,$param);

        echo $content;
    }
}