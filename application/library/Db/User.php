<?php

// User 模型类

class Db_User extends Db_Base{


	// 这个函数为什么错啊啊啊啊！！ find关键字?	
	public function find($uname){
			
		$query = self::getDb()->prepare("select * from auth_admin where admin_name=?");
		$query->bindValue(1,$uname);
		$query->execute();
		var_dump($uname);
		$ret = $query->fetch();
		
		var_dump($ret);	
		
		$query->debugDumpParams();
		// die('退出');
		
		if(!$ret){
			self::$errno = -1003;
			self::$errmsg = '用户名查找失败';
			return false;
		}
		
		// var_dump($ret);
		return $ret;
	}	

	public function findName($uname){

		$query = self::getDb()->prepare("SELECT * FROM test.auth_admin where admin_name=?");
		$res = $query->execute(array($uname));
		// var_dump($res); die('测试执行');   true
		$ret = $query->fetch(PDO::FETCH_ASSOC);
		// var_dump($ret);die('调试');
		if(!$ret){	
			self::$errno = -1003;
			self::$errmsg = '用户名查找失败';
			return false;
		}
		return $ret;
	}

	public function addUser($uname,$pwd){
		$query = self::getDb()->prepare('insert into auth_admin (admin_name, password, create_time) values(?, ?, ?)');
	    $ret = $query->execute(array($uname,$pwd,date("Y-m-d H:i:s")));
		
		if(!$ret){
			self::$errno = -1006;
			self::$errmsg = '注册失败，数据库写入失败';
			return false;
		}
		return true;
	}
}
