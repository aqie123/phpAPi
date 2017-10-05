<?php 

// 公共函数库
class Common_Function{
	
	const SALT = 'aqie';
	static public function genpwd($pwd){
		// return md5(self::SALT.$pwd);
		return md5($pwd);
	}
}
