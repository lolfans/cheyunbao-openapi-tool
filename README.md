###cypay-openapi-sdk-php 使用说明

1,经过测试,本工具支持的PHP版本支持PHP5.3至PHP7.3.支持http/https.

2,将本工具包放到项目里 如libs的工具文件夹中，具体使用可参考demo.php.

3,访问demo.php:`http://localhost:[port]/cypay-openapi-sdk-php/cypay/demo.php`.

4,demo.php中演示了4种调用，分别为send(通用接口调用)、redirect(获取跳转链接时调用)、sign(签名调用)、verify(验签调用).

5,test文件夹中有创建订单、支付宝被扫码支付、余额支付、企业用户注册4个测试案例，可参考使用.

6,php-version.php是用于检测当前环境的PHP版本的探针，访问到本页面就会展示PHP版本及拓展信息.

######包文件说明

***
<pre>
cypay-openapi-sdk-php
   | cypay
   |   |- config    //配置文件夹
   |   |    |- CYPayConfig.php          //配置文件
   |   |- http      //网络请求相关
   |   |    |- CYPayHttpClient.php      //请求处理核心类
   |   |    |- CYPayRequest.php         //请求类
   |   |    |- CYPayResponse.php        //响应类
   |   |- test      //测试文件夹
   |   |    |- AliBeiScanPayTest.php    //支付宝被扫码支付
   |   |    |- BalancePayTest.php       //企帐通余额支付
   |   |    |- EnterpriseRegisterTest.php   //企业用户注册
   |   |    |- TradeCreateTest.php      //创建普通订单
   |   |- utils     //工具文件夹
   |   |    |- CYPayConstant.php    //常量类
   |   |    |- CYPayUtil.php        //工具类
   |   |- CYPayClient.php           //核心类 包含此文件并创建实例 即可调用该类中的方法
   |   |- demo.php                  //演示4种常见调用
   |   |- php-version.php           //php版本信息探针
   |- README.md     //用前须知
</pre>
