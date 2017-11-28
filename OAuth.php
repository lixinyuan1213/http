<?php
/**
*thinkphp5利用GuzzleHttp完成身份认证并发送json数据
*参考：https://www.cnblogs.com/dengyg200891/p/4930664.html
*参考：https://stackoverflow.com/questions/36011790/guzzle-http-add-authorization-header-directly-into-request
*
*/
namespace app\index\controller;
use GuzzleHttp\Client;
class Index extends Base
{
    //http客户端
    private $Client;
    public function _initialize()
    {
        parent::_initialize();
        $this->Client=new Client();
    }
    public function index(){
        $response = $this->Client->request('POST', 'http://127.0.0.1/getInfo', [
            //http认证
            'auth' => ['admin','admin'],
            'json' => ['taskid' => '41011416','username'=>'admin'],
            'verify' => false
        ]);
        $body = $response->getBody();
        $contents = $body->getContents();
        echo $contents;
    }
}
