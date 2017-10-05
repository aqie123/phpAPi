<?php
/**
 * @name UserModel
 * @desc user数据获取类, 可以访问数据库，文件，其它系统等
 * @author aqie
 */
class UserModel {
	public $errno = 0;
	public $errmsg = '';
	private $_dao = null;
	public function __construct() {
		$this->_dao = new Db_User();
		
		$this->_db = new PDO('mysql:host=127.0.0.1;dbname=test;', 'root', 'root');
	}   

	
	public function register($uname, $pwd){
		$res = $this->_dao->findName($uname);
		if($res){
			$this->errno = -1005;
			$this->errmsg = '用户名已存在';
			return false;
		}

		if(strlen($pwd) < 4){
			$this->errno = -1006;
			$this->errmsg = '密码不得小于四位';
			return false;
		}else{
			$pwd = Common_Function::genpwd($pwd);
			$ret = $this->_dao->addUser($uname,$pwd);
			if(!$ret){
				$this->errno = $this->_dao->errno();
				$this->errmsg = $this->_dao->errmsg();
				return false;
			}
		}

		return true;
	}
 	

	public function login($uname, $pwd){	
		$pwd = Common_Function::genpwd($pwd);
	    
		$userInfo = $this->_dao->findName($uname);
		// var_dump($userInfo);die('调试');	
		if(!$userInfo){
			$this->errno = $this->_dao->errno();
			$this->errmsg = $this->_dao->errmsg();
		}
		if($pwd != $userInfo['password']){
			$this->errno = -1004;
			$this->errmsg = '用户名或密码错误'.$userInfo['password'];
			return false;
		}
		return intval($userInfo['admin_id']);
	}	
}
