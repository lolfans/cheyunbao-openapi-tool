<?php
header("Content-Type: text/html;charset=utf-8");//保证该页面汉字输出不乱码
require_once '../CYPayClient.php';

//测试环境
$initConfig = $GLOBALS['CYPayConfig']['develop'];
//初始化
$client     =   new CYPayClient($initConfig);

/**
创建支付订单
【会员】
19111210115316210056
19111115072816210042
19110811152016210005
191024170619BE070018
19111210220416210061
19111212555316210074
 */
$tradeCreate = array(
    //公共参数
    "service"       => "tradeCreate",
    "partnerId"     => $initConfig['partnerId'],
    "requestNo"     => date('YmdHis').mt_rand(1000000000,9999999999),
    //业务参数
    'tradeName'     => '上汽通用五菱 宝骏530_XX汽车专营店',
    'merchOrderNo'  => 'OWLTTest0316322803600017',
    'sellerUserNo'  => '19111210115316210056',
    'buyerUserNo'   => '19111115072816210042',
    'payerUserNo'   => '19111115072816210042',
    'payerUserName' => '会员2',
    'payeeUserNo'   => '19111210115316210056',
    'amount'        => '999.00',
    'tradeProfitType' => 'MANUAL',
    'goodsInfoList' => array(
        array(
            'quantity'  => '1',
            'detailUrl' => 'http://www.baidu.com',
            'category'  => '',
            'price'     => '500.00',
            'otherFee'  => '',
            'name'      => '商品二',
            'unit'      => '1',
            'detail'    => '',
            'outId'     => '',
            'referUrl'  => 'http://www.baidu.com',
        ),
        array(
            'quantity'  => '1',
            'detailUrl' => 'http://www.baidu.com',
            'category'  => '',
            'price'     => '499.00',
            'otherFee'  => '',
            'name'      => '商品一',
            'unit'      => '1',
            'detail'    => '',
            'outId'     => '',
            'referUrl'  => 'http://www.baidu.com',
        )
    ),
    'tradeProfitInfoList' => array(
        array(
            'profitMerchOrderNo' => 'OWLTTest0316322803600015',
            'amount'        => '500.00',
            'payeeUserNo'   => '19111210115316210056',
            'tradeMemo'     => '清分',
        ),
        array(
            'profitMerchOrderNo' => 'OWLTTest0316322803600015',
            'amount'        => '499.00',
            'payeeUserNo'   => '19111210115316210056',
            'tradeMemo'     => '清分',
        )
    ),
    'tradeTime' => '2020-01-06 14:19:53',
    'finishTime'=> '2020-01-05 14:19:53',
    'closeTime' => '2020-01-09 10:42:17',
    'tradeMemo' => '交易备注',
);
$response   = $client->send($tradeCreate);
$responseA = json_decode($response,true);

if($responseA['code'] == 'SUCCESS' && $responseA['success'] == true){
    //成功后的处理 eg:
    var_dump($response);
}else{
    //不成功的处理 eg:
    var_dump($response);
}