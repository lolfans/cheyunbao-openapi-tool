<?php

class Util{

    /**
     * 去掉无效参数
     * @param $parameters
     * @return array
     */
    public function filterParams($parameters)
    {
        $filteredData = array();
        foreach ($parameters as $key => $val) {
            if ($key == "sign" || $val = "") {
                continue;
            } else {
                $filteredData[$key] = $parameters[$key];
            }
        }
        return $filteredData;
    }

    /**
     * 构建待签名字符串
     * @param $filteredData
     * @return bool|string
     */
    public function buildStr($filteredData)
    {

        ksort($filteredData); //排序
        $str  = "";
        foreach ($filteredData as $key => $val) {
            if (is_array($val)) {
                $val = json_encode($val);
            }elseif (is_bool($val)) {
                if ($val) {
                    $val = "true";
                } else {
                    $val = "false";
                }
            }
            $str .= $key.'='.($val).'&';
        }
        $str = substr($str, 0, -1);
        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }

        return $str;
    }

    /**
     * 填充公共参数
     * @param $requestParams
     * @param $partnerId
     * @return mixed
     */
    public function addCommonParams($requestParams,$partnerId)
    {
        if(isset($requestParams['requestNo']) && empty($requestParams['requestNo'])){
            $requestParams['requestNo'] = $this->generateRequestNo();
        }else{
            $requestParams['requestNo'] = $this->generateRequestNo();
        }

        $requestParams['partnerId'] = $partnerId;

        return $requestParams;
    }

    /**
     * 生成随机数
     * @return string
     */
    private function generateRequestNo()
    {
        $requestNo = 'SYS'.date('YmdHis').mt_rand(1000000000,9999999999);

        return $requestNo;
    }

    /**
     * 获取请求头的签名字符串
     * @param $header
     * @return bool|string
     */
    public function getHeaderSignStr($header)
    {
        $sign = '';
        $header         = $this->filter($header);
        if(strstr($header,Config::X_API_SIGN_RESPONSE)){
            $positionStart  = strpos($header,Config::X_API_SIGN_RESPONSE);
            $keyLength      = strlen(Config::X_API_SIGN_RESPONSE);
            $sign           = substr($header,$positionStart + $keyLength,Config::X_API_SIGN_LENGTH);
        };


        return $sign;
    }

    /**
     * 过滤 特殊符号
     * @param $str
     * @return mixed
     */
    public function filter($str)
    {

        $str        = str_replace(" ",'', $str);          //去掉空格
        $str        = str_replace(PHP_EOL, '', $str);        //去掉换行

        return $str;
    }

    /**
     * 验签
     * @param $content
     * @param $sign
     * @param $appSecret
     * @return bool
     */
    public function verify($content,$sign,$appSecret)
    {
        if(empty($content) || empty($sign)){
            die('content and sign should not be null!');
        }

        $bool       = false;
        $signStr    = $this->sign($content,$appSecret);
        if($signStr == trim($sign)){
            $bool = true;
        }
        return $bool;
    }

    /**
     * 签名
     * @param $parameters
     * @param $appSecret
     * @return string
     */
    public function sign($parameters,$appSecret)
    {
        if(empty($parameters) || empty($appSecret)){
            die('parameters and appSecret should not be null');
        }
        $str = $parameters.$appSecret;  //签名字符串

        return strtolower(md5(trim($str)));
    }

    /**
     * 拼接跳转 url
     * @param $host
     * @param $sign
     * @param $content
     * @param $appKey
     * @return string
     */
    public function redirectUrl($host, $sign, $content, $appKey)
    {
        if(empty($host) || empty($sign) || empty($content) || empty($appKey)){
            die('parameters can not be null');
        }

        $gid = $this->generateGid();
        $content = urlencode($content);
        $url = $host.'?'.Config::X_API_SIGNTYPE.'='.Config::MD5.'&'.Config::X_API_ACCESSKEY.'='.$appKey.'&'.Config::X_API_SIGN.'='.$sign.'&body='.$content.'&gid='.$gid;

        return $url;

    }

    /**
     * 生成随机数
     * @param int $length
     * @return string
     */
    public function generateGid($length = 24)
    {

        $chars  = '0123456789abcdef'; // 密码字符集，可任意添加你需要的字符
        $gid    = 'g';
        for ( $i = 0; $i < $length; $i++ ){
            $gid .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $gid;
    }

}