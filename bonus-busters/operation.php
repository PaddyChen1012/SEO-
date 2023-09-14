<?php
if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['num3'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $num3 = $_POST['num3'];

    $x = floor((int)$num3 / 7);

    if(($num3 % 7) !== 0){
        $y = ($num3 % 7) / 7;
        $roundedNum = ((0.5 ** $x) - ((0.5 ** $x) - (0.5 ** ($x + 1))) * $y) * 100;
        $passNum = ceil($roundedNum * 10) / 10;
    }else{
        $passNum = (0.5 ** $x) * 100;
    }

    $sum = ($num1 + $num2) * (0.97 ** $x);
}
// 创建一个关联数组
$data = array(
    'passNum' => $passNum,
    'sum' => $sum
);

// 将数组转换成 JSON 格式的字符串
$jsonData = json_encode($data);

// 将 JSON 格式的字符串作为响应返回
echo $jsonData;

?>