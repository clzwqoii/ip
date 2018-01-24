<?php
function getIp(){
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $realIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $realIp = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $realIp = $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realIp = getenv( "HTTP_X_FORWARDED_FOR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $realIp = getenv("HTTP_CLIENT_IP");
        } else {
            $realIp = getenv("REMOTE_ADDR");
        }
    }
    return $realIp;
}
function getPosition($ip){
    $res = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");
    $res = json_decode($res,true);
    if ($res[ "code"]==0){
        return $res['data'][ "region"] . ' ' . $res['data']["city"] . ' ' . $res['data'][ "isp"];
    }else{
        return "未知";
    }
}