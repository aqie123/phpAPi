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
		
	}   

	
	public function register($uname, $pwd){
		$res = $this->_dao->findName($uname);
		if($res){
			list($this->errno,$this->errmsg) = Err_Map::aqieget(1005);
			return false;
		}

		if(strlen($pwd) < 4){
		    list($this->errno,$this->errmsg) = Err_Map::aqieget(1006);	
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
		    list($this->errno,$this->errmsg) = Err_Map::aqieget(1004);	
			return false;
		}
		return intval($userInfo['admin_id']);
	}	
}
