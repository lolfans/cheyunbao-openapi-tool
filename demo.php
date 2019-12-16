<?php
require_once 'Client.php';

// 接入商账号
$accessKey     = '19092311080520110003';
// 接入商密钥
$secretKey     = '06f7aab08aa2431e6dae6a156fc9e0b4';
// 请求网关
$gateway       = 'http://cyb-openapi.qizhangtong.com:8070/gateway.do';
//初始化
$client        = new Client($gateway, $accessKey, $secretKey);

/**
 * 通用请求示例
 */
$requestParamsSend = [
    //公共参数
    "service"       => "personRegister",
    "partnerId"     => '19092311080520110003',
    "requestNo"     => date('YmdHis').mt_rand(1000000000,9999999999),
    //业务参数
    "certNo"        => "110101199003075859",
    "certBackPath"  => "http://www.domain.com/certBackPath.jpg",
    "certFrontPath" => "http://www.domain.com/certFrontPath.jpg",
    "bankCardNo"    => "6228480020668298217",
    "smsCode"       => "000000",
    "mobileNo"      => "15723382338",
    "realName"      => "张三",
    "merchUserNo"   => "456789",
    "bankCardMobileNo" => "15723382338",
];
$response   = $client->send($requestParamsSend);
var_dump($response);

/**
 * 跳转接口示例
 */
$requestParamsRedirect = [
    //公共参数
    "service"       => "walletRedirect",
    "partnerId"     => "19092311080520110003",
    "requestNo"     => date('YmdHis').mt_rand(1000000000,9999999999),
    "returnUrl"     => "http://www.baidu.com",
    //业务参数
    "userId"        => "19111210115316210056",
    "requestTime"   => date('YmdHis'),
    "operatorId"    => "19111210115316210056",
    "recAccountName"=> "test-name",
    "merchOrderNo"  => "test12345678",

];
$url        = $client->redirect($requestParamsRedirect);
var_dump($url);

/**
 * 签名示例
 */
$json       = '{"service":"queryAccountAndAuthInfo","userNo":"19111210115316210056","hello":""}';
$sign       = $client->sign($json);
var_dump($sign);

/**
 * 验签示例
 */
$responseBody   = '{"service":"queryAccountAndAuthInfo","userNo":"19111210115316210056","hello":""}';
$signStr        = 'a020e9aff003ece01a9ef1afe985266a';
$bool           = $client->verify($responseBody, $signStr);
var_dump($bool);





