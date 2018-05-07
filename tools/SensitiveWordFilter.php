<?php

class SensitiveWordFilter
{
    private $dict;

    public function __construct()
    {
        $this->dict = [];
        $this->initDict();
    }

    private function initDict()
    {
        $ban_words = (new BanWordController())->get();
        if ($ban_words) {
            $ban_words = explode("\n", $ban_words);
            foreach ($ban_words as $word) {
                if (empty($word)) {
                    continue;
                }

                $uWord = $this->unicodeSplit($word);
                $pdict = &$this->dict;
                $count = count($uWord);
                for ($i = 0; $i < $count; $i++) {
                    if (! isset($pdict[$uWord[$i]])) {
                        $pdict[$uWord[$i]] = [];
                    }
                    $pdict = &$pdict[$uWord[$i]];
                }
                $pdict['end'] = true;
            }
        }
    }

    public function filter($str, $maxDistance = 5)
    {
        if ($maxDistance < 1) {
            $maxDistance = 1;
        }

        $uStr = $this->unicodeSplit($str);

        $count = count($uStr);

        for ($i = 0; $i < $count; $i++) {
            if (isset($this->dict[$uStr[$i]])) {
                $pdict = &$this->dict[$uStr[$i]];

                $matchIndexes = [];

                for ($j = $i + 1, $d = 0; $d < $maxDistance && $j < $count; $j++, $d++) {
                    if (isset($pdict[$uStr[$j]])) {
                        $matchIndexes[] = $j;
                        $pdict = &$pdict[$uStr[$j]];
                        $d = -1;
                    }
                }

                if (isset($pdict['end'])) {
                    $uStr[$i] = '*';
                    foreach ($matchIndexes as $k) {
                        if ($k - $i == 1) {
                            $i = $k;
                        }
                        $uStr[$k] = '*';
                    }
                }
            }
        }

        return implode($uStr);
    }

    public function unicodeSplit($str)
    {
        //     dump($str,1);
        $str = strtolower($str);
        $ret = [];
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $c = ord($str[$i]);

            if ($c & 0x80) {
                if (($c & 0xf8) == 0xf0 && $len - $i >= 4) {
                    if ((ord($str[$i + 1]) & 0xc0) == 0x80 && (ord($str[$i + 2]) & 0xc0) == 0x80
                        && (ord($str[$i + 3]) & 0xc0) == 0x80) {
                        $uc = substr($str, $i, 4);
                        $ret[] = $uc;
                        $i += 3;
                    }
                } else if (($c & 0xf0) == 0xe0 && $len - $i >= 3) {
                    if ((ord($str[$i + 1]) & 0xc0) == 0x80 && (ord($str[$i + 2]) & 0xc0) == 0x80) {
                        $uc = substr($str, $i, 3);
                        $ret[] = $uc;
                        $i += 2;
                    }
                } else if (($c & 0xe0) == 0xc0 && $len - $i >= 2) {
                    if ((ord($str[$i + 1]) & 0xc0) == 0x80) {
                        $uc = substr($str, $i, 2);
                        $ret[] = $uc;
                        $i += 1;
                    }
                }
            } else {
                $ret[] = $str[$i];
            }
        }

        return $ret;
    }
}