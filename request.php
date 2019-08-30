<?php
/**
 * User: lisy
 */
require 'vendor/autoload.php';
use GuzzleHttp\Client;
$client = new Client();

//get
$response = $client->request('GET','http://localhost/http/response.php?id=2&name=2',['verify' => false,
'headers' => [
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
    'Referer'=>'https://www.baidu.com/s?wd=wzrdfasd'
]
]);
$body = $response->getBody();
$contents = $body->getContents();

//post 表单
$response = $client->request('POST', 'http://localhost/http/response.php', [
    'form_params' => [
        'field_name' => 'abc',
        'other_field' => '123',
        'nested_field' => [
            'nested' => 'hello'
        ]
    ],
    'verify' => false,
    'connect_timeout'=> 15
]);
$body = $response->getBody();
$contents = $body->getContents();

//post json
$response = $client->request('POST', 'http://localhost/http/response.php', [
    'json' => ['foo' => 'bar'],
    'verify' => false
]);
$body = $response->getBody();
$contents = $body->getContents();

//表单文件
$response = $client->request('POST', 'http://localhost/http/response.php', [
    'multipart' => [
        [
            'name'     => 'field_name',
            'contents' => 'abc'
        ],
        [
            'name'     => 'file_name',
            'contents' => fopen('D:/workspace/programs/Visual-NMP-x64/www/Demo1/auto/record.log', 'r')
        ],
    ]
]);
$body = $response->getBody();
$contents = $body->getContents();
//文件下载
$client = new \GuzzleHttp\Client();
$client->request('GET',$url,[
     'verify' => false,
     'save_to' => $path
]);
//代理示例一（传入关联数组来为特殊的URI Scheme指定特色的HTTP代理(比如"http", "https") 提供一个 no 键值对来提供一组不需要使用代理的主机名）
$client = new \GuzzleHttp\Client();
$client->request('GET', '/', [
    'proxy' => [
        'http'  => 'http://localhost:8125', // Use this proxy with "http"
        'no' => ['.mit.edu', 'foo.com']    // Don't use a proxy with these
    ]
])
//代理示例二（使用TinyProxy搭建http代理）
$response = $client->request('GET','https://api.kucoin.com/api/v1/symbols',['verify' => false,
    'headers' => [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
        'Referer'=>'https://www.baidu.com/s?wd=wzrdfasd'
    ],
    'proxy' => [
        'https'  => 'http://11.11.11.11:8888',
     ]
]);
