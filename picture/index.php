<?php
// 忽略警告，没有设置过的php当code为空时会警告
error_reporting(E_ERROR); 
ini_set('display_errors', 'Off');

$screen = $_GET['screen'];
$code = $_GET['code'];

//判断屏幕类型，pc/pe
if($screen == 'pc' || $screen == 'pe'){
    //获取图片文件的绝对路径
    $path = dirname(__FILE__);
    $file = file($path."/$screen.txt");

    // 随机获取一条url
    $arr  = rand(0,count($file)-1);
    $url  = trim($file[$arr]); //trim函数去除句子前后的空格

    if($code == 'json'){
        // 返回json格式
        $json = json_encode(
            array(
                'picture' => $url
            ),
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT //自动换行和取消json中文转义，让json数据更美观，不加也没关系
        );
        echo $json;
    }else{
        // 302重定向
        header('Location:'.$url);
    }
}else{
    die('参数错误');
}
?>