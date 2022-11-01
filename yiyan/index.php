<?php
//获取句子文件的绝对路径
$path = dirname(__FILE__);
$file = file($path."/hitokoto.txt");
// 随机获取一条句子
$arr  = rand(0,count($file)-1);
$content  = trim($file[$arr]); //trim函数去除句子前后的空格，（一定要有，不然js调用时会报错，别问我怎么知道的。。。）

//isset函数判断值是否为空，没有这个在我本地运行会报错，但是放到服务器上面好像不会
if(isset($_GET['code'])){
    $code = $_GET['code'];
    
    if($code == 'json'){
        // 返回json
        $json = json_encode(
            array(
                'content' => $content
            ),
            JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT //自动换行和取消json中文转义，让json数据更美观，不加也没关系
        );
        echo $json;
    }elseif($code == 'js'){
        // 返回js
        echo "function counter(){document.write('$content');}";
    }else{
        // 直接返回文本
        echo $content;
    }
}else{
    // 直接返回文本
    echo $content;
}
?>