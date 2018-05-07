<?php

if (! function_exists('dump')) {
    function dump($data = null, $exit = 0)
    {
        if ($data) {
            echo '<pre>';
            var_dump($data);
            echo '</pre>';
            if ($exit) {
                exit;
            }
        }
    }
}

if (! function_exists('juhe_url')) {
    function juhe_url($host, $path, $data = null)
    {
        $uri = $host.$path;
        if ($data) {
            $url = $uri.'?'.http_build_query($data);

            return $url;
        }

        return $uri;
    }
}

if (! function_exists('array_get')) {
    function array_get($arr, $key, $default = null)
    {
        if (! is_array($arr) || ! is_string($key)) {
            return null;
        }

        if (isset($arr[$key])) {
            return $arr[$key];
        } elseif (is_null($key)) {
            return $arr;
        } else {
            return $default;
        }
    }
}