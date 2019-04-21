<?php
//composer require jaeger/querylist
//doc:https://github.com/jae-jae/QueryList/blob/master/README-ZH.md
require 'vendor/autoload.php';
use QL\QueryList;
function download(){


    set_time_limit(0);

    ignore_user_abort(true);
    $allUsers = [];

    $ql = QueryList::getInstance();
    for ($i=1;$i<=10;$i++)
    {
        $pageUrl = 'https://github.com/search?p='.$i.'&q=mark&type=Repositories';
        $ql->get($pageUrl)->find(".repo-list");
        $ql->find('li h3 a')->map(function($item)use(&$allUsers){

            $pageHref = $item->href;
            $pageHrefArr = explode('/',$pageHref);
            $allUsers[] = $pageHrefArr[1];
        }
        );
    }
    echo json_encode($allUsers);
}

function logs($error){

    date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai'

    $fp = fopen('record.log','a+');

    $recordTime=date('Y-m-d H:i:s');

    fwrite($fp,$recordTime.":  ".$error. "\n");

    fclose($fp);

}

download();
