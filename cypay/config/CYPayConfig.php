<?php
$CYPayConfig = array(

    //测试环境
    'develop' => array(
        // 接入商账号
        'accessKey' => '19092311080520110003',
        // 接入商密钥
        'secretKey' => '06f7aab08aa2431e6dae6a156fc9e0b4',
        // 合作伙伴ID
        'partnerId' => '19092311080520110003',
        // 请求网关
        'gateway'   => 'http://cyb-openapi.qizhangtong.com:8070/gateway.do',
    ),

    //生产环境  需要配置您申请的真实参数
    'product' => array(
        // 接入商账号
        'accessKey' => '你申请的accessKey',
        // 接入商密钥
        'secretKey' => '你申请的secretKey',
        // 合作伙伴ID
        'partnerId' => '你申请的partnerId',
        // 请求网关
        'gateway'   => 'https://openapi-pay.cartechfin.com/gateway.do',
    )
);