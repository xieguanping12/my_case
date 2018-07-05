<?php
/**
 * 问题来源：https://www.zhihu.com/question/19757909
 *
 * @param $config
 * @return bool|mixed|string
 */
function request($config)
{
    if (empty($config['url'])) {
        return false;
    }

    $ch = curl_init($config['url']);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if (! empty($config['https'])) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    }
    if (! empty($config['method']) && 'post' == $config['method']) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $config['postfields']);
    }
    $msg = curl_exec($ch);
    $error = curl_error($ch);
    if (! empty($error)) {
        $msg = curl_errno($ch).': '.$error;
    }
    curl_close($ch);

    return $msg;
}

$config['url'] = 'http://php.net/manual/en/langref.php';
$str = request($config);
$reg = '/<ul class=\'parent-menu-list\'>([\s\S]*?)<\/ul>/';
preg_match($reg, $str, $liStr);
$liStr = $liStr[1];
$reg = '/<a href="(.*?)".*?>(.*?)<\/a>/';
preg_match_all($reg, $liStr, $finalStr);
$str = '['.date('Y-m-d H:i:s').'] fetching '.$config['url'].PHP_EOL;
echo '['.date('Y-m-d H:i:s').'] fetching '.$config['url'].'<br>';
sleep(1);
$str .= '['.date('Y-m-d H:i:s').'] parsing start'.PHP_EOL;
echo '['.date('Y-m-d H:i:s').'] parsing start<br>';
sleep(1);
$str .= '['.date('Y-m-d H:i:s').'] the right side list is:'.PHP_EOL;
echo '['.date('Y-m-d H:i:s').'] the right side list is:<br>';
foreach ($finalStr[1] as $key => $value) {
    $str .= $finalStr[2][$key].'(http://php.net/manual/en/'.$value.')'.PHP_EOL;
    echo $finalStr[2][$key].'(http://php.net/manual/en/'.$value.')<br>';
}
sleep(1);
$str .= '['.date('Y-m-d H:i:s').'] parsing end'.PHP_EOL;
echo '['.date('Y-m-d H:i:s').'] parsing end<br>';
sleep(1);
$str .= '['.date('Y-m-d H:i:s').'] saving to file langref.txt'.PHP_EOL;
echo '['.date('Y-m-d H:i:s').'] saving to file langref.txt<br>';
file_put_contents('langref.txt', $str);
sleep(1);
echo '['.date('Y-m-d H:i:s').'] saved<br>';
file_put_contents('langref.txt', '['.date('Y-m-d H:i:s').'] saved'.PHP_EOL, FILE_APPEND);
