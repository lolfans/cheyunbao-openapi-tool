<?php
header("Content-Type: text/html;charset=utf-8");//保证该页面汉字输出不乱码
require_once '../CYPayClient.php';

//测试环境
$initConfig = $GLOBALS['CYPayConfig']['develop'];
//初始化
$client     =   new CYPayClient($initConfig);

/**
 * 余额支付
【会员】
19111210115316210056 seller
19111115072816210042 payer
 */
$balancePayParams = array(
    //公共参数
    "service"       => "balancePay",
    "partnerId"     => $initConfig['partnerId'],
    "requestNo"     => date('YmdHis').mt_rand(1000000000,9999999999),
    //业务参数
    'merchOrderNo'  => 'OWLTTest0316322803600017',
    'payerUserNo'   => '19111115072816210042',
    'payerUserName' => '张三',
    'userIp'        => '127.0.0.1',
    'macAddress'    => 'macAddress',
    'notifyUrl'     => 'https://www.baidu.com',
    'returnUrl'     => 'https://www.baidu.com',
);
$response = $client->send($balancePayParams);
$responseA = json_decode($response,true);
if($responseA['code'] == 'SUCCESS' && $responseA['success'] == true){
    //成功后的处理 eg:
    var_dump($response);
}else{
    //不成功的处理 eg:
    var_dump($response);
}