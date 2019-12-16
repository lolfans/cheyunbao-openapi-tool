<?php

class HttpClient{

    protected $util;
    protected $response;

    protected $gateway;
    protected $accessKey;
    protected $secretKey;

    /**
     * 构造函数 类加载时 初始化信息
     * HttpClient constructor.
     * @param $gateway
     * @param $accessKey
     * @param $secretKey
     */
    public function  __construct($gateway, $accessKey, $secretKey)
    {
        $this->util         = new Util();
        $this->response     = new Response();

        $this->gateway      = $gateway;
        $this->accessKey    = $accessKey;
        $this->secretKey    = $secretKey;
    }

    /**
     * 整理参数 准备发送请求
     * @param $method
     * @param $requestParams
     * @return Response
     */
    public function execute($method,$requestParams)
    {
        if(empty($requestParams)){
            die('request parameters should not be null！');
        }
        if(!is_array($requestParams)){
            die('request parameters should be an array！');
        }

        $request = new Request($this->gateway, strtoupper($method));

        foreach ($requestParams as $key => $value){  //参数放入body
            $request->setBody($key,$value);
        }
        $sign = $this->sign(json_encode($requestParams,JSON_UNESCAPED_UNICODE));

        $headers = array( //设置 headers
            Config::X_API_SIGN . ": " . $sign,
            Config::X_API_SIGNTYPE . ": " . Config::MD5,
            Config::X_API_ACCESSKEY . ": " . $this->accessKey,
            Config::HTTP_HEADER_CONTENT_TYPE . ": " . Config::CONTENT_TYPE_JSON
        );

        return $this->curl($request->getHost(),$request->getMethod(),$request->getBodys(),$headers);
    }


    /**
     * 加密
     * @param $requestParams
     * @return string
     */
    public function sign($requestParams)
    {
        $result = $this->util->sign($requestParams,$this->secretKey);

        return $result;
    }


    /**
     * 获取头部中的 签名字符串
     * @param $header
     * @return bool|string
     */
    public function getHeaderSignStr($header)
    {
        $sign = $this->util->getHeaderSignStr($header);

        return $sign;
    }


    /**
     * 验签
     * @param $content
     * @param $sign
     * @return bool
     */
    public function verify($content,$sign)
    {
        $bool = $this->util->verify($content,$sign,$this->secretKey);

        return $bool;
    }


    /**
     * 设置公共参数
     * @param $requestParams
     * @return mixed
     */
    public function addCommonParams($requestParams)
    {
        $requestParams = $this->util->addCommonParams($requestParams,'');
        return $requestParams;
    }


    /**
     * 获取跳转的url
     * @param $sign
     * @param $content
     * @return string
     */
    public function redirectUrl($sign, $content)
    {
        $url = $this->util->redirectUrl($this->gateway, $sign, $content ,$this->accessKey);

        return $url;
    }


    /**
     * 发送请求 返回结果
     * @param $url
     * @param $method
     * @param $params
     * @param $headers
     * @return Response
     */

    public function curl($url,$method,$params,$headers)
    {

        if(is_array($params)){
            $params = json_encode($params,JSON_UNESCAPED_UNICODE);
        }
        $curl = curl_init(); //初始化CURL句柄
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
        curl_setopt($curl, CURLOPT_HEADER, TRUE);           //表示需要 response header

        //SSL验证
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);      // https请求时要设置为false 不验证证书和hosts  FALSE 禁止 cURL 验证对等证书（peer's certificate）, 自cURL 7.10开始默认为 TRUE。从 cURL 7.10开始默认绑定安装。
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);      //检查服务器SSL证书中是否存在一个公用名(common name)。


        if(!empty($headers)){
            curl_setopt ( $curl, CURLOPT_HTTPHEADER, $headers );     //设置 HTTP 头字段的数组。格式： array('Content-type: text/plain', 'Content-length: 100')
        }

        $timeout = 30;      //请求时间
        curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, $timeout);      //设置连接等待时间

        switch ($method){
            case "GET" :
                curl_setopt($curl, CURLOPT_HTTPGET, true);      //TRUE 时会设置 HTTP 的 method 为 GET，由于默认是 GET，所以只有 method 被修改时才需要这个选项。
                break;
            case "POST":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");  //HTTP 请求时，使用自定义的 Method 来代替"GET"或"HEAD"。对 "DELETE" 或者其他更隐蔽的 HTTP 请求有用。 有效值如 "GET"，"POST"，"CONNECT"等等；
                curl_setopt($curl, CURLOPT_POSTFIELDS,$params);      //设置提交的信息 全部数据使用HTTP协议中的 "POST" 操作来发送。
                break;
            case "PUT" :
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curl, CURLOPT_POSTFIELDS,$params);
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_POSTFIELDS,$params);
                break;
        }

        $result = curl_exec($curl);     //执行预定义的CURL

        $this->response->setHttpStatusCode(curl_getinfo($curl, CURLINFO_HTTP_CODE));

        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header     = substr($result, 0, $headerSize);
        $body       = substr($result,$headerSize,10000);

        $this->response->setHeader($header);
        $this->response->setBody($body);


        curl_close($curl);      //关闭cURL会话
        return $this->response;
    }
}