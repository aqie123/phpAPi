<?php

// 数据库封装类
class Db_Base{

	// 1.用于存储唯一的单例对象
	private static $_db = null;
	public static $errno = 0;
	public static $errmsg = '';

	// 2.私有化构造函数
    //	private function __construct(){}

	// 3.私有化克隆方法
	private function __clone(){}

	// 4.创建静态方法
	public static function getDb(){
		if(!(self::$_db instanceof self)){
			// 如果不是自己实例
			self::$_db = new PDO('mysql:host=127.0.0.1;dbname=test;','root','root');
		}
		return self::$_db;
	}

	public function errno(){
		return self::$errno;
	}

	public function errmsg(){
		return self::$errmsg;
	}
}
