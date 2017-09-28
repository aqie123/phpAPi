<?php
/**
 * @name UserController
 * @author aqie
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class UserController extends Yaf_Controller_Abstract {
	public function ajaxReturn(){
		header('Content-Type:application/json; charset=utf-8');
	    echo json_encode($data,JSON_UNESCAPED_UNICODE);
	
	}

	

	public function indexAction(){
		return $this->loginAction();
	}
	
	public function loginAction(){
		echo 'dengluchenggong';
		return False;
	}
	/*
	public function registerAction(){
		// todo 实现用户注册
		
		$uname = $this->getRequest()->getPost('uname',false);
		$pwd = $this->getRequest()->getPost('pwd',false);
		if (!$uname || $pwd){
			echo json_encode(array('error'=>-1002,'errmsg'=>'用户名与密码必填'));
			return false;
		}
		// 调用user创建登录验证
		$model = new UserModel();
		if($model->register(trim($uname),trim($pwd))){
			echo json_encode(array(
				'errno'=>0,
				'errmsg'=>'',
				'data'=>array('name'=>$uname)
			));
		}else{
			echo json_encode(array(
				'errno'=>$model->errno;
				'errmsg'=>$model->errmsg;
			
			));
		}
		return true;
	}
	*/
}
