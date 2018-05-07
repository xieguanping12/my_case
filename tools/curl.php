<?php

/**
 * 封装curl https://segmentfault.com/a/1190000005958672
 * Class Curl
 */
class Curl
{
    public static function request($url, $post_data = [], $header = [])
    {
        $ch = curl_init();
        if ($header) {
            curl_setopt($ch, CURLOPT_HEADER, $header);
        }

        if ($post_data) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//解决301 Moved Permanently
//dump([$url,$post_data,$header],1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}