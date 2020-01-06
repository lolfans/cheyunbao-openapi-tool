<?php

class CYPayResponse{

    private $host;
    private $content;
    private $body;
    private $header;
    private $requestId;
    private $errorMessage;
    private $contentType;
    private $httpStatusCode;

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    public function setHttpStatusCode($httpStatusCode)
    {
        $this->httpStatusCode  = $httpStatusCode;
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    public function setContentType($contentType)
    {
        $this->contentType  = $contentType;
    }

    public function getSuccess()
    {
        if(200 <= $this->httpStatusCode && 300 > $this->httpStatusCode)
        {
            return true;
        }
        return false;
    }
}