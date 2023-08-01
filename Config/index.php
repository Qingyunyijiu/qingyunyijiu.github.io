<?php
// 定义webhook URL
$webhook_url = "https://webhook.site/39217316-9f0e-4399-adca-68a81d80e14f";

// 定义温度数据文件
$temp_file = "temp_data.json";

// 检查是否有POST请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取POST请求的内容
    $post_data = file_get_contents("php://input");
    // 解码POST请求的内容为JSON对象
    $post_json = json_decode($post_data, true);
    // 检查POST请求的内容是否包含温度值
    if (isset($post_json["temperature"])) {
        // 获取温度值
        $temp_value = $post_json["temperature"];
        // 获取当前时间戳
        $temp_time = date("Y-m-d H:i:s");
        // 创建一个包含温度值和时间戳的数组
        $temp_data = array("temperature" => $temp_value, "timestamp" => $temp_time);
        // 读取温度数据文件的内容
        $temp_file_data = file_get_contents($temp_file);
        // 解码温度数据文件的内容为JSON数组
        $temp_file_json = json_decode($temp_file_data, true);
        // 把温度数据数组添加到温度数据文件的JSON数组中
        array_push($temp_file_json, $temp_data);
        // 编码温度数据文件的JSON数组为字符串
        $temp_file_data = json_encode($temp_file_json);
        // 写入温度数据文件的内容
        file_put_contents($temp_file, $temp_file_data);
    }
}

// 读取温度数据文件的内容
$temp_file_data = file_get_contents($temp_file);
// 解码温度数据文件的内容为JSON数组
$temp_file_json = json_decode($temp_file_data, true);

// 定义一个空的温度值变量
$temp_value = "";
// 定义一个空的时间戳变量
$temp_time = "";

// 检查温度数据文件的JSON数组是否为空
if (!empty($temp_file_json)) {
    // 获取最后一条温度数据数组
    $last_temp_data = end($temp_file_json);
    // 获取最后一条温度数据数组中的温度值和时间戳
    $temp_value = $last_temp_data["temperature"];
    $temp_time = $last_temp_data["timestamp"];
}
?>
