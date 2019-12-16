<?php
include_once 'Utils/Autoloader.php';

class Client{

    protected $client;

    public function __construct($gateway, $accessKey, $secretKey)
    {
        $this->client = new HttpClient($gateway, $accessKey, $secretKey);
    }

    /**
     * 执行请求
     * @param $method
     * @param $requestParams
     * @return mixed
     */
    public function send( $requestParams, $method = 'POST')
    {
        $response   = $this->client->execute( $method, $requestParams);
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
     * @param $requestParams
     * @return mixed
     */

    public function redirect($requestParams)
    {

        $parameters = json_encode($requestParams,JSON_UNESCAPED_UNICODE);

        $sign = $this->sign($parameters);

        return $this->client->redirectUrl($sign, $parameters);

    }

    /**
     * 获取签名结果 MD5
     * @param $requestParams
     * @return string
     */
    public function sign($requestParams)
    {
        $result = $this->client->sign($requestParams);

        return $result;
    }


    /**
     * 验签 返回 true或者 false
     * @param $content
     * @param $sign
     * @return bool
     */
    public function verify($content,$sign)
    {
        $bool = $this->client->verify($content,$sign);

        return $bool;
    }


}
