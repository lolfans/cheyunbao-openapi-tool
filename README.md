-------车云宝开放品台PHP-Tool-----------

#使用方法

include_once 'Client.php';//此处注意包含该文件的要根据项目的实际位置设置，切记

// 接入商账号

$accessKey     = '19092311080520110003';

// 接入商密钥

$secretKey     = '06f7aab08aa2431e6dae6a156fc9e0b4';

// 请求网关

$gateway       = 'http://cyb-openapi.qizhangtong.com:8070/gateway.do';

//初始化

$client        = new Client($gateway, $accessKey, $secretKey);



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


