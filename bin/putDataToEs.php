<?php
set_time_limit(0);
require_once '../load.php';

/**
 * 导入需要耐心
 */
for ($i = 0; $i < 1000; $i++) {//循环导入的数据为5000*1000条 500W条，如果你数据大于此值，请自行修改
    $db = Db::getInstance();
    $conn = $db->connect();
    $table = 'person';
    $per_page = 1000;
    $j = $i * $per_page;
    $sql = "select * from {$table} LIMIT {$per_page} OFFSET {$j}";
    $conn->query("set names utf8");
    $result = $conn->query($sql);

    $ci = curl_init();
    curl_setopt($ci, CURLOPT_PORT, 9200);
    curl_setopt($ci, CURLOPT_TIMEOUT, 2000);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ci, CURLOPT_FORBID_REUSE, 0);
    curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ci, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);


    while ($row = mysqli_fetch_array($result)) {
        $data['id'] = iconv('gbk', 'utf-8', $row['id']);
        $data['fname'] = iconv('gbk', 'utf-8', $row['fname']);
        $data['lname'] = iconv('gbk', 'utf-8', $row['lname']);
        $data['age'] = iconv('gbk', 'utf-8', $row['age']);
        $data['sex'] = iconv('gbk', 'utf-8', $row['sex']);
        $json_doc = json_encode($data);
        $baseUri = 'http://127.0.0.1/test/person/'.$row['id'].rand(1, 9999);    //修改二，设置es导入
        curl_setopt($ci, CURLOPT_URL, $baseUri);
        curl_setopt($ci, CURLOPT_POSTFIELDS, $json_doc);
        $response = curl_exec($ci);
//        print_r($response);die;
    }
    unset($r);//销毁数组
    curl_close($ci);
    usleep(50000);//自定义延迟
}