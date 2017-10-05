<?php

// User 模型类

class Db_User extends Db_Base{

	public function findName($uname){

		$query = self::getDb()->prepare("SELECT * FROM test.auth_admin where admin_name=?");
		$res = $query->execute(array($uname));
		$ret = $query->fetch(PDO::FETCH_ASSOC);
		if(!$ret){
			list(self::$errno, self::$errmsg) = Err_Map::aqieget(1003);
			return false;
		}
		return $ret;
	}

	public function addUser($uname,$pwd){
		$query = self::getDb()->prepare('insert into auth_admin (admin_name, password, create_time) values(?, ?, ?)');
	    $ret = $query->execute(array($uname,$pwd,date("Y-m-d H:i:s")));
		
		if(!$ret){
			list(self::$errno, self::$errmsg) = Err_Map::aqieget(1007);
			return false;
		}
		return true;
	}
}
