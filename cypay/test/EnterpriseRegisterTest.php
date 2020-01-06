<?php
header("Content-Type: text/html;charset=utf-8");//保证该页面汉字输出不乱码
require_once '../CYPayClient.php';

//测试环境
$initConfig = $GLOBALS['CYPayConfig']['develop'];
//初始化
$client     =   new CYPayClient($initConfig);

/**
 * 企业用户注册示例
 */
$registerParams = array(
    //公共参数
    "service"       => "enterpriseRegister",
    "partnerId"     => $initConfig['partnerId'],
    "requestNo"     => date('YmdHis').mt_rand(1000000000,9999999999),
    //业务参数
    'legalRealName' => '法人真实姓名',
    'licenceNo'     => '统一社会信用代码',
    'merchUserNo'   => '外部会员编码',
    'salesmanId'    => '业务员id',
    'comName'       => '商户名称',
    'agentId'       => '代理商id',
    'doorPhotoPath' => '法人手持身份证和门头合影',
    'smsCode'       => '短信验证码',
    'legalCertNo'   => '法人身份证号码',
    'legalMobileNo' => '法人手机号码',
    'mobileNo'      => '注册手机号码',
    'contactEmail'  => '联系人邮箱',
    'bankCardNo'    => '企业对公账户',
    'bankCode'      => '银行编码',
    'notifyUrl'     => 'https://www.baidu.com',
    'returnUrl'     => 'https://www.baidu.com',
    'legalCertFrontPath'=> '法人身份证号码正面',
    'openAccountPath'   => '开户许可证',
    'registerClient'    => '注册客户端',
    'contactRealName'   => '联系人真实姓名',
    'legalCertBackPath' => '法人身份证号码反面',
    'contactMobileNo'   => '联系人手机号码',
    'licencePath'       => '营业执照',
);
$response = $client->send($registerParams);
$responseA = json_decode($response,true);
if($responseA['code'] == 'SUCCESS' && $responseA['success'] == true){
    //成功后的处理 eg:
    var_dump($response);
}else{
    //不成功的处理 eg:
    var_dump($response);
}