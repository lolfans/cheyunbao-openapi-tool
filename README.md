#使用方法

1、 先下载此工具包到项目的工具类文件夹下

2、 include_once 'Client.php';  //此处注意包含该文件的要根据项目的实际位置设置，切记

 
$accessKey     = '19092311080520110003';   // 接入商账号

$secretKey     = '06f7aab08aa2431e6dae6a156fc9e0b4';   // 接入商密钥

$gateway       = 'http://cyb-openapi.qizhangtong.com:8070/gateway.do';   // 请求网关

$client        = new Client($gateway, $accessKey, $secretKey);   //初始化时 带入必填参数



#通用请求示例

$response   = $client->send($requestParamsSend);
var_dump($response);



#跳转接口示例

$url        = $client->redirect($requestParamsRedirect);
var_dump($url);


#签名示例

$sign       = $client->sign($json);
var_dump($sign);


#验签示例

$bool           = $client->verify($responseBody, $signStr);
var_dump($bool);


