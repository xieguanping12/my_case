<?php
/**
 * 来源：https://blog.csdn.net/zhanghao143lina/article/details/78713160
 */

//$age = ["Bill" => "60", "Steve" => "56", "Mark" => "31"];
//print_r(array_change_key_case($age,CASE_UPPER));

//$cars = ["Volvo", "BMW", "Toyota", "Honda", "Mercedes", "Opel"];
//print_r(array_chunk($cars, 2));

//$a = [
//    [
//        'id'         => 5698,
//        'first_name' => 'Bill',
//        'last_name'  => 'Gates',
//    ],
//    [
//        'id'         => 4767,
//        'first_name' => 'Steve',
//        'last_name'  => 'Jobs',
//    ],
//    [
//        'id'         => 3809,
//        'first_name' => 'Mark',
//        'last_name'  => 'Zuckerberg',
//    ],
//];
//
//$last_names = array_column($a, 'last_name');
//print_r($last_names);

//$fname = ["Bill", "Steve", "Mark"];
//$age = ["60", "56", "31"];
//
//$c = array_combine($fname, $age);
//print_r($c);

//$zoom = ["A", "Cat", "Dog", "A", "Dog"];
//print_r(array_count_values($zoom));

//$a1 = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];
//$a2 = ["e" => "red", "f" => "green", "g" => "blue"];
//
//$result = array_diff($a1, $a2);
//print_r($result);

//$a1 = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];
//$a2 = ["f" => "red", "b" => "green", "c" => "blue"];
//
//$result = array_diff_assoc($a1, $a2);
//print_r($result);

//$a1 = ["a" => "red", "b" => "green", "c" => "blue"];
//$a2 = ["a" => "red", "c" => "blue", "d" => "pink"];
//
//$result = array_diff_key($a1, $a2);
//print_r($result);

//function test_odd($var)
//{
//    return ($var & 1);
//}
//
//$a1 = ["a", "b", 2, 0,5, 3,5,'0.0',8, 4];
//print_r(array_filter($a1));

//$a1 = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];
//$result = array_flip($a1);
//print_r($result);

//$a1 = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];
//$a2 = ["e" => "red", "f" => "green", "g" => "blue"];
//
//$result = array_intersect($a1, $a2);
//print_r($result);

//$a1 = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];
//$a2 = ["a" => "red", "q" => "green", "c" => "blue"];
//
//$result = array_intersect_assoc($a1, $a2);
//print_r($result);

//$a1 = ["a" => "red", "b" => "green", "c" => "blue"];
//$a2 = ["a" => "red", "c" => "blue", "d" => "pink"];
//
//$result = array_intersect_key($a1, $a2);
//print_r($result);

//$a = ["Volvo" => "XC90", "BMW" => "X5"];
//if (array_key_exists("Volvo", $a)) {//大小写敏感
//    echo "键存在！";
//} else {
//    echo "键不存在！";
//}

//$a = ["Volvo", "BMW"];
//if (array_key_exists(1, $a)) {
//    echo "键存在！";
//} else {
//    echo "键不存在！";
//}

//$a = ["Volvo" => "XC90", "BMW" => "X5", "Toyota" => "Highlander"];
//print_r(array_keys($a));

//function double($val){
//    return $val*$val;
//}
//
//$arr = [5,3,6,9];
//$arr2=array_map('double',$arr);
//print_r($arr2);

//function myfunction($v)
//{
//    if ($v === "Dog") {
//        return "Fido";
//    }
//
//    return $v;
//}
//
//$a = ["Horse", "Dog", "Cat"];
//print_r(array_map("myfunction", $a));

//function myfunction($v1, $v2)
//{
//    if ($v1 === $v2) {
//        return "same";
//    }
//
//    return "different";
//}
//
//$a1 = ["Horse", "Dog", "Cat"];
//$a2 = ["Horse", "Dog", "Rat"];
//print_r(
//    array_map("myfunction", $a1, $a2)
//);


//$a1 = ["red", "green"];
//$a2 = ["blue", "green"];
//print_r(array_merge($a1,$a2));

//$arr = [5, 6, 7, 2];//非数字当作0处理
//print_r(array_product($arr));

//$a = ["red", "green", "blue", "yellow", "brown"];
//$random_keys = array_rand($a, 4);
//echo $a[$random_keys[0]]."<br>";
//echo $a[$random_keys[1]]."<br>";
//echo $a[$random_keys[2]];

//function walk($val,$key){
//    echo "the key is {$key} the val is {$val}".PHP_EOL;
//}
//$a = ["a" => "red", "b" => "green", "c" => "blue"];
//array_walk($a, 'walk');
//print_r($a);

//$firstname = "Bill";
//$lastname = "Gates";
//$age = "60";
//
//$result = compact("firstname", "lastname", "age");
//print_r($result);

//$my_array = array("Dog","Cat","Horse");
//
//list($a, $b, $c) = $my_array;
//echo "I have several animals, a $a, a $b and a $c.".PHP_EOL;

//$a = "Original";
//$my_array = array("a" => "Cat","b" => "Dog", "c" => "Horse");
//extract($my_array);
//echo "\$a = $a; \$b = $b; \$c = $c".PHP_EOL;

//
//$my_array = ["red", "green", "blue", "yellow", "purple"];
//
//shuffle($my_array);
//print_r($my_array);

//$cars = ["Volvo", "BMW", "Toyota"];
//krsort($cars);
//print_r($cars);

$number = range(10, 100);
print_r($number);