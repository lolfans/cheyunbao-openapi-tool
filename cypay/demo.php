<?php
header("Content-Type: text/html;charset=utf-8");//保证该页面汉字输出不乱码
require_once 'CYPayClient.php';

//配置文件在config文件夹下的CYPayConfig.php
$initConfig = $GLOBALS['CYPayConfig']['develop'];//测试环境 配置信息
//$initConfig = $GLOBALS['CYPayConfig']['product'];//生产环境 配置信息

//初始化
$client = new CYPayClient($initConfig);

/**
 * 通用请求示例  个人用户注册
 */
$sendParams = array(
    //公共参数
    "service"       => "personRegister",
    "partnerId"     => $initConfig['partnerId'],
    "requestNo"     => date('YmdHis').mt_rand(1000000000,9999999999),
    //业务参数
    "certNo"        => "110101199003075859",
    "certBackPath"  => "http://www.domain.com/certBackPath.jpg",
    "certFrontPath" => "http://www.domain.com/certFrontPath.jpg",
    "bankCardNo"    => "6228480020668298217",
    "smsCode"       => "000000",
    "mobileNo"      => "15723382338",
    "realName"      => "张三",
    "merchUserNo"   => "merchUserNo123456789",
    "bankCardMobileNo" => "15723382338",
);
$response   = $client->send($sendParams);
$responseA = json_decode($response,true);
if($responseA['code'] == 'SUCCESS' && $responseA['success'] == true){
    //成功后的处理 eg:
    var_dump($response);
}else{
    //不成功的处理 eg:
    var_dump($response);
}

/**
 * 跳转接口示例  钱包跳转
 */
$redirectParams = array(
    //公共参数
    "service"       => "walletRedirect",
    "partnerId"     => $initConfig['partnerId'],
    "requestNo"     => date('YmdHis').mt_rand(1000000000,9999999999),
    "returnUrl"     => "http://www.baidu.com",
    //业务参数
    "userId"        => "19111210115316210056",
    "requestTime"   => date('YmdHis'),
    "operatorId"    => "19111210115316210056",
    "recAccountName"=> "test-name",
    "merchOrderNo"  => "test12345678",
);
$url = $client->redirect($redirectParams);
//var_dump($url);

/**
 * 签名示例
 */
$json       = '{"bankCardNo":"","bankCode":"","bankName":"","bindNo":"","bindType":null,"cardStatus":null,"code":"MEMBER_REGISTER_ERROR","context":"","detail":"富民个人实名开户失败：该卡已被他人绑定","ext":{},"memberStatus":null,"memberType":null,"merchUserNo":"","message":"富民个人实名开户失败：该卡已被他人绑定","partnerId":"19092311080520110003","protocol":"JSON","publicTag":null,"purpose":null,"realNameAuth":null,"requestNo":"202001031033409986948928","resultDetail":"","service":"personRegister","success":false,"userNo":"","version":"1.0"}';
$sign       = $client->sign($json);
//var_dump($sign);

/**
 * 验签示例
 */
$responseBody   = '{"bankCardNo":"","bankCode":"","bankName":"","bindNo":"","bindType":null,"cardStatus":null,"code":"MEMBER_REGISTER_ERROR","context":"","detail":"富民个人实名开户失败：该卡已被他人绑定","ext":{},"memberStatus":null,"memberType":null,"merchUserNo":"","message":"富民个人实名开户失败：该卡已被他人绑定","partnerId":"19092311080520110003","protocol":"JSON","publicTag":null,"purpose":null,"realNameAuth":null,"requestNo":"202001031033409986948928","resultDetail":"","service":"personRegister","success":false,"userNo":"","version":"1.0"}';
$signStr        = $sign;
$bool           = $client->verify($responseBody, $signStr);
if($bool){
    //验签成功 eg:
//    echo '验签成功';
}else{
    //验签失败 eg:
//    echo '验签失败';
}



















