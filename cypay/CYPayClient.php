<?php
require_once 'http/CYPayHttpClient.php';
require_once 'http/CYPayRequest.php';
require_once 'http/CYPayResponse.php';
require_once 'utils/CYPayConst.php';
require_once 'utils/CYPayUtil.php';
require_once 'config/CYPayConfig.php';

class CYPayClient{
    protected $client;

    /**
     * CYPayClient constructor.
     * @param $initConfig
     */
    public function __construct($initConfig)
    {
        $this->client = new CYPayHttpClient($initConfig);
    }

    /**
     * @param $sendParams    请求参数(数组)
     * @param string $method    请求方式
     * @return mixed            json字符串
     */
    public function send($sendParams, $method = 'POST')
    {
        $response   = $this->client->execute($sendParams,$method );
        $headerSign = $this->client->getHeaderSignStr($response->getHeader());    //同步响应头中的签名字符串

        if($headerSign){
            $bool = $this->verify($response->getBody(),$headerSign);     //验签

            if($bool){
                return $response->getBody();
            }else{
                die('验签失败');
            }
        }else{
            return $response->getBody();
        }

    }

    /**
     * 获取跳转url
     * @param $redirectParams    请求参数(数组)
     * @return mixed            跳转地址
     */
    public function redirect($redirectParams)
    {

        $parameters = json_encode($redirectParams);

        $sign = $this->sign($parameters);

        return $this->client->redirectUrl($sign, $parameters);

    }

    /**
     * 获取签名结果 MD5
     * @param $requestParams    待签名字符串
     * @return string           签名结果(字符串)
     */
    public function sign($requestParams)
    {
        $result = $this->client->sign($requestParams);

        return $result;
    }

    /**
     * 验签
     * @param $content  待签名字符串
     * @param $sign     原始签名 响应头 x-api-sign 的值
     * @return bool     验签结果 (true或false)
     */
    public function verify($content,$sign)
    {
        $bool = $this->client->verify($content,$sign);

        return $bool;
    }
}