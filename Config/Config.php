<?php

class Config{

    const HMAC_SHA256     = "HmacSHA256";
    const ENCODING        = "UTF-8";
    const DEFAULT_TIMEOUT = 1000;
    const MD5             = "MD5";
    const SIGN            = "sign";

    //表单类型Content-Type
    const CONTENT_TYPE_FORM     = "application/x-www-form-urlencoded; charset=UTF-8";
    // 流类型Content-Type
    const CONTENT_TYPE_STREAM   = "application/octet-stream; charset=UTF-8";
    //JSON类型Content-Type
    const CONTENT_TYPE_JSON     = "application/json; charset=UTF-8";
    //XML类型Content-Type
    const CONTENT_TYPE_XML      = "application/xml; charset=UTF-8";
    //文本类型Content-Type
    const CONTENT_TYPE_TEXT     = "application/text; charset=UTF-8";

    //请求Header Accept
    const HTTP_HEADER_ACCEPT        = "Accept";
    //请求Body内容MD5 Header
    const HTTP_HEADER_CONTENT_MD5   = "Content-MD5";
    //请求Header Content-Type
    const HTTP_HEADER_CONTENT_TYPE  = "Content-Type";
    //请求Header Content-Length
    const HTTP_HEADER_CONTENT_LENGTH= "Content-Length";
    //请求Header UserAgent
    const HTTP_HEADER_USER_AGENT    = "User-Agent";
    //请求Header Date
    const HTTP_HEADER_DATE          = "Date";

    //GET
    const GET       = "GET";
    //POST
    const POST      = "POST";
    //PUT
    const PUT       = "PUT";
    //DELETE
    const DELETE    = "DELETE";
    //HEAD
    const HEAD      = "HEAD";

    //HTTP
    const HTTP  = "http://";
    //HTTPS
    const HTTPS = "https://";

    //签名Header
    const X_API_ACCESSKEY   = "x-api-accessKey";
    const X_API_SIGNTYPE    = "x-api-signType";
    const X_API_SIGN        = "x-api-sign";

    //响应头部的key
    const X_API_SIGN_RESPONSE   = "x-api-sign:";
    //签名字符串长度
    const X_API_SIGN_LENGTH     = 32;

}