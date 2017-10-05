<?php

// 错误字典信息
class Err_Map{
	const ERRMAP  = array(
		1001 => '请通过正常渠道提交',
		1002 => '用户名或密码不能为空',
		1004 => '用户名或密码错误',
		1005 => '用户名已存在',
		1006 => '密码不得小于四位',
		1003 => '用户名查找失败',
		1007 => '注册失败，数据库写入失败'
	);

	public static function get($code){
		if(isset(self::ERRMAP[$code])){
			return array('errno' => (0-$code),'errmsg' => self::ERRMAP[$code]);
		}

		return array('errno' => (0-$code),'errmsg' => 'undefined this errno');
	}

	public static function aqieget($code){	
		if(isset(self::ERRMAP[$code])){
			return array(0-$code,self::ERRMAP[$code]);
		}

		return array(0-$code, 'undefined this errno');
	}
}
