<?php
include_once 'Utils/Autoloader.php';

class Client{

    protected $client;

    /**
     * Client constructor.
     * @param $gateway
     * @param $accessKey
     * @param $secretKey
     */
    public function __construct($gateway, $accessKey, $secretKey)
    {
        $this->client = new HttpClient($gateway, $accessKey, $secretKey);
    }

    /**
     * @param $requestParams    请求参数(数组)
     * @param string $method    请求方式
     * @return mixed            json字符串
     */
    public function send($requestParams, $method = 'POST')
    {
        $response   = $this->client->execute($method, $requestParams);
        $headerSign = $this->client->getHeaderSignStr($response->getHeader());    //同步 响应头中的签名字符串

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
     * @param $requestParams    请求参数(数组)
     * @return mixed            跳转地址
     */
    public function redirect($requestParams)
    {

        $parameters = json_encode($requestParams,JSON_UNESCAPED_UNICODE);

        $sign = $this->sign($parameters);

        return $this->client->redirectUrl($sign, $parameters);

    }

    /**
     * 获取签名结果 MD5
     * @param $requestParams    待签名字符串
     * @return string           签名结果
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
     * @return bool     验签结果（true或false）
     */
    public function verify($content,$sign)
    {
        $bool = $this->client->verify($content,$sign);

        return $bool;
    }

}
