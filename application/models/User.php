<?php
/**
 * @name UserModel
 * @desc user数据获取类, 可以访问数据库，文件，其它系统等
 * @author aqie
 */
class UserModel {
	public $errno = 0;
	public $errmsg = '';
	private $_db;
	public function __construct() {
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;','root','root');
    }   
	
	public function register($uname, $pwd){
		$query = $this->_db->prepare('select count(*) as c from auth_admin where admin_name=?');
		$query->execute(array($uname));
		$count = $query->fetchAll();

		if($count[0]['c'] != 0){
			$this->errno = -1005;
			$this->errmsg = '用户名已存在';
			return false;
		}

		if(strlen($pwd) < 4){
			$this->errno = -1006;
			$this->errmsg = '密码不得小于四位';
			return false;
		}else{
			$pwd = $this->_genpwd($pwd);
			$query = $this->_db->prepare('insert into auth_admin (admin_name, password, create_time) values(?, ?, ?)');
			$query->bindValue(1,$uname);
			$query->bindValue(2,$pwd);
			$query->bindValue(3,date("Y-m-d H:i:s"));
			$ret = $query->execute();

			if(!$ret){
				$this->errno = -1006;
				$this->errmsg = '注册失败，数据库写入失败';
				return false;
			}
		}

		return true;
	}
	
	private function _genpwd($pwd){
		return md5($pwd);
	}

	public function login($uname, $pwd){
		$pwd = md5($pwd);
	
		$query = $this->_db->prepare("select password,admin_id from auth_admin where admin_name=?");
		$query->execute(array($uname));
		$ret = $query->fetchAll();
		if(!$ret || count($ret) != 1){
			$this->errno = -1003;
			$this->errmsg = '用户名查找失败'.count($ret);
			return false;
		}
		$userInfo = $ret[0];
		if($pwd != $userInfo['password']){
			$this->errno = -1004;
			$this->errmsg = '用户名或密码错误';
			return false;
		}
		return intval($userInfo[1]);
	}	
}
