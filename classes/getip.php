<?php

class GetIp
{
	//获取客户端ip
	public static function clintip()
	{
		//getenv从环境中取字符串,获取环境变量的值
		$cIP = getenv('REMOTE_ADDR');
		$cIP1 = getenv('HTTP_X_FORWARDED_FOR');
		$cIP2 = getenv('HTTP_CLIENT_IP');
		$cIP1 ? $cIP = $cIP1 : null;
		$cIP2 ? $cIP = $cIP2 : null;
		return $cIP;
	}

	//根据ip获取地区信息
	public static function IpMessage($cIP)
	{
		$url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$cIP;
		//返回json串
	    $str = json_decode(file_get_contents($url));
	    return array($str->data->region,$str->data->region_id);
	}
}

?>
