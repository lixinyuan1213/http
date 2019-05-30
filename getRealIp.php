<?php
//nginx的配置：proxy_set_header  X-Real-IP $remote_addr
//REMOTE_ADDR不可以显式的伪造，虽然可以通过代理将ip地址隐藏，但是这个地址仍然具有参考价值，因为它就是与你的服务器实际连接的ip地址
function getRealIp(){ 
    //优先获取HTTP_X_REAL_IP，HTTP_X_REAL_IP应该是nginx配置的直接和客户打交道的(proxy_set_header  X-Real-IP $remote_addr;)，如果没有直接获取REMOTE_ADDR
    $ip = preg_replace( '/[^0-9a-fA-F:., ]/','',$_SERVER['HTTP_X_REAL_IP']);
    if(empty($ip))
    {
        $ip = preg_replace( '/[^0-9a-fA-F:., ]/','',$_SERVER['REMOTE_ADDR']);
    }
	return $ip;
}
