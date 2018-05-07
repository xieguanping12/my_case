<?php
require '../tools/helpers.php';
require '../tools/SensitiveWordFilter.php';
require '../api/BanWordController.php';

/*
初始化传入词库文件路径，词库文件每个词一个换行符。
如：
敏感1
敏感2

目前只支持UTF-8编码
*/
$filter = new SensitiveWordFilter();

/*
第一个参数传入要过滤的字符串，第二个是匹配的字间距，
比如'枪支'是一个敏感词，想过滤'枪||||支'的时候，
就需要指定一个两个字的间距，可以根据情况设定，
超过指定间距就不会过滤。所有匹配的敏感词会被替换为'*'。
*/
$text = file_get_contents(__DIR__.'/../var/test_text/article.txt');

//dump($text,1);
$filter_res = $filter->filter($text, 10);
echo $filter_res;