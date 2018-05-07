<?php

class BanWordController
{
    public $redis;
    public $ban_word_key = 'ban_word';

    public function __construct($action = null, $param = [])
    {
        $this->redis = new Redis();
        $this->redis->connect('localhost', 6379);

        if ($action) {
            $this->$action($param);
        }
    }

    public function get()
    {
        $ban_words = $this->redis->get($this->ban_word_key);

        if (isset($_REQUEST['need_echo']) && $_REQUEST['need_echo']) {
            echo $ban_words;
        }

        //dump($ban_words,1);
        return $ban_words;
    }

    public function add($param = [])
    {
        $param = $param ? $param : $_REQUEST;
        $add_word = isset($param['word']) ? $param['word'] : '';
        $ban_word_key = $this->ban_word_key;

        file_put_contents(__DIR__.'/../var/sensitive_words.txt', "\n".$add_word, FILE_APPEND);//将新增的敏感词维护到文件全量
        $this->del($ban_word_key);
        $ban_words = file_get_contents(__DIR__.'/../var/sensitive_words.txt');
        $this->redis->set($ban_word_key, $ban_words);
    }

    public function batchImport()
    {
        //将敏感词导入redis
        $ban_word_key = $this->ban_word_key;
        $ban_words = file_get_contents(__DIR__.'/../var/sensitive_words.txt');
        $this->del($ban_word_key);//删除原来的敏感词
        $this->redis->set($ban_word_key, $ban_words);
        $res_word = $this->redis->get($ban_word_key);
        dump($res_word, 1);
    }

    public function del($key)
    {
        return $this->redis->del($key);
    }
}
