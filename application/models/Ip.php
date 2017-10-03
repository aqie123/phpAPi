<?php
// 获取IP归属地

class IpModel{
	public $errno = 0;
	public $errmsg = '';

	public function __construct(){}

	public function index(){
		
	}

	public function getIp($ip){
		$rep = ThirdParty_Ip::find($ip);
		return $rep;
	}
}
