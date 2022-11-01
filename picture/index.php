<?php
    //isset函数判断值是否为空，没有这个在我本地运行会报错，但是放到服务器上面好像不会
    if(isset($_GET['screen'])){ 
        $screen = $_GET['screen'];

        //判断屏幕类型，pc/pe
        if($screen == 'pc' || $screen == 'pe'){
            //获取图片文件的绝对路径
            $path = dirname(__FILE__);
            $file = file($path."/$screen.txt");
    
            // 随机获取一条url
            $arr  = rand(0,count($file)-1);
            $url  = trim($file[$arr]); //trim函数去除句子前后的空格
    
            if(isset($_GET['code'])){
                $code = $_GET['code'];
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
                header('Location:'.$url);
            }
        }else{
            die('参数错误');
        }
    }else{
        die('参数错误');
    }
?>