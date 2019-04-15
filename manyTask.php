<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Pool;

$client = new Client();
$requests = function ($total) {
    for ($i = 0; $i < $total; $i++) {
        $uri = 'http://127.0.0.1:20080/req.php?index='.$i;
        yield new Request('GET', $uri);
    }
};
$pool = new Pool($client, $requests(20), [
    'concurrency' => 5,
    'fulfilled' => function ($response, $index) {
        // 成功的响应。
    },
    'rejected' => function ($reason, $index) {
        // 失败的响应
    },
]);
// 构建请求
$promise = $pool->promise();
// 等待请求池完成。
$promise->wait();
