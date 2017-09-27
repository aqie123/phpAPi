<?php
/**
 * @name UserModel
 * @desc user数据获取类, 可以访问数据库，文件，其它系统等
 * @author aqie
 */
class UserModel {
	public $errno = 0;
	public $errmsg = '';

	public function __construct() {
    }   
	
	public function register($uname, $pwd){
		return true;
	}	
}
