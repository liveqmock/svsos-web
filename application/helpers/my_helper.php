<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('check_email')) {

    function check_email($value) {
        if (preg_match('/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/', $value)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

function getLocationByIp($ip) {
    $info = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip={$ip}");
    return @json_decode($info);
}

if (!function_exists('mySubStr')) {

    function mySubStr($str, $len, $flag = TRUE) {
        if (mb_strlen($str) < $len)
            return $str;
        $i = 0;
        $tlen = 0;
        $tstr = '';
        while ($tlen < $len) {
            $tlen++;
            $chr = mb_substr($str, $i, 1, 'utf8');
            //$chrLen = ord( $chr ) > 127 ? 2 : 1;
            if ($tlen > $len)
                break;
            $tstr .= $chr;
            $i++;
        }
        if ($tstr != $str && $flag) {
            $tstr .= '...';
        }
        return $tstr;
    }

}

if (!function_exists('validLatLng')) {

    function validLatLng($lat, $lng) {
        return (is_numeric($lat) && is_numeric($lng));
    }

}

function iShow($action) {
    $ci = & get_instance();
    $userInfo = $ci->session->userdata('userInfo');
    if (empty($userInfo['role']))
        return false;

    if ($userInfo['role'] == 'superAdmin')
        return true;

    if (strstr($userInfo['role'], $action)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 计算某个经纬度的周围某段距离的正方形的四个点
 *
 * @param lng float 经度
 * @param lat float 纬度
 * @param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为10千米
 * @return array 正方形的四个点的经纬度坐标
 */
function returnSquarePoint($lng, $lat, $distance = 10) {
    $radius = 6371; //地球半径，平均半径为6371km

    $dlng = 2 * asin(sin($distance / (2 * $radius)) / cos(deg2rad($lat)));
    $dlng = rad2deg($dlng);

    $dlat = $distance / $radius;
    $dlat = rad2deg($dlat);

    return array(
        'left-top' => array('lat' => $lat + $dlat, 'lng' => $lng - $dlng),
        'right-top' => array('lat' => $lat + $dlat, 'lng' => $lng + $dlng),
        'left-bottom' => array('lat' => $lat - $dlat, 'lng' => $lng - $dlng),
        'right-bottom' => array('lat' => $lat - $dlat, 'lng' => $lng + $dlng)
    );
}

if (!function_exists('gCookie')) {

    function gCookie($name) {
        $value = get_cookie($name);
        if ($value) {
            return json_decode($value, true);
        } else {
            return array();
        }
    }

}


if (!function_exists('sCookie')) {

    function sCookie($name, $value, $expire = NULL) {
        if (!$expire)
            $expire = 30 * 86400;
        $domain = '.' . str_replace('/', '', str_replace('http:', '', str_replace('www.', '', base_url())));
        $cookie = array(
            'name' => $name,
            'value' => json_encode($value),
            'expire' => $expire,
            'domain' => $domain,
        );
        set_cookie($cookie);
    }

}

if (!function_exists('dCookie')) {

    function dCookie($value) {
        $domain = '.' . str_replace('/', '', str_replace('http:', '', str_replace('www.', '', base_url())));
        delete_cookie($value, $domain);
    }

}

function uuid($more = true, $admin = false) {
    if ($more) {
        return uniqid(md5(mt_rand()), true);
    } else {
        if ($admin)
            return uniqid("zzz", false);
        return uniqid(create_guid_section(3), false);
    }
}

function create_guid_section($characters) {
    $return = "";
    for ($i = 0; $i < $characters; $i++) {
        $return .= dechex(mt_rand(0, 15));
    }
    return $return;
}

function getOrderStatus($type) {
    switch ($type) {
        case 1:
            return '服务申请';
        case 2:
            return '派单中';
        case 3:
            return '服务结束';
    }
}

function getSnsType($via) {
    switch ($via) {
        case 'qq':
            return 1;
        case 'weibo':
            return 2;
        default :
            return 3;
    }
}
