------
使用方法：详细可以看 demo.php 具体实现
------

1、 先下载此工具包到项目的工具类文件夹下

2、 require_once 'Client.php';  //此处注意包含该文件的要根据项目的实际位置设置，切记

 
    $accessKey = '19092311080520110003';   // 接入商账号 请根据实际情况填入

    $secretKey = '06f7aab08aa2431e6dae6a156fc9e0b4';   // 接入商密钥 请根据实际情况填入

    $gateway   = 'http://cyb-openapi.qizhangtong.com:8070/gateway.do';   // 请求网关  请根据实际情况填入 此处仅是测试环境

    $client    = new Client($gateway, $accessKey, $secretKey);   //初始化时 带入必填参数


---
通用请求示例
---
    $response  = $client->send($requestParamsSend);

    var_dump($response);


---
跳转接口示例
---
    $url = $client->redirect($requestParamsRedirect);

    var_dump($url);

---
签名示例
---
    $sign = $client->sign($json);

    var_dump($sign);

---
验签示例
---
    $bool = $client->verify($responseBody, $signStr);
    
    var_dump($bool);

---
tips:正常情况下，在任何能正常跑PHP的环境中，直接将代码放到本地，demo.php就可以直接访问 看到输出结果。若是出现放到项目中不能调用的情况，一是注意包含client.php的路径是否正确，二是注意命名空间的问题。
---


