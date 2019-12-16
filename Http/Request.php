<?php

class Request{

    protected  $host;
    protected  $accessKey;
    protected  $service;
    protected  $method;
    protected  $secretKey;
    protected  $body = array();
    protected  $query = array();
    protected  $headers = array();
    protected  $signHeaders = array();

    public function  __construct($host, $method)
    {
        $this->host = $host;
        $this->method = $method;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeader($key, $value)
    {
        if (null == $this->headers) {
            $this->headers = array();
        }
        $this->headers[$key.""] = $value;
    }

    public function getHeader($key)
    {
        return $this->headers[$key];
    }

    public function removeHeader($key)
    {
        unset($this->headers[$key]);
    }

    public function getQuerys()
    {
        return $this->query;
    }

    public function setQuery($key, $value)
    {
        if (null == $this->query) {
            $this->query = array();
        }
        $this->query[$key] = $value;
    }

    public function getQuery($key)
    {
        return $this->query[$key];
    }

    public function removeQuery($key)
    {
        unset($this->query[$key]);
    }

    public function getBodys()
    {
        return $this->body;
    }

    public function setBody($key, $value)
    {
        if (null == $this->body) {
            $this->body = array();
        }
        $this->body[$key] = $value;
    }

    public function getBody($key)
    {
        return $this->body[$key];
    }

    public function removeBody($key)
    {
        unset($this->body[$key]);
    }

    public function setBodyStream($value)
    {
        if (null == $this->body) {
            $this->bodys = array();
        }
        $this->body[""] = $value;
    }

    public function setBodyString($value)
    {
        if (null == $this->body) {
            $this->bodys = array();
        }
        $this->body[""] = $value;
    }


    public function getSignHeaders()
    {
        return $this->signHeaders;
    }

    public function setSignHeader($value)
    {
        if (null == $this->signHeaders) {
            $this->signHeaders = array();
        }
        if (!in_array($value, $this->signHeaders)) {
            array_push($this->signHeaders, $value);
        }
    }

    public function removeSignHeader($value)
    {
        unset($this->signHeaders[$value]);
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getAppKey()
    {
        return $this->accessKey;
    }

    public function setAppKey($appKey)
    {
        $this->accessKey = $appKey;
    }

    public function getAppSecret()
    {
        return $this->secretKey;
    }

    public function setAppSecret($appSecret)
    {
        $this->secretKey = $appSecret;
    }
}