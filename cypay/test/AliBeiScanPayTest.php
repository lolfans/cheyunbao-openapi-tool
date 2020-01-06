<?php
header("Content-Type: text/html;charset=utf-8");//保证该页面汉字输出不乱码
require_once '../CYPayClient.php';

//测试环境
$initConfig = $GLOBALS['CYPayConfig']['develop'];
//初始化
$client     =   new CYPayClient($initConfig);

/**
 * 支付条码（被扫）支付
 */
$AliPayParams = array(
    //公共参数
    "service"       => "aliBeiScanPay",
    "partnerId"     => $initConfig['partnerId'],
    "requestNo"     => date('YmdHis').mt_rand(1000000000,9999999999),
    //业务参数
    'merchOrderNo'  => 'OWLTTest0316322803600015',
    'payLimit'      => '',
    'authCode'      => '支付宝授权码',
    'productInfo'   => '交易信息',
    'deviceType'    => 'ANDROID',
    'userIp'        => '用户ip ',
    'macAddress'    => '用户mac地址 ',
    'notifyUrl'     => '通知地址',
    'returnUrl'     => '回调地址',
);
$response  = $client->send($AliPayParams);
$responseA  = json_decode($response,true);
if($responseA['code'] == 'SUCCESS' && $responseA['success'] == true){
    //成功后的处理 eg:
    var_dump($response);
}else{
    //不成功的处理 eg:
    var_dump($response);
}