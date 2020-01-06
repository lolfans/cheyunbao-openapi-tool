<?php

class CYPayConst{


    const ENCODING        = "UTF-8";
    const MD5             = "MD5";
    const SIGN            = "sign";

    //JSON类型Content-Type
    const CONTENT_TYPE_JSON     = "application/json; charset=UTF-8";
    //请求Header Content-Type
    const HTTP_HEADER_CONTENT_TYPE  = "Content-Type";

    //签名Header
    const X_API_ACCESSKEY   = "x-api-accessKey";
    const X_API_SIGNTYPE    = "x-api-signType";
    const X_API_SIGN        = "x-api-sign";

    //响应头部的key
    const X_API_SIGN_RESPONSE   = "x-api-sign:";
    //签名字符串长度
    const X_API_SIGN_LENGTH     = 32;

}